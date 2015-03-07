<?
/**
 * Klasse mit Hilfsfunktionen zum debuggen
 *
 * @package Aorta
 * @author Oliver Katzer <ok@yum.de>
 */
class Debug {

  public $class_version   = '$Id: debug.php,v 1.3 2005/05/28 15:24:38 webmaster Exp $';

  public $timer_points = array();

  function debug() {
    $this->set_marker('Start');
  }

  /**
   * Führt print_r() mit <pre> aus
   */
  static function print_r($array, $name = '') {
    echo "\n<pre>\n";
    if ($name) {
      echo "<b>$name</b>\n";
    }
    if ($array) {
      print_r($array);
    } else {
      echo "No Value\n";
    }
    echo "</pre>\n";
  }

  static function dump ($var, $name = '') {
?>
<script type="text/javascript">
<!--
var ns6 = document.getElementById && !document.all ? 1 : 0
var folder = ''

function expanddebug(e){
  folder = ns6 ? document.getElementById(e).style : document.all[e].style
  if (folder.display == "none")
    folder.display = ""
  else
    folder.display = "none"
}
//-->
</script>
<?

    static $count;
    $count++;

    $style = "background-color: whitesmoke; padding: 8px; border: 1px solid black; color: #222; text-align: left; font-size: 11px; ";
    echo "<pre style='$style'>" .
      ($name != '' ? "$name : " : '') .
      self::_get_info_var ($var, $name);

    echo '<a href="javascript:;" onclick="expanddebug(\'debugdump'.$count.'\')" style="color: #222; text-decoration: none;">+</a>';
    echo '<div id="debugdump'.$count.'" style="color: #222; display: none;">';
    self::backtrace();
    echo '</div>';

    echo "</pre>";


  }

  static
  function get ($var, $name = '') {
    return ($name != '' ? "$name : " : '') . debug::_get_info_var ($var, $name);
  }

