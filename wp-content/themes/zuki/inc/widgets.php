<?php
/**
 * Available Zuki Custom Widgets
 *
 * Learn more: http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package Zuki
 * @since Zuki 1.0
 */

/*-----------------------------------------------------------------------------------*/
/* Custom Zuki Widget: Recent Posts Small One
/*-----------------------------------------------------------------------------------*/

class zuki_recentposts_small_one extends WP_Widget {

	function zuki_recentposts_small_one() {
		$widget_ops = array('description' => __( 'Small Recents Posts widget with featured images.', 'zuki') );

		parent::WP_Widget(false, __('Zuki: Recent Posts (Small 1)', 'zuki'),$widget_ops);
	}

	function widget($args, $instance) {
		$title = $instance['title'];
		$postnumber = $instance['postnumber'];
		$category = apply_filters('widget_title', $instance['category']);

		echo $args['before_widget']; ?>

		<?php if( ! empty( $title ) )
			echo '<div class="widget-title-wrap"><h3 class="widget-title"><span>'. esc_html($title) .'</span></h3></div>'; ?>

<?php
// The Query
$smallone_query = new WP_Query(array (
		'post_status'    => 'publish',
		'posts_per_page' => $postnumber,
		'category_name' => $category,
		'ignore_sticky_posts' => 1
	) );
?>

<?php
// The Loop
if($smallone_query->have_posts()) : ?>

   <?php while($smallone_query->have_posts()) : $smallone_query->the_post() ?>
    <article class="rp-small-one">
      <div class="rp-small-one-content cf">
         <?php if ( '' != get_the_post_thumbnail() ) : ?>
			 <div class="entry-thumb">
				 <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zuki' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail('zuki-small-square'); ?></a>
			</div><!-- end .entry-thumb -->
		<?php endif; ?>

			<div class="entry-date"><a href="<?php the_permalink(); ?>" class="entry-date"><?php echo get_the_date(); ?></a></div>
				<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php zuki_title_limit( 60, '...'); ?></a></h3>
      </div><!--end .rp-small-one-content -->
      </article><!--end .rp-small-one -->

   <?php endwhile ?>

<?php endif ?>

	   <?php
	   echo $args['after_widget'];

	    // Reset the post globals as this query will have stomped on it
	   wp_reset_postdata();
	   }

   function update($new_instance, $old_instance) {
   		$instance['title'] = $new_instance['title'];
   		$instance['postnumber'] = $new_instance['postnumber'];
   		$instance['category'] = $new_instance['category'];

       return $new_instance;
   }

   function form($instance) {
   		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
   		$postnumber = isset( $instance['postnumber'] ) ? esc_attr( $instance['postnumber'] ) : '';
   		$category = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
   	?>

	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('postnumber'); ?>"><?php _e('Number of posts to show:','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('postnumber'); ?>" value="<?php echo esc_attr($postnumber); ?>" class="widefat" id="<?php echo $this->get_field_id('postnumber'); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category slug (optional, separate multiple categories by comma):','zuki'); ?></label>
	<input type="text" name="<?php echo $this->get_field_name('category'); ?>" value="<?php echo esc_attr($category); ?>" class="widefat" id="<?php echo $this->get_field_id('category'); ?>" /></p>

	<?php
	}
}

register_widget('zuki_recentposts_small_one');



/*-----------------------------------------------------------------------------------*/
/* Custom Zuki Widget: Recent Posts Small Two
/*-----------------------------------------------------------------------------------*/

class zuki_recentposts_small_two extends WP_Widget {

	function zuki_recentposts_small_two() {
		$widget_ops = array('description' => __( 'Small Recents Posts widget without featured images.', 'zuki') );

		parent::WP_Widget(false, __('Zuki: Recent Posts (Small 2)', 'zuki'),$widget_ops);
	}

