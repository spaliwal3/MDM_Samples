<?php while ( have_posts() ) : the_post(); ?>

	<?php if ( is_singular( 'teammember' ) ): ?>
		<article <?php post_class(); ?>>
		<?php $image = get_field( 'large_image' );
		if ( !empty( $image ) ): ?>
			<header id="heading-image" class="row image-with-overlayed-text">
				<div class="carousel-caption">
					<div class="floating">
						<h1>Meet the <?php the_field( 'title' ); ?></h1>
					</div>
				</div>
					<img class="img-responsive" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
			</header>
		<?php endif; ?>
			<div class="entry-content">
				<?php
				$full_name = get_the_title();
				$first_name = explode( " ", $full_name );
				echo '<h2>' . $first_name[0] . '\'s Story</h2>'; ?>

				<?php the_content(); ?>
			</div>
		</article>
		<section id="donate" class="row">
			<div class="col-sm-8">
				<p><?php the_field( 'donation_text', Roots\Sage\Extras\get_ID_by_slug('home') ); ?></p>
			</div>
			<div class="col-sm-4">
				<a href="/donate" class="btn btn-primary btn-lg center-block">Donate</a>
			</div>
		</section>

	<?php else : ?>
		<article <?php post_class(); ?>>
			<header>
				<h2 class="entry-title"><?php the_title(); ?></h2>
				<?php get_template_part('templates/entry-meta'); ?>
			</header>
			<div class="entry-summary">
				<?php the_content(); ?>
			</div>
			<?php $attachment_object = (get_field('pdf')); ?>
			<?php $path = parse_url($attachment_object['url'], PHP_URL_PATH); ?>
			<a href="<?php echo $path ?>" class="btn btn-primary btn-lg">Read More</a>
		</article>
	<?php endif ?>

<?php endwhile; ?>
