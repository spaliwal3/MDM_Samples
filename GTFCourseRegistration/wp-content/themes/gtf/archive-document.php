<?php if ( is_user_logged_in() ) { ?>

<?php get_template_part('templates/page', 'header'); ?>

<?php query_posts($query_string . "&order=DESC"); ?>
<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
<?php endif; ?>

<h1>Private Document Archive</h1>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>

<?php the_posts_navigation(); ?>

<?php } else { ?>

	<?php wp_redirect( home_url() . '/#loginform' ); exit; ?>

<?php } ?>