	function widget($args, $instance) {
		$title = $instance['title'];
		$postnumber = $instance['postnumber'];
		$category = apply_filters('widget_title', $instance['category']);

		echo $args['before_widget']; ?>

		<?php if( ! empty( $title ) )
			echo '<div class="widget-title-wrap"><h3 class="widget-title"><span>'. esc_html($title) .'</span></h3></div>'; ?>

<?php
// The Query
$smalltwo_query = new WP_Query(array (
		'post_status'    => 'publish',
		'posts_per_page' => $postnumber,
		'category_name' => $category,
		'ignore_sticky_posts' => 1
	) );
?>

<?php
// The Loop
if($smalltwo_query->have_posts()) : ?>

   <?php while($smalltwo_query->have_posts()) : $smalltwo_query->the_post() ?>
    <article class="rp-small-two">
		<p class="summary"><a href="<?php the_permalink(); ?>"><span class="entry-title"><?php the_title(); ?></span><?php echo zuki_excerpt(15); ?></a><span class="entry-date"><?php echo get_the_date(); ?></span></p>
      </article><!--end .rp-small-two -->

   <?php endwhile ?>

<?php endif ?>

	   <?php
	   echo $args['after_widget'];

	    // Reset the post globals as this query will have stomped on it
	   wp_reset_postdata();
	   }

   function update($new_instance, $old_instance) {
   		$instance['title'] = $new_instance['title'];
   		$instance['postnumber'] = $new_instance['postnumber'];
   		$instance['category'] = $new_instance['category'];

       return $new_instance;
   }

   function form($instance) {
   		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
   		$postnumber = isset( $instance['postnumber'] ) ? esc_attr( $instance['postnumber'] ) : '';
   		$category = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
   	?>

	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('postnumber'); ?>"><?php _e('Number of posts to show:','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('postnumber'); ?>" value="<?php echo esc_attr($postnumber); ?>" class="widefat" id="<?php echo $this->get_field_id('postnumber'); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category slug (optional):','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('category'); ?>" value="<?php echo esc_attr($category); ?>" class="widefat" id="<?php echo $this->get_field_id('category'); ?>" /></p>

	<?php
	}
}

register_widget('zuki_recentposts_small_two');


/*-----------------------------------------------------------------------------------*/
/* Custom Zuki Widget: Recent Posts Medium One
/*-----------------------------------------------------------------------------------*/

class zuki_recentposts_medium_one extends WP_Widget {

	function zuki_recentposts_medium_one() {
		$widget_ops = array('description' => __( 'Medium-sized Recents Posts with featured image and excerpt.', 'zuki') );

		parent::WP_Widget(false, __('Zuki: Recent Posts (Medium 1)', 'zuki'),$widget_ops);
	}

	function widget($args, $instance) {
		$title = $instance['title'];
		$postnumber = $instance['postnumber'];
		$category = apply_filters('widget_title', $instance['category']);

		echo $args['before_widget']; ?>

		<?php if( ! empty( $title ) )
			echo '<div class="widget-title-wrap"><h3 class="widget-title"><span>'. esc_html($title) .'</span></h3></div>'; ?>

<?php
// The Query
$mediumone_query = new WP_Query(array (
		'post_status'    => 'publish',
		'posts_per_page' => $postnumber,
		'category_name' => $category,
		'ignore_sticky_posts' => 1
	) );
?>

<?php
// The Loop
if($mediumone_query->have_posts()) : ?>

   <?php while($mediumone_query->have_posts()) : $mediumone_query->the_post() ?>
    <article class="rp-medium-one">


      <div class="rp-medium-one-content">
         <?php if ( '' != get_the_post_thumbnail() ) : ?>
			 <div class="entry-thumb">
				 <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zuki' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail('zuki-medium-landscape'); ?></a>
			</div><!-- end .entry-thumb -->
		<?php endif; ?>

			<div class="entry-date"><a href="<?php the_permalink(); ?>" class="entry-date"><?php echo get_the_date(); ?></a></div>
			<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php zuki_title_limit( 85, '...'); ?></a></h3>
			<p class="summary"><?php echo zuki_excerpt(20); ?></p>
			<div class="entry-author">
			<?php
				printf( __( 'by <a href="%1$s" title="%2$s">%3$s</a>', 'zuki' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				sprintf( esc_attr__( 'All posts by %s', 'zuki' ), get_the_author() ),
				get_the_author() );
			?>
			</div><!-- end .entry-author -->
			<?php if ( comments_open() ) : ?>
			<div class="entry-comments">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'comments 0', 'zuki' ) . '</span>', __( 'comment 1', 'zuki' ), __( 'comments %', 'zuki' ) ); ?>
			</div><!-- end .entry-comments -->
			<?php endif; // comments_open() ?>
      </div><!--end .rp-medium-one -->


