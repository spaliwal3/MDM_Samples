<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           course_registration
 *
 * @wordpress-plugin
 * Plugin Name:       Course Registration System
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       This is a course registration system. Admins and instructors could upload course information in wordpress admins. Course registration system is implemented based on EventBrite API & Strip API.
 * Version:           1.0.0
 * Author:            Gerogia Tech
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       course-registration
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_course_registration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-course-registration-activator.php';
	Course_Registration_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_course_registration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-course-registration-deactivator.php';
	Course_Registration_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_course_registration' );
register_deactivation_hook( __FILE__, 'deactivate_course_registration' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-course-registration.php';

/**
 * Create Course Post Type
 */
add_action('init', 'course_register_post_types');
add_action('init', 'course_register_shortcodes');
/* Registers course post types.*/
function course_register_post_types(){
	/* Set up the arguments for the course post type*/
	$slug = get_theme_mod( 'course_permalink' );
  $slug = ( empty( $slug ) ) ? 'course' : $slug;

	$course_args = array(
		'public' => true,
		'query_var' => $slug,
		'rewrite' => array(
			'slug' => 'course',
			'with_front' => true,
		),
		'supports' => array(
			'title',
			'editor',
			'author',
		),
		'labels' => array(
			'name' => 'Programs',
			'singular_name' => 'Program',
			'add_new' => 'Add New Program',
			'add_new_item' => 'Add New Program',
			'edit_item' => 'Edit Program',
			'new_item' => 'New Program',
			'view_item' => 'View Program',
			'search_items' => 'Search Program',
			'not_found' => 'No Program Found',
			'not_found_in_trash' => 'No Program Found in Trash'
		),
	);

	/* Register the music album post type. */
	register_post_type('course', $course_args);
}

/**
 * Create shortcode
 */
function course_register_shortcodes(){
	/* register the [course] shortcode. */
	add_shortcode('course', 'gtf_course_shortcode');
}
function gtf_course_shortcode(){

	/* Query courses from the database. */
	$loop = new WP_Query(
		array(
			'post_type' => 'course',
			'orderby' => 'title',
			'order' => 'ABC',
			'posts_per_page' => -1,
		)
	);

	/* Check if any course were returned. */
	if ($loop->have_posts()){
		/* open an unordered list. */
		$output = '<ul class"course-collection">';
		/* Loop through the course (The Loop). */
		while ($loop->have_posts()){
			$loop->the_post();
			/* Display the course title. */
			$output .= the_title(
				'<li><a href="' . get_permalink() . '">',
				'</a></li>',
				false
			);
		}
		/* Close the unordered list. */
		$output .= "</ul>";
	}
	/* If course were found. */
	else{
		$output = '<p> No course have been published.';
	}
	return $output;


}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_name() {

	$plugin = new Course_Registration();
	$plugin->run();

}
run_plugin_name();
