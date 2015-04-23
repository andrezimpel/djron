<!-- <li class="<?php echo $class; ?>">
	<span class="gigpress-sidebar-date">
		<?php echo $showdata['date']; ?>
		<?php if($showdata['end_date']) echo ' - '.$showdata['end_date']; ?>
	</span>
	<span>
	<?php if( ! $group_artists && ! $artist && $total_artists > 1) : ?>
		<span class="gigpress-sidebar-artist"><?php echo $showdata['artist']; ?></span>
		<span class="gigpress-sidebar-prep"><?php _e("in", "gigpress"); ?></span>
	<?php endif; ?>
		<span class="gigpress-sidebar-city"><?php echo $showdata['city']; if(!empty($showdata['state'])) echo ', '.$showdata['state']; ?></span>
	</span>
	<span class="gigpress-sidebar-prep"><?php _e("at", "gigpress"); ?></span>
	<span class="gigpress-sidebar-venue"><?php echo $showdata['venue']; ?></span>
	<?php if($showdata['ticket_link']) : ?>
		<span class="gigpress-sidebar-status"><?php echo $showdata['ticket_link']; ?></span>
	<?php endif; ?>
</li> -->


<article class="rp-small-two">
	<p class="summary">
    <span class="entry-title"><?php echo $showdata['date']; ?></span>
    <?php echo $showdata['venue']; ?>
    <span class="entry-date">
      <?php echo $showdata['city']; if(!empty($showdata['state'])) echo ', '.$showdata['state']; ?>
    </span>
  </p>
</article>