      </article><!--end .rp-medium-one -->

   <?php endwhile ?>

<?php endif ?>

	   <?php
	   echo $args['after_widget'];

	    // Reset the post globals as this query will have stomped on it
	   wp_reset_postdata();
	   }

   function update($new_instance, $old_instance) {
   		$instance['title'] = $new_instance['title'];
   		$instance['postnumber'] = $new_instance['postnumber'];
   		$instance['category'] = $new_instance['category'];

       return $new_instance;
   }

   function form($instance) {
   		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
   		$postnumber = isset( $instance['postnumber'] ) ? esc_attr( $instance['postnumber'] ) : '';
   		$category = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
   	?>

	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('postnumber'); ?>"><?php _e('Number of posts to show:','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('postnumber'); ?>" value="<?php echo esc_attr($postnumber); ?>" class="widefat" id="<?php echo $this->get_field_id('postnumber'); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category slug (optional):','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('category'); ?>" value="<?php echo esc_attr($category); ?>" class="widefat" id="<?php echo $this->get_field_id('category'); ?>" /></p>

	<?php
	}
}

register_widget('zuki_recentposts_medium_one');




/*-----------------------------------------------------------------------------------*/
/* Custom Zuki Widget: Recent Posts Medium Two
/*-----------------------------------------------------------------------------------*/

class zuki_recentposts_medium_two extends WP_Widget {

	function zuki_recentposts_medium_two() {
		$widget_ops = array('description' => __( 'Medium-sized Recents Posts in a 2-column layout with featured image and excerpt.', 'zuki') );

		parent::WP_Widget(false, __('Zuki: Recent Posts ( Medium 2)', 'zuki'),$widget_ops);
	}

	function widget($args, $instance) {
		$title = $instance['title'];
		$postnumber = $instance['postnumber'];
		$category = apply_filters('widget_title', $instance['category']);

		echo $args['before_widget']; ?>

		<?php if( ! empty( $title ) )
			echo '<div class="widget-title-wrap"><h3 class="widget-title"><span>'. esc_html($title) .'</span></h3></div>'; ?>

<?php
// The Query
$mediumtwo_query = new WP_Query(array (
		'post_status'    => 'publish',
		'posts_per_page' => $postnumber,
		'category_name' => $category,
		'ignore_sticky_posts' => 1
	) );
?>

<?php
// The Loop
if($mediumtwo_query->have_posts()) : ?>

   <?php while($mediumtwo_query->have_posts()) : $mediumtwo_query->the_post() ?>
   <article class="rp-medium-two">
      <div class="rp-medium-two-content">

         <?php if ( '' != get_the_post_thumbnail() ) : ?>
			 <div class="entry-thumb">
				 <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zuki' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail('zuki-medium-landscape'); ?></a>
			</div><!-- end .entry-thumb -->
		<?php endif; ?>

			<div class="story">
				<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zuki' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h3>
				<div class="entry-author">
				<?php
					printf( __( 'Published by <a href="%1$s" title="%2$s">%3$s</a>', 'zuki' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					sprintf( esc_attr__( 'All posts by %s', 'zuki' ), get_the_author() ),
					get_the_author() );
				?>
				</div><!-- end .entry-author -->
				<p class="summary"><?php echo zuki_excerpt(30); ?></p>
				<div class="entry-date"><a href="<?php the_permalink(); ?>" class="entry-date"><?php echo get_the_date(); ?></a></div>
				<?php if ( comments_open() ) : ?>
				<div class="entry-comments">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'comments 0', 'zuki' ) . '</span>', __( 'comment 1', 'zuki' ), __( 'comments %', 'zuki' ) ); ?>
				</div><!-- end .entry-comments -->
				<?php endif; // comments_open() ?>
				<div class="entry-cats">
					<?php the_category(', '); ?>
				</div><!-- end .entry-cats -->
			</div><!--end .story -->
		</div><!--end .rp-medium-two-content -->
    </article><!--end .rp-medium-two -->

