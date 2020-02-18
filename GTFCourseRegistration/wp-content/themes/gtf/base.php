<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;

?>

<?php get_template_part( 'templates/head' ); ?>
<body <?php body_class(); ?>>
<!--[if lt IE 9]>
<div class="alert alert-warning">
	<?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your
	browser</a> to improve your experience.', 'sage'); ?>
</div>
<![endif]-->
<?php
do_action( 'get_header' );
get_template_part( 'templates/header' );
?>
<div class="wrap container-fluid" role="document">
	<div class="content row">
		<main class="main" role="main">

			<?php if ( is_page( 'home' ) ): ?>

				<div id="carousel-home" class="carousel slide image-with-overlayed-text" data-ride="carousel" data-interval="5000">

					<?php if ( have_rows( 'home_page_carousel' ) ): ?>
						<?php $i = 0; ?>
						<ol class="carousel-indicators">
							<?php $rows = get_field( 'home_page_carousel' ); ?>
							<?php foreach ( $rows as $key => $value ) { ?>
								<li data-target="#carousel-home"
								    data-slide-to="<?php echo $key ?>" <?php if ( $key == 0 ) {
									echo 'class="active"';
								} ?>></li>
							<?php } ?>
						</ol>

						<div class="carousel-inner" role="listbox">
							<?php while ( have_rows( 'home_page_carousel' ) ) : the_row(); ?>
								<div class="item <?php if ( $i == 0 ) {
									echo 'active';
								} ?>">
									<img src="<?php echo get_sub_field( 'image' ) ?>" alt="Georgia Trauma Foundation">

									<div class="carousel-caption">
										<div class="floating">
											<h1><?php echo get_sub_field( 'heading' ) ?></h1>
											<a href="<?php echo get_sub_field( 'link' ) ?>"
											   role="button"><?php echo get_sub_field( 'link_text' ) ?> &gt;</a>
										</div>
									</div>
								</div>
								<?php $i ++; ?>
							<?php endwhile; ?>
						</div>

					<?php else : echo "<p>no carousel slides."; ?>
					<?php endif; ?>

				</div>

			<?php endif; ?>

			<?php if ( is_page( 'donate' ) ): ?>
				<div id="heading-image" class="image-with-overlayed-text">
					<?php
					$image = get_field( 'header_image' );
					if ( !empty( $image ) ): ?>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
					<?php endif; ?>
					<div class="carousel-caption">
						<div class="floating">
							<h1><?php echo get_field( 'main_title' ) ?></h1>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( is_page( 'why-trauma' ) ): ?>
				<div id="heading-image" class="image-with-overlayed-text">
					<?php
					$image = get_field( 'header_image' );
					if ( !empty( $image ) ): ?>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
					<?php endif; ?>
				</div>
			<?php endif ?>

			<?php include Wrapper\template_path(); ?>
		</main>
		<!-- /.main -->
		<?php if ( Config\display_sidebar() ) : ?>
			<aside class="sidebar" role="complementary">
				<?php include Wrapper\sidebar_path(); ?>
			</aside><!-- /.sidebar -->
		<?php endif; ?>
	</div>
	<!-- /.content -->
</div>
<!-- /.wrap -->
<?php
get_template_part( 'templates/footer' );
wp_footer();
?>
</body>
</html>
