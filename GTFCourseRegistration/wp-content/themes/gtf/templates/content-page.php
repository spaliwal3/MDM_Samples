<?php

use Roots\Sage\Assets;

?>

<?php the_content(); ?>

<?php if ( is_page( 'home' ) ): ?>
	<section id="facts">
		<div class="row">
			<div class="col-sm-4">
				<?php
				$image = get_field( 'fact_one_number' );
				if ( !empty( $image ) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
				<?php endif; ?>
				<p><?php the_field( 'fact_one_text' ); ?></p>
			</div>
			<div class="col-sm-4">
				<?php
				$image = get_field( 'fact_two_number' );
				if ( !empty( $image ) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
				<?php endif; ?>
				<p><?php the_field( 'fact_two_text' ); ?></p>
			</div>
			<div class="col-sm-4">
				<?php
				$image = get_field( 'fact_three_number' );
				if ( !empty( $image ) ): ?>
					<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
				<?php endif; ?>
				<p><?php the_field( 'fact_three_text' ); ?></p>
			</div>
		</div>
		<div class="row">
			<a href="<?php echo get_field( 'more_facts_link' ) ?>" class="btn btn-primary btn-lg">More Facts</a>
		</div>
	</section>
	<section id="donate" class="row">
		<div class="col-sm-8">
			<p><?php the_field( 'donation_text' ); ?></p>
		</div>
		<div class="col-sm-4">
			<a href="/donate" class="btn btn-primary btn-lg center-block">Donate</a>
		</div>
	</section>
	<section id="story" class="row image-with-overlayed-text">
		<?php
		$image = get_field( 'story_image' );
		if ( !empty( $image ) ): ?>
			<img class="halt-resp" src="<?php echo $image['url']; ?>"
			     alt="<?php the_field( 'story_link_text' ); ?>"/>
		<?php endif; ?>
		<div class="carousel-caption">
			<div class="floating">
				<h1><?php echo get_field( 'story_headline' ) ?></h1>
				<a href="<?php echo get_field( 'story_link' ) ?>"
				   role="button"><?php echo get_field( 'story_link_text' ) ?> &gt;</a>
			</div>
		</div>
		<img src="<?= Assets\asset_path( 'images/logo-gtf-stamp.svg' ) ?>" class="stamp">
	</section>
	<section id="team">
		<div class="row">
			<div class="col-sm-12">
				<h2><?php echo get_field( 'team_headline' ) ?></h2>

				<p><?php echo get_field( 'team_text' ) ?></p>
			</div>
		</div>

		<div id="teammembers" class="row">
			<?php $args = array(
				'post_type' => 'teammember',
				'posts_per_page' => 4,
				'order' => 'ASC'
			);
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
				echo '<div class="col-sm-3">';
				global $post;
				$post_slug=$post->post_name;
				if ( get_field('detailed_profile', get_the_ID()) ) {
					echo '<a href="' . get_the_permalink() . '">';
				} else {
					echo '<a href="/about-us/#' . $post_slug . '">';
				};
				if ( has_post_thumbnail() ) {
					the_post_thumbnail();
				}
				echo '<p>' . get_the_title() . '</p>';
				echo '</a>';
				echo '</div>';
			endwhile;
			wp_reset_query(); ?>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<a href="/media/" class="btn btn-primary btn-lg">What We’re Doing</a>
			</div>
		</div>
	</section>
	<section id="location" class="row vertical-align-flex">
		<div class="col-sm-6">
			<h2><?php echo get_field( 'location_headline' ) ?></h2>

			<p><?php echo get_field( 'location_text' ) ?></p>
			<a href="<?php echo get_field( 'location_link' ) ?>"
			   role="button"><?php echo get_field( 'location_link_text' ) ?> &gt;</a>
		</div>
		<div class="col-sm-6">
			<img class="img-responsive center-block" src="<?= Assets\asset_path( 'images/map-home.svg' ) ?>">

			<p>Georgia Trauma Centers</p>
		</div>
	</section>
<?php endif ?>

<?php if ( is_page( 'donate' ) ): ?>
	<section id="donation-info">
		<div class="row">
			<?php if ( have_rows( 'text_in_columns' ) ):
				while ( have_rows( 'text_in_columns' ) ) : the_row();
					if ( get_row_layout() == 'column' ):
						echo '<div class="col-sm-4">';
						echo '<h3>' . get_sub_field( 'header' ) . '</h3>';
						echo '<p>' . get_sub_field( 'text' ) . '</p>';
						if ( get_sub_field( 'payment_button' ) ) :;
							if (get_sub_field( 'header' )==='Payeezy') {
								echo '<button id="donate-button" type="button" class="btn btn-primary btn-lg center-block">' . get_sub_field( 'payment_button_text' ) . '</button>';
							} else {
								echo '<a type="button" href="' . get_sub_field( 'payment_link' ) . '" class="btn btn-primary btn-lg center-block">' . get_sub_field( 'payment_button_text' ) . '</a>';
							};
						endif;
						echo '</div>';
					endif;
				endwhile;
			else :
				echo '<p class="warning">no data found.</p>';
			endif ?>
		</div>
	</section>
	<div id="footer-text">
		<div class="row">
			<div class="col-sm-12">
				<?php echo get_field( 'footer_text' ) ?>
			</div>
		</div>
	</div>
<?php endif ?>

<?php if ( is_page( 'why-trauma' ) ): ?>
	<section id="icons">
		<div class="row">
			<div class="col-sm-12">
				<h3><?php echo get_field( 'icons_heading' ) ?></h3>
			</div>
		</div>
		<div class="row">
			<?php if ( have_rows( 'icon_columns' ) ):
				while ( have_rows( 'icon_columns' ) ) : the_row();
					if ( get_row_layout() == 'column' ):
						echo '<div class="col-sm-3">';
						$image = get_sub_field( 'icon' );
						echo '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '">';
						echo '<p>' . get_sub_field( 'icon_text' ) . '</p>';
						echo '</div>';
					endif;
				endwhile;
			else :
				echo '<p class="warning">no data found.</p>';
			endif ?>
		</div>
		<div class="row">
			<p><?php echo get_field( 'icons_footer' ) ?></p>
		</div>
	</section>
	<section id="second-image" class="image-with-overlayed-text">
		<?php $image = get_field( 'second_image' );
		if ( !empty( $image ) ): ?>
			<img class="img-responsive" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
		<?php endif; ?>
		<div class="carousel-caption">
			<div class="floating">
				<?php echo get_field( 'second_image_text' ) ?>
			</div>
		</div>
	</section>
	<section id="statistics">
		<div class="row">
			<?php if ( have_rows( 'statistics_columns' ) ):
				while ( have_rows( 'statistics_columns' ) ) : the_row();
					if ( get_row_layout() == 'column' ):
						echo '<div class="col-sm-4">';
						echo '<h3>' . get_sub_field( 'heading' ) . '</h3>';
						echo '<p>' . get_sub_field( 'text' ) . '</p>';
						echo '</div>';
					endif;
				endwhile;
			else :
				echo '<p class="warning">no data found.</p>';
			endif ?>
			<a href="/donate" class="btn btn-primary btn-lg">Donate</a>
		</div>
	</section>
	<section id="third-image" class="image-with-overlayed-text">
		<?php $image = get_field( 'third_image' );
		if ( !empty( $image ) ): ?>
			<img class="img-responsive" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
		<?php endif; ?>
		<div class="carousel-caption">
			<div class="floating">
				<?php echo get_field( 'third_image_text' ) ?>
			</div>
		</div>
	</section>
<?php endif ?>

<?php if ( is_page( 'about-us' ) ): ?>
	<section id="our-vision" class="row">
		<img src="<?= Assets\asset_path( 'images/logo-gtf-stamp.svg' ) ?>" class="stamp">

		<h2>Our Vision</h2>

		<h3><?php echo get_field( 'our_vision_heading' ) ?></h3>

		<div class="icon-container">
			<?php if ( have_rows( 'our_vision_columns' ) ):
				while ( have_rows( 'our_vision_columns' ) ) : the_row();
					if ( get_row_layout() == 'column' ):
						echo '<div class="col-sm-4">';
						$image = get_sub_field( 'icon' );
						echo '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '">';
						echo '<p>' . get_sub_field( 'text' ) . '</p>';
						echo '</div>';
					endif;
				endwhile;
			else :
				echo '<p class="warning">no data found.</p>';
			endif ?>
		</div>
		<p><?php echo get_field( 'our_vision_footer' ) ?></p>
	</section>
	<section id="our-mission" class="row">
		<h2>Our Mission</h2>

		<h3><?php echo get_field( 'our_mission_heading' ) ?></h3>

		<div class="icon-container">
			<?php if ( have_rows( 'our_mission_columns' ) ):
				while ( have_rows( 'our_mission_columns' ) ) : the_row();
					if ( get_row_layout() == 'column' ):
						echo '<div class="col-sm-4">';
						$image = get_sub_field( 'icon' );
						echo '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '">';
						echo '<p>' . get_sub_field( 'text' ) . '</p>';
						echo '</div>';
					endif;
				endwhile;
			else :
				echo '<p class="warning">no data found.</p>';
			endif ?>
		</div>
		<div class="col-sm-12">
			<a href="media" class="btn btn-primary btn-lg">What We’re Doing</a>
		</div>
	</section>
	<section id="meet-our-team" class="row image-with-overlayed-text">
		<h2>Meet Our Team</h2>
		<?php $image = get_field( 'meet_our_team_image' );
		if ( !empty( $image ) ): ?>
			<img class="img-responsive" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
		<?php endif; ?>
	</section>
	<section id="team-listing">
		<?php $args = array(
			'post_type' => 'teammember',
			'posts_per_page' => 4,
			'order' => 'ASC'
		);
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
			global $post;
			$post_slug=$post->post_name;
			echo '<div class="person row" id="' . $post_slug . '">
					<div class="col-sm-3">';
			if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			}
			echo '</div>';
			echo '<div class="col-sm-9">';
			echo '<h3>' . get_the_title() . '</h3>';
			echo '<h4>' . get_field( 'title', $loop->ID ) . '</h4>';
			echo Roots\Sage\Extras\get_first_paragraph();
			$full_name = get_the_title();
			$first_name = explode( " ", $full_name );

			if ( get_field('detailed_profile', get_the_ID()) ) {
				echo '<a class="btn btn-primary btn-lg" href="' . get_the_permalink() . '">Read ' . $first_name[0] . '\'s Story</a>';
			} else {
				echo '<a class="btn btn-primary btn-lg" data-toggle="collapse" href="#more-' . $post_slug . '" aria-expanded="false" aria-controls="#more-' . $post_slug . '">Read More</a>';
				echo '<div class="collapse" id="more-' . $post_slug . '">';
				echo Roots\Sage\Extras\get_last_paragraphs();
				echo '</div>';
			};

			echo '</div>
				</div>';

		endwhile;
		wp_reset_query(); ?>
	</section>
<?php endif ?>

<?php if ( is_page( 'your-trauma-center' ) ): ?>

	<section id="statistics">
		<div class="row">
			<?php if ( have_rows( 'statistics' ) ):
				while ( have_rows( 'statistics' ) ) : the_row();
					if ( get_row_layout() == 'column' ):
						echo '<div class="col-sm-4">';
						echo '<h3>' . get_sub_field( 'heading' ) . '</h3>';
						echo '<p>' . get_sub_field( 'text' ) . '</p>';
						echo '</div>';
					endif;
				endwhile;
			else :
				echo '<p class="warning">no data found.</p>';
			endif ?>
		</div>
	</section>
	<section id="donate" class="row">
		<div class="col-sm-8">
			<p><?php the_field( 'donation_text', Roots\Sage\Extras\get_ID_by_slug( 'home' ) ); ?></p>
		</div>
		<div class="col-sm-4">
			<a href="/donate" class="btn btn-primary btn-lg center-block">Donate</a>
		</div>
	</section>
	<section id="locations" class="row">
		<h2><?php echo get_field( 'locations_heading' ) ?></h2>

		<p><?php echo get_field( 'locations_text' ) ?></p>

		<div role="tabpanel" id="tabpanel">
			<div id="trauma-center-list" class="col-xs-6">
				<h3>Georgia Trauma Centers</h3>
				<ul class="nav nav-tabs" role="tablist">
					<?php if ( have_rows( 'map' ) ): ?>
						<?php $active = 'active'; ?>
						<?php while ( have_rows( 'map' ) ): the_row(); ?>
							<li role="presentation" class="<?php echo $active ?>">
								<?php $hash = str_replace( ' ', '-', strtolower( get_sub_field( 'name' ) ) ); ?>
								<a href="#<?php echo $hash ?>" aria-controls="<?php echo $hash ?>" role="tab"
								   data-toggle="tab"><?php the_sub_field( 'name' ); ?></a>
							</li>
							<?php $active = ''; ?>
						<?php endwhile; ?>
					<?php endif; ?>
				</ul>
			</div>

			<div class="tab-content">
				<?php if ( have_rows( 'map' ) ): ?>
					<?php $active = 'in active'; ?>
					<?php while ( have_rows( 'map' ) ): the_row(); ?>
						<?php $hash = str_replace( ' ', '-', strtolower( get_sub_field( 'name' ) ) ); ?>
						<div role="tabpanel" class="tab-pane fade <?php echo $active ?>" id="<?php echo $hash ?>">
							<?php $image = get_sub_field( 'image' ); ?>
							<div class="col-xs-6">
								<img src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">
							</div>
							<?php if ( have_rows( 'centers' ) ): ?>
								<ul id="tab-content-addresses">
									<?php while ( have_rows( 'centers' ) ): the_row(); ?>
										<li><?php the_sub_field( 'address' ); ?></li>
									<?php endwhile; ?>
								</ul>
							<?php endif; ?>
						</div>
						<?php $active = ''; ?>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>

		</div>

	</section>

<?php endif ?>

<?php wp_link_pages( [ 'before' => '<nav class="page-nav"><p>' . __( 'Pages:', 'sage' ), 'after' => '</p></nav>' ] ); ?>