   <?php endwhile ?>

<?php endif ?>

	   <?php
	   echo $args['after_widget'];

	    // Reset the post globals as this query will have stomped on it
	   wp_reset_postdata();
	   }

   function update($new_instance, $old_instance) {
   		$instance['title'] = $new_instance['title'];
   		$instance['postnumber'] = $new_instance['postnumber'];
   		$instance['category'] = $new_instance['category'];

       return $new_instance;
   }

   function form($instance) {
   		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
   		$postnumber = isset( $instance['postnumber'] ) ? esc_attr( $instance['postnumber'] ) : '';
   		$category = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
   	?>

	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('postnumber'); ?>"><?php _e('Number of posts to show:','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('postnumber'); ?>" value="<?php echo esc_attr($postnumber); ?>" class="widefat" id="<?php echo $this->get_field_id('postnumber'); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category slug (optional):','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('category'); ?>" value="<?php echo esc_attr($category); ?>" class="widefat" id="<?php echo $this->get_field_id('category'); ?>" /></p>

	<?php
	}
}

register_widget('zuki_recentposts_medium_two');




/*-----------------------------------------------------------------------------------*/
/* Custom Zuki Widget: Recent Posts Big One
/*-----------------------------------------------------------------------------------*/

class zuki_recentposts_big_one extends WP_Widget {

	function zuki_recentposts_big_one() {
		$widget_ops = array('description' => __( 'Big Recents Posts with an overlay excerpt text. Featured images must have a minimum size of 1200x800 pixel.', 'zuki') );

		parent::WP_Widget(false, __('Zuki: Recent Posts (Big 1)', 'zuki'),$widget_ops);
	}

	function widget($args, $instance) {
		$title = $instance['title'];
		$postnumber = $instance['postnumber'];
		$category = apply_filters('widget_title', $instance['category']);

		echo $args['before_widget']; ?>

		<?php if( ! empty( $title ) )
			echo '<div class="widget-title-wrap"><h3 class="widget-title"><span>'. esc_html($title) .'</span></h3></div>'; ?>

<?php
// The Query
$bigone_query = new WP_Query(array (
		'post_status'    => 'publish',
		'posts_per_page' => $postnumber,
		'category_name' => $category,
		'ignore_sticky_posts' => 1
	) );
?>

<?php
// The Loop
if($bigone_query->have_posts()) : ?>

   <?php while($bigone_query->have_posts()) : $bigone_query->the_post() ?>

   <article class="rp-big-one cf">
      <div class="rp-big-one-content">

		   <?php if ( '' != get_the_post_thumbnail() ) : ?>
			 <div class="entry-thumb">
				 <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zuki' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail('zuki-fullwidth'); ?></a>
			</div><!-- end .entry-thumb -->
		<?php endif; ?>

			<div class="story">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zuki' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h2>
				<div class="entry-author">
				<?php
					printf( __( '<span>by</span> <a href="%1$s" title="%2$s">%3$s</a>', 'zuki' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					sprintf( esc_attr__( 'All posts by %s', 'zuki' ), get_the_author() ),
					get_the_author() );
				?>
				</div><!-- end .entry-author -->
				<p class="summary"><?php echo zuki_excerpt(65); ?></p>
				<div class="entry-date"><a href="<?php the_permalink(); ?>" class="entry-date"><?php echo get_the_date(); ?></a></div>
				<?php if ( comments_open() ) : ?>
				<div class="entry-comments">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'comments 0', 'zuki' ) . '</span>', __( 'comment 1', 'zuki' ), __( 'comments %', 'zuki' ) ); ?>
				</div><!-- end .entry-comments -->
				<?php endif; // comments_open() ?>
				<div class="entry-cats">
					<?php the_category(', '); ?>
				</div><!-- end .entry-cats -->
			</div><!--end .story -->