  static
  function _get_info_var ($var, $name = '', $indent = 0) {
    static $methods = array ();
    static $count;
    $count++;

    $indent > 0 or $methods = array ();

    $indent_chars = '  ';
    $spc = $indent > 0 ? str_repeat ($indent_chars, $indent ) : '';

    $out = '';
    if (is_array ($var)) {
      $out .= "<span style='color:red;'><b>Array</b></span> " . count ($var) . " (\n";
      foreach (array_keys ($var) as $key) {
        $out .= "$spc  [<span style='color:red;'>$key</span>] => ";
        if (($indent == 0) && ($name != '') && (! is_int ($key)) && ($name == $key)) {
          $out .= "LOOP\n";
        } else {
          $out .= self::_get_info_var ($var[$key], '', $indent + 1);
        }
      }
      $out .= "$spc)";
    } else if (is_object ($var)) {
      $class = get_class ($var);
      $out .= "<span style='color:purple;'><b>Object</b></span> $class";
      $parent = get_parent_class ($var);
      $out .= $parent != '' ? " <span style='color:purple;'>extends</span> $parent" : '';
      $out .= " (";
      $out .= '<a href="javascript:;" onclick="expanddebug(\'infovar'.$count.'\')" style="color: #222; text-decoration: none;">+</a>';
      $out .= '<div id="infovar'.$count.'" style="display: none;">';
      $arr = get_object_vars ($var);
      while (list($prop, $val) = each($arr)) {
        $out .= "$spc  " . "-><span style='color:purple;'>$prop</span> = ";
        $out .= self::_get_info_var ($val, $name != '' ? $prop : '', $indent + 1);
      }
      $arr = get_class_methods ($var);
      sort($arr);
      $out .= "$spc  " . "$class methods: " . count ($arr) . " ";
      if (in_array ($class, $methods)) {
        $out .= "[already listed]\n";
      } else {
        $out .= "(";
        $count++;
        $out .= '<a href="javascript:;" onclick="expanddebug(\'infovar'.$count.'\')" style="color: #222; text-decoration: none;">+</a>';
        $out .= '<div id="infovar'.$count.'" style="display: none;">';

        $methods[] = $class;
        while (list($prop, $val) = each($arr)) {
          if ($val != $class) {
            $out .= $indent_chars . "$spc  " . "->$val();\n";
          } else {
            $out .= $indent_chars . "$spc  " . "->$val(); [<b>constructor</b>]\n";
          }
        }
        $out .= "$spc  " . "\n";
        $out .= '</div>)';
      }
      $out .= "$spc";
      $out .= '</div>)';

    } else if (is_resource ($var)) {
      $out .= "<span style='color:steelblue;'>" . $var . "</span> ( <span style='color:steelblue;'><b>Resource</b></span> [" . get_resource_type($var) . "] )";
    } else if (is_int ($var)) {
      $out .= "<span style='color:blue;'>" . $var . "</span> ( <span style='color:blue;'><b>Integer</b></span> )";
    } else if (is_float ($var)) {
      $out .= "<span style='color:blue;'>" . $var . "</span> ( <span style='color:blue;'><b>Float</b></span> )";
    } else if (is_numeric ($var)) {
      $out .= "\"<span style='color:green;'>" . $var . "</span>\" ( <span style='color:blue;'><b>Numeric string</b></span> " . strlen($var) . " )";
    } else if (is_string ($var)) {
      $out .= '"<span style="color:green;">' . h($var) . '</span>" '."\t".'( <span style="color:green;"><b>String</b></span> ' . strlen($var) . ' )';
    } else if (is_bool ($var)) {
      $out .= "<span style='color:darkorange;'>" . ($var ? 'True' : 'False') . "</span> ( <span style='color:darkorange;'><b>Boolean</b></span> )";
    } else if (! isset ($var)) {
      $out .= "<b>Null</b>";
    } else {
      $out .= "<b>Other</b> ( " . $var . " )";
    }

    return $out . "\n";
  }

  static
  function simple_dump($var, $name=null) {
    if ($name) {
      echo "{$name}: ";
    }
    echo self::get_simple_var_info($var, $name);
    echo " \n";
  }

  static private
  function get_simple_var_info($var, $name=null, $indent=0) {
    static $methods = array();
    static $count;
    $count++;

    $indent > 0 or $methods = array();

    $indent_chars = '  ';
    $spc = $indent > 0 ? str_repeat ($indent_chars, $indent ) : '';
    $out = "";

    if (is_array ($var)) {
      $out .= "Array [" . count ($var) . "] (\n";
      foreach (array_keys($var) as $key) {
        $out .= "{$spc}  [{$key}] => ";
        if (($indent == 0) && ($name != '') && (! is_int ($key)) && ($name == $key)) {
          $out .= "LOOP\n";
        } else {
          $out .= self::get_simple_var_info($var[$key], '', $indent + 1);
        }
      }
      $out .= "$spc)";
    } else if (is_resource ($var)) {
      $out .= "{$var} (Resource [" . get_resource_type($var) . "])";
    } else if (is_int ($var)) {
      $out .= "{$var} (Integer)";
    } else if (is_float ($var)) {
      $out .= "{$var} (Float)";
    } else if (is_numeric ($var)) {
      $out .= "\"{$var}\" (Numeric string " . strlen($var) . ")";
    } else if (is_string ($var)) {
      $out .= '"' . h($var) . '"' . " (String " . strlen($var) . ")";
    } else if (is_bool ($var)) {
      $out .= ($var ? 'True' : 'False') . " (Boolean)";
    } else if (! isset ($var)) {
      $out .= "Null";
    } else {
      $out .= "Other ({$var})";
    }

    return "{$out}\n";
  }

