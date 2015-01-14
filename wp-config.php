<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'djron');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '/Wy)2#:#+s2J=,m-w5yhsP.DG+%aiuQb,[/8WE&t:MhPkJ%^pQt6cWt{[o]f)dQq');
define('SECURE_AUTH_KEY',  '6p-2[NLwr2|qQFpJE!x-]%<ynmvnfmIpx+whM)(a74&R-qB)nNvNYpw>a1_sY>|,');
define('LOGGED_IN_KEY',    '*|q4=+gkE$S!sThK8Hw2:BBZY$K;ougXjw}mQQqU-W<v_YrwPg,gBO&Y|dE KQ}N');
define('NONCE_KEY',        'Nl|.2wRh`F!~?T~+DB?f1r_!b,sPA8nMrvP)e-N-HI#d,=l}y]+Z/.lv18E+Y@Xq');
define('AUTH_SALT',        '+kCcyq.<$Q1CwFq]TZRNy;z;ITP2Xj@t<%XSA*4&w1ZK(~p1~4*(BA2ZiWT3K-|V');
define('SECURE_AUTH_SALT', '=-Mf*:hH}:@j+.X+9G>@! 7:s{MI6|AVI(d3d9|P4bG```CMSM!gFnA: iYCW}9M');
define('LOGGED_IN_SALT',   'G$dD%l|v7~K~-}w)=cSL0(8t@H`#8:N*_4!lme5gDgdV+ojx74Ikdv@E,]Z9N495');
define('NONCE_SALT',       'I!5)Ig_9+fgC<o| mbL@|kkk!ax+k?a$],GDj5Fe|kc|IydoLyuPD}Z7e!A%;r9f');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