		</div><!--end .rp-big-one-content -->
    </article><!--end .rp-big-one -->

   <?php endwhile ?>

<?php endif ?>

	   <?php
	   echo $args['after_widget'];

	    // Reset the post globals as this query will have stomped on it
	   wp_reset_postdata();
	   }

   function update($new_instance, $old_instance) {
   		$instance['title'] = $new_instance['title'];
   		$instance['postnumber'] = $new_instance['postnumber'];
   		$instance['category'] = $new_instance['category'];

       return $new_instance;
   }

   function form($instance) {
   		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
   		$postnumber = isset( $instance['postnumber'] ) ? esc_attr( $instance['postnumber'] ) : '';
   		$category = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
   	?>

	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('postnumber'); ?>"><?php _e('Number of posts to show:','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('postnumber'); ?>" value="<?php echo esc_attr($postnumber); ?>" class="widefat" id="<?php echo $this->get_field_id('postnumber'); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category slug (optional):','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('category'); ?>" value="<?php echo esc_attr($category); ?>" class="widefat" id="<?php echo $this->get_field_id('category'); ?>" /></p>

	<?php
	}
}

register_widget('zuki_recentposts_big_one');


/*-----------------------------------------------------------------------------------*/
/* Custom Zuki Widget: Recent Posts Big Two
/*-----------------------------------------------------------------------------------*/

class zuki_recentposts_big_two extends WP_Widget {

	function zuki_recentposts_big_two() {
		$widget_ops = array('description' => __( 'Big Recents Posts with featured image and a 2-column excerpt. Featured images must have a minimum size of 1200x800 pixel.', 'zuki') );

		parent::WP_Widget(false, __('Zuki: Recent Posts (Big 2)', 'zuki'),$widget_ops);
	}

	function widget($args, $instance) {
		$title = $instance['title'];
		$postnumber = $instance['postnumber'];
		$category = apply_filters('widget_title', $instance['category']);

		echo $args['before_widget']; ?>

		<?php if( ! empty( $title ) )
			echo '<div class="widget-title-wrap"><h3 class="widget-title"><span>'. esc_html($title) .'</span></h3></div>'; ?>

<?php
// The Query
$bigtwo_query = new WP_Query(array (
		'post_status'    => 'publish',
		'posts_per_page' => $postnumber,
		'category_name' => $category,
		'ignore_sticky_posts' => 1
	) );
?>

<?php
// The Loop
if($bigtwo_query->have_posts()) : ?>

   <?php while($bigtwo_query->have_posts()) : $bigtwo_query->the_post() ?>

   <article class="rp-big-two cf">
      <div class="rp-big-two-content">

		   <?php if ( '' != get_the_post_thumbnail() ) : ?>
			 <div class="entry-thumb">
				 <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zuki' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail('zuki-fullwidth'); ?></a>
			</div><!-- end .entry-thumb -->
		<?php endif; ?>

		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zuki' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h2>
		</header>
		<div class="story">
			<div class="entry-author">
			<?php
				printf( __( '<span>by</span> <a href="%1$s" title="%2$s">%3$s</a>', 'zuki' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				sprintf( esc_attr__( 'All posts by %s', 'zuki' ), get_the_author() ),
				get_the_author() );
			?>
			</div><!-- end .entry-author -->
			<p class="summary"><?php echo zuki_excerpt(175); ?></p>
			<footer class="entry-footer">
				<div class="entry-date"><a href="<?php the_permalink(); ?>" class="entry-date"><?php echo get_the_date(); ?></a></div>
				<?php if ( comments_open() ) : ?>
				<div class="entry-comments">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'comments 0', 'zuki' ) . '</span>', __( 'comment 1', 'zuki' ), __( 'comments %', 'zuki' ) ); ?>
				</div><!-- end .entry-comments -->
				<?php endif; // comments_open() ?>
				<div class="entry-cats">
					<?php the_category(', '); ?>
				</div><!-- end .entry-cats -->
			</footer>
		</div><!--end .story -->
	</div><!--end .rp-big-two-content -->
    </article><!--end .rp-big-two -->