  static
  function query($query) {
    $result = mysql_query($query);
    if (!$result) {
      echo "no result";
    } else {
      echo "<style type=\"text/css\">\ntt.debug { font-size: 12px; }\n</style>\n";
      echo "";
      echo "<table style=\"border: 1px solid black;\" width='100%'>\n";
      echo "<caption style=\"border: 1px solid black;\"><tt class=\"debug\">$query</tt></caption>";
      echo "<caption style=\"border: 1px solid black;\"><tt class=\"debug\">Gefundene Datensätze: ". mysql_num_rows($result) ."</tt></caption>";
      $row = 1;
      while ($data = mysql_fetch_assoc($result)) {
        if ($row == 1) {
          echo "<tr>\n";
          foreach ($data as $key => $value) {
            echo "<th><tt class=\"debug\">$key</tt></th>\n";
          }
          echo "</tr>\n";
        }
        echo "<tr>\n";
        foreach ($data as $key => $value) {
          echo "<td><tt class=\"debug\">".h($value)."</tt></td>\n";
        }
        echo "</tr>\n";
        $row++;
      }
      echo "</table>\n";

      echo "<table style=\"border: 1px solid black;\" width='100%'>\n";
      $result = mysql_query("EXPLAIN ".$query);
      $row = 1;
      while ($data = mysql_fetch_assoc($result)) {
        if ($row == 1) {
          echo "<tr>\n";
          foreach ($data as $key => $value) {
            echo "<th><tt class=\"debug\">$key</tt></th>\n";
          }
          echo "</tr>\n";
        }
        echo "<tr>\n";
        foreach ($data as $key => $value) {
          echo "<td><tt class=\"debug\">$value</tt></td>\n";
        }
        echo "</tr>\n";
        $row++;
      }
      echo "</table>\n";
    }
  }

  static
  function db($db_name = 'db') {

    global $$db_name;

    if (!is_object($$db_name))
      die('debug::database kann kein Datenbankobjekt finden');

    return $db->debug();
  }

  static
  function popup($output) {
    echo "<script>alert('$output');</script>";
  }

  static
  function highlight_file($file, $from=1, $count=-1) {
    $ret = '';
    if ((trim($file) != '') && file_exists($file)) {
      // cache the highlighting info
      ob_start();
      highlight_file($file);
      $data = ob_get_contents();
      ob_end_clean();
      // seperate by lines
      $data_lines = explode('<br />',$data);
      // dump all lines?
      if ($count == -1) {
        $n = count($data_lines);
      } else {
        // calculate the amout of lines to be dumped
        $n = $from + $count - 1;
        if ($n > count($data_lines)) {
          $n = count($data_lines);
        }
      }
        if ($from < 1) {
          $from = 1;
        }
      // show the lines
      for ($i=$from - 5; $i < $n; $i++) {
        $k = $i + 1;
        $ret .= '<div style="white-space: nowrap; text-align: left;"><code';
        $ret .=  ($k == $from+1) ? ' style="color: red;"' : ' style="color: blue;"';
        $ret .= '>'.$k.'</code>';
        if (isset($data_lines[$i])) {
          $ret .= '<code style="position:absolute; left:45; white-space: nowrap;">'.$data_lines[$i]."</code>";
        }
        $ret .= "</div>\n";
        // IE cuts the lines
        if (isset($data_lines[$i]) && strlen($data_lines[$i]) > 450) {
          $ret .= '<br />';
        }
      }
    }
    return $ret;
  }

  // this function is called to add a marker during the scripts execution
  // it requires a descriptive name
  function set_marker($name) {
    // call the jointime() function and pass it the output of the microtime() function
    //  as an argument
    $markertime = $this->_jointime(microtime());
    // store the timestamp and the descriptive name in the array
    $array['time'] = $markertime;
    $array['memory'] = memory_get_usage(true);
    $array['name'] = $name;
    $this->timer_points[] = $array;
  }

