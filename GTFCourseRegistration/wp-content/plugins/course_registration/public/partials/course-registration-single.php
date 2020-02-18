<?php while ( have_posts() ) : the_post(); ?>
	<?php if ( is_singular( 'course' ) ): ?>
		<?php 
		$location = get_field('course_address'); 
		$course_id = get_the_ID();
		$course_subtitle = get_field('course_subtitle');
		$is_scheduled = get_field('is_scheduled');
		
		$start_date = DateTime::createFromFormat('Y/m/d', get_field('start_date'));
		$start_time = get_field('start_time');

		$end_date = DateTime::createFromFormat('Y/m/d', get_field('end_date'));
		$end_time = get_field('end_time');
		
		$image_id = get_field( 'course_image' );
		$image_url = wp_get_attachment_url($image_id);
		$available_seats = get_field( 'available_seats' );
		$event_id = get_post_meta($course_id, 'eventbrite_event_id', true);
		$food_pref = get_post_meta($course_id, 'food_preference', true);
		?>
		<article class="wrap cr-course-page">
			<header class="cr-course-header" style="background-color: #4a858f;">
				<!-- <div class="cr-course-header-overlay"></div> -->
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
				<div class="col-xs-12 col-md-8">
					<div class="cr-course-description-section panel panel-default cr-panel">
						<div class="panel-heading"><h3>Program Description</h3></div>
						<div class="cr-course-description panel-body">
							<?php the_content(); ?>
							
							<?php 
							if ( !empty($food_pref) ) {
								?><p><strong><?php
								echo $food_pref;
								?></strong></p><?php 
							}
							?>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-4">
					<div class="cr-course-action-control">
                        <?php if ( $available_seats > 0 ) : ?>
                        <a class="cr-btn-register btn btn-primary btn-lg" href="<?php echo append_var_url(get_permalink(), 'register=on'); ?>">Register</a>
                        <p class="cr-course-seat-info">There are <b><?php the_field('available_seats'); ?></b> seats available</p>
                        <?php else: ?>
                        <a class="cr-btn-register btn btn-primary btn-lg disabled">Register</a>
                        <p class="cr-course-seat-info">This program has been fully registered.</p>
                        <?php endif; ?>
                    </div>
					<!-- <div class="cr-course-organization-section panel panel-default cr-panel">
						<h3>Organization</h3>
						<div class="cr-course-instructor">
							<div class="cr-img-wrap circled">
								<img src="https://static.pexels.com/photos/1654/fashion-person-woman-girl.jpg">
							</div>
						</div>
						<p>Instructor Name</p>
					</div> -->
					<div class="panel panel-default cr-panel">
						<div class="panel-heading"><h3>When & Where<h3></div>
						<div class="panel-body">
							<?php 
							if ( !empty($location) ):
							?>
							<div id="map-course-location"></div>
							<h4 class="cr-course-location"><i class="icon-location"></i><?php echo $location['address']; ?></h4> 
							<?php else: ?>
							<?php endif; ?>
							<h4 class="cr-course-date"><i class="icon-calendar"></i><b>
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
								?>
								</b> - <b>
								<?php 
								if ( !empty($end_date) ) {
									echo $end_date->format('m/d/Y'); 
								}?>, <?php
								if ( !empty($end_time) ) {
									echo $end_time;
								}
							}
							
							?>
							</b></h4> 
						    <span class="addtocalendar atc-style-blue">
						        <var class="atc_event">
						            <var class="atc_date_start"><?php echo $start_date->format('Y-m-d')." ".$start_time; ?></var>
						            <var class="atc_date_end"><?php echo $end_date->format('Y-m-d')." ".$end_time; ?></var>
						            <var class="atc_timezone">America/New_York</var>
						            <var class="atc_title"><?php the_title(); ?></var>
						            <var class="atc_description">
						            <?php 
						            $stripped_content = get_the_content();
						            echo strip_tags($stripped_content); 
						            ?>
						            </var>
						            <var class="atc_location"><?php echo $location['address']; ?></var>
						        </var>
						    </span>
						</div>
					</div>
				</div>
			</div>
		</article>
	<?php else: ?>
	<?php endif ?>
<?php endwhile; ?> 