   <?php endwhile ?>

<?php endif ?>

	   <?php
	   echo $args['after_widget'];

	    // Reset the post globals as this query will have stomped on it
	   wp_reset_postdata();
	   }

   function update($new_instance, $old_instance) {
   		$instance['title'] = $new_instance['title'];
   		$instance['postnumber'] = $new_instance['postnumber'];
   		$instance['category'] = $new_instance['category'];

       return $new_instance;
   }

   function form($instance) {
   		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
   		$postnumber = isset( $instance['postnumber'] ) ? esc_attr( $instance['postnumber'] ) : '';
   		$category = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
   	?>

	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('postnumber'); ?>"><?php _e('Number of posts to show:','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('postnumber'); ?>" value="<?php echo esc_attr($postnumber); ?>" class="widefat" id="<?php echo $this->get_field_id('postnumber'); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category slug (optional):','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('category'); ?>" value="<?php echo esc_attr($category); ?>" class="widefat" id="<?php echo $this->get_field_id('category'); ?>" /></p>

	<?php
	}
}

register_widget('zuki_recentposts_big_two');


/*-----------------------------------------------------------------------------------*/
/* Custom Zuki Widget: Recent Posts Colored Background
/*-----------------------------------------------------------------------------------*/

class zuki_recentposts_color extends WP_Widget {

	function zuki_recentposts_color() {
		$widget_ops = array('description' => __( 'Medium-sized Recents Posts with a background color.', 'zuki') );

		parent::WP_Widget(false, __('Zuki: Recent Posts (Background)', 'zuki'),$widget_ops);
	}

	function widget($args, $instance) {
		$title = $instance['title'];
		$postnumber = $instance['postnumber'];
		$category = apply_filters('widget_title', $instance['category']);

		echo $args['before_widget']; ?>

		<?php if( ! empty( $title ) )
			echo '<div class="widget-title-wrap"><h3 class="widget-title"><span>'. esc_html($title) .'</span></h3></div>'; ?>

<?php
// The Query
$color_query = new WP_Query(array (
		'post_status'    => 'publish',
		'posts_per_page' => $postnumber,
		'category_name' => $category,
		'ignore_sticky_posts' => 1
	) );
?>

<div class="bg-wrap cf">
<?php
// The Loop
if($color_query->have_posts()) : ?>

   <?php while($color_query->have_posts()) : $color_query->the_post() ?>

   <article class="rp-color cf">
	   <?php if ( '' != get_the_post_thumbnail() ) : ?>
			 <div class="entry-thumb">
				 <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zuki' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail('zuki-medium-portrait'); ?></a>
			</div><!-- end .entry-thumb -->
		<?php endif; ?>

		<header class="entry-header">
			<div class="entry-cats">
				<?php the_category(', '); ?>
			</div><!-- end .entry-cats -->
			<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zuki' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a></h3>
		</header>
		<div class="story">
			<p class="summary"><?php echo zuki_excerpt(30); ?></p>
			<footer class="entry-footer">
				<div class="entry-date"><a href="<?php the_permalink(); ?>" class="entry-date"><?php echo get_the_date(); ?></a></div>
				<?php if ( comments_open() ) : ?>
				<div class="entry-comments">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'comments 0', 'zuki' ) . '</span>', __( 'comment 1', 'zuki' ), __( 'comments %', 'zuki' ) ); ?>
				</div><!-- end .entry-comments -->
				<?php endif; // comments_open() ?>
			</footer>
		</div><!--end .story -->
    </article><!--end .rp-color -->

   <?php endwhile ?>