  function __call($method, $args) {



      if (!method_exists($this, $method)) {
        // TODO: Hier muss setMarker in set_marker umgebaut werden
        // So implementieren, dass dieser Code in allen Klassen verwendet werden kann
          $method = 'set_marker';
          if (!method_exists($this, $method)) {
            throw new Exception("unknown method [$method]");
          }
      }

      return call_user_func_array(array($this, $method), $args);
  }

  function timer_mark($name) {
    return $this->setMarker($name);
  }
  function timerMark($name) {
    $this->timer_mark($name);
  }

  /**
  * this function manipulates the string that we get back from the microtime() function
  */
  function _jointime($mtime) {
    // split up the output string from microtime() that has been passed
    // to the function
    $timeparts = explode(" ",$mtime);
    // concatenate the two bits together, dropping the leading 0 from the
    // fractional part
    $finaltime = $timeparts[1].substr($timeparts[0],1);
    // return the concatenated string
    return $finaltime;
  }

  /**
  * this function simply give the difference in seconds betwen the start of the script and
  * the end of the script
  */
  function get_timer_total() {
    return round($this->timer_points[count($this->timer_points)-1]['time'] - $this->timer_points[0]['time'],3);
  }

  function get_memory_total() {
    return filesize_format($this->timer_points[count($this->timer_points)-1]['memory'] - $this->timer_points[0]['memory']);
  }

  /**
   * Stellt diverse Debug-Informationen (Zeit, Speicher) für die einzelnen Zeitpunkte des Skripts zur Verfügung
   *
   * @return string
   * @author Steffen Schmidt
   */
  function profile() {
    $this->setMarker('Stop');

    $style = "background-color: whitesmoke; padding: 8px; border: 1px solid black; color: #222; text-align: left; font-size: 11px; ";
    echo "<div style='$style'>";

    echo "<p>Script execution debug information:</p>";
    echo "<table border=0 cellspacing=5 cellpadding=5>\n";
    // the format of our table will be 3 columns:
    // Marker name, Timestamp, difference
    echo "<tr><td><b>Marker</b></td><td><b>Memory</b></td><td><b>Diff</b></td><td></td><td><b>Time</b></td><td><b>Diff</b></td></tr>\n";

    foreach ($this->timer_points as $array) {
      echo "<tr>\n";
      echo "<td>".$array['name']."</td>";
      echo "<td>".filesize_format($array['memory'])."</td>";
      echo "<td>";
      // write out the difference between this row and the previous row
      if ($last_memory) {
        echo filesize_format($array['memory'] - $last_memory);
      } else {
        echo "-";
      }
      echo "</td>";
      echo "<td><img src='#' height=10 width=".round(($array['memory'] - $last_memory) / 100000) ." style='background-color: buttonface'></td>";
      echo "<td>".$array['time']."</td>";
      echo "<td>";
      // write out the difference between this row and the previous row
      if ($last_time) {
        echo number_format(round($array['time'] - $last_time,3),3);
      } else {
        echo "-";
      }
      echo "</td>";
      echo "<td><img src='#' height=10 width=".number_format(round($array['time'] - $last_time,3)*2000)." style='background-color: buttonface'></td>";
      echo "</tr>\n";
      $last_time = $array['time'];
      $last_memory = $array['memory'];
    }
    echo "<tr><td>Total</td><td></td><td><b>".$this->get_memory_total()."</b></td><td></td><td></td><td><b>".$this->get_timer_total()."</b></td></tr>";
    echo "</table>";
    echo "</div>";
  }


  /**
  * Debug Backtrace
  *
  * Ruft debug_backtrace() auf und stellt das Ergebnis "hübsch" dar.
  * Gefunden in der Doku von debug_backtrace() (Userkommentar)
  */
  static
  function bt() {
?>
<script type="text/javascript">
<!--
var ns6 = document.getElementById && !document.all ? 1 : 0
var folder = ''

function expanddebug(e){
  folder = ns6 ? document.getElementById(e).style : document.all[e].style
  if (folder.display == "none")
    folder.display = ""
  else
    folder.display = "none"
}
//-->
</script>
<?

    self::backtrace();
  }

