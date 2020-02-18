<article <?php post_class(); ?>>
	<header>
		<?php
		global $post;
		$post_slug=$post->post_name;
		$post_type=$post->post_type;
		if ($post_type==='teammember') {
			if ( get_field('detailed_profile', get_the_ID()) ) {
				$url = get_the_permalink();
			} else {
				$url = '/about-us/#' . $post_slug;
			};
		} else {
			$url = get_the_permalink();
		};
		?>
		<h2 class="entry-title"><a href="<?php echo $url; ?>"><?php the_title(); ?></a></h2>
		<?php get_template_part('templates/entry-meta'); ?>
	</header>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
</article>
