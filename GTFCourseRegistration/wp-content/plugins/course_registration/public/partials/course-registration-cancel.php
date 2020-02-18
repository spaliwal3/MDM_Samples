<?php while ( have_posts() ) : the_post(); ?>
	<?php if ( is_singular( 'course' ) ): ?>
		<?php 
		$location = get_field('course_address'); 
		$date = DateTime::createFromFormat('Y/m/d', get_field('start_date'));
		$time = get_field('start_time');
		$course_id = get_the_ID();
		$course_subtitle = get_field('course_subtitle');
		$is_scheduled = get_field('is_scheduled');
		$image_id = get_field( 'course_image' );
		$image_url = wp_get_attachment_url($image_id);
		?>
		<article class="wrap cr-course-page">
			
			<header class="cr-course-header" style="background-image:url(<?php echo $image_url;?>);">
				<div class="cr-course-header-overlay"></div>
				<div class="cr-course-header-info">
					<h1 class="cr-course-header-title">
					<?php the_title(); ?></h1>
					<?php
					if ( !empty($course_subtitle) ) {
					?>
					<p class="cr-course-header-subtitle">
					<?php
					echo $course_subtitle;
					?>
					</p> 
					<?php
					}
					?>
					<div class="cr-course-header-meta">
						<span><i class="icon-location"></i> 
						<?php 
						if ( !empty($location) ) {
							echo $location['address'];
						}
						?>
						</span>
						<span><i class="icon-calendar"></i> 
						<?php 
						if ( !empty($is_scheduled) ) {
							echo "To be scheduled";
						} else {
							if ( !empty($start_date) ) {
								echo $start_date->format('m/d/Y'); 
							}?>, <?php
							if ( !empty($start_time) ) {
								echo $start_time;
							}
							if ( !empty($end_date) ) {
								echo "- ".$end_date->format('m/d/Y');
								if (!empty($end_time) ) {
									echo ", ".$end_time;
								}
							}
						}
						?>
						</span>
						<span><i class="icon-group"></i> <?php the_field('available_seats'); ?>/<?php the_field('course_capacity'); ?></span>
						
					</div>
				</div>
			</header>
			
			<div class="row">
			  <div class="col-md-6 col-md-offset-3">
			  	<div class="cr-cancel-form">
					<?php do_action('cancel_form_include',$course_id); ?>
				</div>
			  </div>
			</div>
			
		</article>
	<?php else: ?>
	<?php endif ?>
<?php endwhile; ?> 