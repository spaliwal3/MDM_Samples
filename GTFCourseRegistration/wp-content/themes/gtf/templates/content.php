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