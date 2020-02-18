
<?php 
	// the query
	$the_query = new WP_Query( array( 'post_type' => 'course', 'posts_per_page' => -1 ) );
?>

<div class="wrap">
	<header class="cr-course-page-header">
		<h2 class="cr-course-page-title">Programs</h2>
		<!-- <div class="cr-search-wrap">
			<form class="cr-search navbar-form" role="search" action="<?php $_SERVER['REQUEST_URI'] ?>"> 
				<input type="text" class="form-control cr-search-input" placeholder="Search for Course" name="search" value="<?php get_search_query(); ?>" spellcheck="false"> 
				<button type="submit" class="cr-btn-search"><i class="icon-search"></i></button>
			</form>
		</div> -->
	</header>
	<?php if ( $the_query->have_posts() ) : ?>
	<!-- pagination here -->
	<ul class="cr-course-list">
		<!-- the loop -->
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<?php 
		$post_id = get_the_ID();
		$location = get_field('course_address'); 
		$course_subtitle = get_field('course_subtitle');
		$is_scheduled = get_field('is_scheduled');
		$date = DateTime::createFromFormat('Y/m/d', get_field('start_date'));
		$time = get_field('start_time');
		$end_date = DateTime::createFromFormat('Y/m/d', get_field('end_date'));
		$end_time = get_field('end_time');
		$image_id = get_field( 'course_image' );
		$image_url = wp_get_attachment_url($image_id);
		?>	
		<li class="cr-course-list-item">
   			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div class="cr-course-list-item-thumb">
						<a href="<?php the_permalink(); ?>">
							<img src="<?php echo $image_url; ?>">
						</a>			
					</div>
				</div>
				<div class="col-sm-8 col-xs-12">
					<div class="cr-course-list-item-date">
					<i class="icon-calendar"></i> 
						<?php 
						if ( !empty($is_scheduled) ) {
							?>
							To be scheduled
							<?php
						} else {
							if ( !empty($date) ) {
								echo $date->format('l, F d, Y');
							} ?>, <b><?php
							if ( !empty($time) ) {
								echo $time;
							}
							?></b>
							<?php 
							if ( !empty($end_date) ) {
								echo "- ".$end_date->format('l, F d, Y');
								if ( !empty($end_time) ) {
								echo ",<b> ".$end_time."</b>";
								}
							} 
						}
						?>

					</div>
					<div class="cr-course-list-item-title">
						<a href="<?php the_permalink(); ?>">
							<?php 
							the_title(); 

							if ( !empty($course_subtitle) ) {
								?>
								<br>
								<span class="cr-course-list-item-subtitle">
								<?php 
									echo $course_subtitle;
								?>
								</span>
								<?php
							}
							?>
						</a>					
					</div>
					<?php $stripped_content = get_the_content(); ?>
					<p class="cr-course-list-item-desc"><?php echo strip_tags($stripped_content); ?></p>
					<!-- <div class="cr-course-list-item-instructor">
						<a href="#">
							<img src="http://themes.vibethemes.com/wplms/skins/modern/wp-content/uploads/avatars/1/cc0248098d207038a1b62aecd6d3d9e1-bpthumb.jpg" alt="Profile Photo">
						</a>
					</div> -->
					<div class="cr-course-list-item-meta">
						<span><i class="icon-group"></i> <?php the_field('available_seats'); ?>/<?php the_field('course_capacity'); ?></span>	
						&nbsp;&nbsp;&nbsp;
						<span><i class="icon-location"></i> 
						<?php 
						if ( !empty($location) ) {
							echo $location['address'];
						}
						?>
						</span>	
					</div>
				</div>
			</div>
		</li>
		<?php endwhile; ?>
		<!-- end of the loop -->

		<!-- pagination here -->
		<?php wp_reset_postdata(); ?>
	</ul>
	<?php else : ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>
</div>