<?php

namespace Roots\Sage\Extras;
use Roots\Sage\Config,
	Roots\Sage\Wrapper;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Config\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Add SVG mime
 */

function svg_mime_type($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', __NAMESPACE__ . '\\svg_mime_type');

/**
 * Add SVG support to media library
 */

function add_svg_upload() {
  ob_start();

  add_action('shutdown', function() {
    $final = '';
    $ob_levels = count(ob_get_level());
    for ($i = 0; $i < $ob_levels; $i++) {
      $final .= ob_get_clean();
    }
    echo apply_filters('final_output', $final);
  }, 0);
  add_filter('final_output', function($content) {
    $content = str_replace('<# } else if ( \'image\' === data.type && data.sizes && data.sizes.full ) { #>',
        '<# } else if ( \'svg+xml\' === data.subtype ) { #>
				<img class="details-image" src="{{ data.url }}" draggable="false" />
				<# } else if ( \'image\' === data.type && data.sizes && data.sizes.full ) { #>',
        $content
    );
    $content = str_replace(
        '<# } else if ( \'image\' === data.type && data.sizes ) { #>',
        '<# } else if ( \'svg+xml\' === data.subtype ) { #>
				<div class="centered">
					<img src="{{ data.url }}" class="thumbnail" draggable="false" />
				</div>
			<# } else if ( \'image\' === data.type && data.sizes ) { #>',
        $content
    );
    return $content;
  });
}

add_action('admin_init', __NAMESPACE__ . '\\add_svg_upload');

/**
 * Get ID by slug function
 */

function get_ID_by_slug($page_slug) {
	$page = get_page_by_path($page_slug);
	if ($page) {
		return $page->ID;
	} else {
		return null;
	}
}
/**
 * Allow redirect even if headers already sent
 */

function do_output_buffer() {
	ob_start();
}
add_action('init', __NAMESPACE__ . '\\do_output_buffer');

/**
 * Get first paragraph of content
 */

function get_first_paragraph() {
	$text = apply_filters('the_content', get_the_content() );
	$paragraphs = explode('</p>', $text);
	$first_paragraph = array_shift($paragraphs).'</p>';
	return $first_paragraph;
}

/**
 * Get remaining paragraphs of content
 */

function get_last_paragraphs() {
	$text = apply_filters('the_content', get_the_content() );
	$paragraphs = explode('</p>', $text);
	$first_paragraph = array_shift($paragraphs).'</p>';
	$rest_paragraphs = implode('</p>', $paragraphs);
	return $rest_paragraphs;
}

/**
 * Redirect single teammembers to page (except for those with Detailed Profile
 */

//function redirect_teammember(){
//	global $post;
//	if ($post) {  // make sure $post has something in it (empty search results choke on empty $post)
//		$post_slug=$post->post_name;
//	}
//	if (!( get_field('detailed_profile', get_the_ID()) )) {  // if detailed_profile not checked
//
//		if( (is_singular('teammember')) ){  // go ahead and redirect to about-us, use $post-slug as anchor
//			wp_redirect( home_url('/about-us#' . $post_slug ) ); exit;
//		}
//	}
//}
//
//add_action('wp', __NAMESPACE__ . '\\redirect_teammember');

//// Bug testing only. Not to be used on a production site!!
//function sage_wrap_info() {
//	$format = '<h6>The %s template being used is: %s</h6>';
//	$main   = SageWrapping::$main_template;
//	global $template;
//
//	printf($format, 'Main', $main);
//	printf($format, 'Base', $template);
//}
//add_action('wp_footer', __NAMESPACE__ . '\\sage_wrap_info');