<article <?php post_class(); ?>>
  <header>
	  <?php $attachment_object = (get_field('file')); ?>
	  <img src="<?php echo $attachment_object['icon'] ?>" alt="<?php echo $attachment_object['name'] ?>" >
	  <h2 class="entry-title"><?php the_title(); ?></h2>
    <?php get_template_part('templates/entry-meta-document'); ?>
  </header>
	<?php $path = parse_url($attachment_object['url'], PHP_URL_PATH); ?>
	<p><?php the_field('description') ?></p>
	<a href="<?php echo $path ?>" class="btn btn-primary btn-lg">Download</a>
</article>