  static
  function backtrace() {
    static $count;
    if (!function_exists('debug_backtrace')) {
       echo 'function debug_backtrace does not exists'."\n";
       return;
    }

    $style = "background-color: whitesmoke; padding: 8px; border: 1px solid black; text-align: left; font-size: 11px;";
    echo "<pre style='$style'>";
    echo "\n".'----------------'."\n";
    echo 'Debug backtrace:'."\n";
    echo '----------------'."\n";
    $backtrace = debug_backtrace();
    //print_r($backtrace);
    foreach($backtrace as $t) {

      $count++;

      if (isset($t['class']) && isset($t['type']) && isset($t['function']) && $t['class'].$t['type'].$t['function'] == 'debug::bt') continue;
      if (isset($t['class']) && isset($t['type']) && isset($t['function']) && $t['class'].$t['type'].$t['function'] == '_errorhandler') continue;

      echo '@ ';
      if (isset($t['file'])) {
        $file = str_replace(DR, '&gt;/', $t['file']);
        echo $file . ':' . $t['line'];
      } else {
         // if file was not set, I assumed the functioncall
         // was from PHP compiled source (ie XML-callbacks).
         echo '<PHP inner-code>';
      }

      echo ' -- ';

      if (isset($t['class'])) echo $t['class'] . $t['type'];

      echo $t['function'];

      if (isset($t['args']) && count($t['args'])) {
        echo '(';
        echo '<a href="javascript:;" onclick="expanddebug(\'backtrace'.$count.'\')" style="color: #222; text-decoration: none;">+</a>';
        echo '<div id="backtrace'.$count.'" style="display: none;">';
        foreach ($t['args'] as $arg) {
          echo self::_get_info_var($arg);
        }
        echo '</div>';
        echo ')';
      } else {
        echo '()';
      }

      echo "\r\n";
    }
    echo '</pre>';
  }

}

function _error_handler ($errno, $errstr, $errfile, $errline) {
  // is a @ before error line?
  $str = '';

  if ($errno == E_NOTICE || $errno == E_STRICT) {
    return true;
  }

  if (error_reporting() > 0) {
    $str .= '<!-- " -->';
    $style = "background-color: whitesmoke; padding: 8px; border: 1px solid black; text-align: left; font-size: 11px; ";
    $str .= "<pre style='$style'>";
    switch ($errno) {
      case E_NOTICE :
      case E_USER_NOTICE :
        $str .= "<b>Notice</b>: ";
        break;
      case E_USER_WARNING :
      case E_WARNING :
        $str .= "<b>Warning</b>: ";
        break;
      case E_USER_ERROR :
      case E_ERROR :
        $str .= "<b>ERROR</b>: ";
        break;
      default :
        $str .= "<b>Unknown Error($errno)</b>: ";
        break;
    }
    $str .= "\n";
    $str .= "$errstr\n in <b>$errfile</b> on line <b>$errline</b>\n\n";

    global $debug;

    if (is_object($debug))
    {
      $str .= $debug->highlight_file($errfile, $errline - 1, 3);
    }

    echo $str . "\n";
    debug::backtrace();
    echo "</pre>";
    if ($errno == E_ERROR) {
      die();
    }
  }
}


function dump($var, $name = '') {
  Debug::dump($var, $name);
}

function simple_dump($var, $name=null) {
  Debug::simple_dump($var, $name);
}

function backtrace() {
  Debug::backtrace();
}


function h($string) {
  if (version_compare(PHP_VERSION, '5.2.3', '<')) {
    return htmlspecialchars($string, ENT_COMPAT, "UTF-8");
  }
  return htmlspecialchars($string, ENT_COMPAT, "UTF-8", false);
}
