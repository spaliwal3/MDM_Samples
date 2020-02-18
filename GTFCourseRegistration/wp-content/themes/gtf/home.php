<?php get_template_part('templates/page', 'header'); ?>

<div id="heading-image" class="image-with-overlayed-text">
	<?php $image = get_field( 'header_image', Roots\Sage\Extras\get_ID_by_slug('media') );
	if ( !empty( $image ) ): ?>
		<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
		<div class="carousel-caption">
			<div class="floating">
				<h1><?php the_field( 'main_title', Roots\Sage\Extras\get_ID_by_slug('media') ) ?></h1>
			</div>
		</div>
	<?php endif; ?>
</div>
<p><?php the_field( 'intro_text', Roots\Sage\Extras\get_ID_by_slug('media') ) ?></p>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>

<?php the_posts_navigation(); ?>