<?php endif ?>
</div><!--end .bg-wrap -->

	   <?php
	   echo $args['after_widget'];

	    // Reset the post globals as this query will have stomped on it
	   wp_reset_postdata();
	   }

   function update($new_instance, $old_instance) {
   		$instance['title'] = $new_instance['title'];
   		$instance['postnumber'] = $new_instance['postnumber'];
   		$instance['category'] = $new_instance['category'];

       return $new_instance;
   }

   function form($instance) {
   		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
   		$postnumber = isset( $instance['postnumber'] ) ? esc_attr( $instance['postnumber'] ) : '';
   		$category = isset( $instance['category'] ) ? esc_attr( $instance['category'] ) : '';
   	?>

	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('postnumber'); ?>"><?php _e('Number of posts to show:','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('postnumber'); ?>" value="<?php echo esc_attr($postnumber); ?>" class="widefat" id="<?php echo $this->get_field_id('postnumber'); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category slug (optional):','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('category'); ?>" value="<?php echo esc_attr($category); ?>" class="widefat" id="<?php echo $this->get_field_id('category'); ?>" /></p>

	<?php
	}
}

register_widget('zuki_recentposts_color');




/*-----------------------------------------------------------------------------------*/
/* Quote Widget
/*-----------------------------------------------------------------------------------*/

class zuki_quote extends WP_Widget {

	function zuki_quote() {
		$widget_ops = array('description' => 'A big quote or text slogan.' , 'zuki');

		parent::WP_Widget(false, __('Zuki: Quote', 'zuki'),$widget_ops);
	}

	function widget($args, $instance) {
		extract( $args );
		$title = $instance['title'];
		$quotetext = $instance['quotetext'];
		$quoteauthor = $instance['quoteauthor'];

		echo $before_widget; ?>

		<?php if($title != '')
			echo '<div class="widget-title-wrap"><h3 class="widget-title"><span>'. esc_html($title) .'</span></h3></div>'; ?>

			<div class="quote-wrap">
			<blockquote class="quote-text"><?php echo ( wp_kses_post(wpautop($quotetext))  ); ?>
			<?php if($quoteauthor != '') {
				echo '<cite class="quote-author"> ' . ( wp_kses_post($quoteauthor) ) . ' </cite>';
			}
			?>
			</blockquote>
			</div><!-- end .quote-wrap -->

	   <?php
	   echo $after_widget;

	   // Reset the post globals as this query will have stomped on it
	   wp_reset_postdata();
	   }

   function update($new_instance, $old_instance) {

   		$instance['title'] = $new_instance['title'];
   		$instance['quotetext'] = $new_instance['quotetext'];
   		$instance['quoteauthor'] = $new_instance['quoteauthor'];

       return $new_instance;
   }

   function form($instance) {
   		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
   		$quotetext = isset( $instance['quotetext'] ) ? esc_attr( $instance['quotetext'] ) : '';
   		$quoteauthor = isset( $instance['quoteauthor'] ) ? esc_attr( $instance['quoteauthor'] ) : '';
	?>

	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','zuki'); ?></label>
		<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('quotetext'); ?>"><?php _e('Quote Text:','zuki'); ?></label>
		<textarea name="<?php echo $this->get_field_name('quotetext'); ?>" class="widefat" rows="8" cols="12" id="<?php echo $this->get_field_id('quotetext'); ?>"><?php echo( $quotetext ); ?></textarea>
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('quoteauthor'); ?>"><?php _e('Quote Author (optional):','zuki'); ?></label>
	<input type="text" name="<?php echo $this->get_field_name('quoteauthor'); ?>" value="<?php echo esc_attr($quoteauthor); ?>" class="widefat" id="<?php echo $this->get_field_id('quoteauthor'); ?>" />
	</p>

	<?php
	}
}

register_widget('zuki_quote');