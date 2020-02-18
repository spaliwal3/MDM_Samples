<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    course_registration
 * @subpackage course_registration/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    course_registration
 * @subpackage course_registration/includes
 * @author     Your Name <email@example.com>
 */
class Course_Registration {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Course_Registration_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'course_registration';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Course_Registration_Loader. Orchestrates the hooks of the plugin.
	 * - Course_Registration_i18n. Defines internationalization functionality.
	 * - Course_Registration_Admin. Defines all hooks for the admin area.
	 * - Course_Registration_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-course-registration-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-course-registration-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-course-registration-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-course-registration-public.php';

		/**
		 * Load all helper functions
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions.php';

		/**
		 * Load all shared data
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/metadata.php';

		$this->loader = new Course_Registration_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Plugin_Name_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Course_Registration_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Course_Registration_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		// add custom field for course post type
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'gtf_course_date_time_create');
		$this->loader->add_action('add_meta_boxes', $plugin_admin, 'gtf_course_address_create');
		$this->loader->add_action('add_meta_boxes', $plugin_admin, 'gtf_course_capacity_create');
		//$this->loader->add_action('add_meta_boxes', $plugin_admin, 'gtf_deposit_amount_create');
		$this->loader->add_action('add_meta_boxes', $plugin_admin, 'gtf_course_subtitle_create');
		$this->loader->add_action('add_meta_boxes', $plugin_admin, 'gtf_food_preference_create');
		$this->loader->add_action('add_meta_boxes', $plugin_admin, 'gtf_payment_preference_create');
		$this->loader->add_action('save_post', $plugin_admin, 'gtf_course_capacity_save_meta');
		$this->loader->add_action('save_post', $plugin_admin, 'gtf_deposit_amount_save_meta');
		$this->loader->add_action('save_post', $plugin_admin, 'gtf_food_preference_meta');
		$this->loader->add_action('save_post', $plugin_admin, 'gtf_course_subtitle_meta');
		$this->loader->add_action('save_post', $plugin_admin, 'gtf_payment_preference_meta');

		$this->loader->add_action('add_meta_boxes', $plugin_admin, 'gtf_course_image_create');
		$this->loader->add_action('save_post', $plugin_admin, 'gtf_course_date_time_save_meta');
		$this->loader->add_action('acf/save_post', $plugin_admin, 'gtf_course_google_map_address_save_meta', 1);
		$this->loader->add_action('acf/save_post', $plugin_admin, 'gtf_course_image_save_meta', 1);

		//customize course list
		$this->loader->add_filter('manage_course_posts_columns', $plugin_admin, 'gtf_course_table_head');
		$this->loader->add_action('manage_course_posts_custom_column', $plugin_admin ,'gtf_course_table_content', 10, 2 );
		// sort the table by date
		$this->loader->add_filter( 'manage_edit-course_sortable_columns', $plugin_admin, 'gtf_course_table_sorting' );
		//$this->loader->add_filter( 'request', $plugin_admin, 'gtf_course_date_column_orderby' );
		$this->loader->add_filter( 'request', $plugin_admin, 'gtf_course_available_seats_column_orderby' );
		$this->loader->add_filter( 'request', $plugin_admin, 'gtf_course_capacity_column_orderby' );
		// Implement export functionality
		// add export bulk action at couse list page
		$this->loader->add_action('admin_footer-edit.php', $plugin_admin, 'add_bulk_admin_action_export');
		$this->loader->add_action('load-edit.php', $plugin_admin, 'custom_bulk_action_exportation');
		$this->loader->add_action('admin_notices', $plugin_admin, 'custom_bulk_admin_notices');

		// student list in administration
		$this->loader->add_action('admin_menu', $plugin_admin, 'gtf_student_option');

		//Add field for student(user) profile page on user profile
		$this->loader->add_action('show_user_profile', $plugin_admin, 'gtf_student_fields_show' );
		$this->loader->add_action('edit_user_profile', $plugin_admin, 'gtf_student_fields_show' );
		$this->loader->add_action('personal_options_update', $plugin_admin, 'gtf_student_fields_save' );
		$this->loader->add_action('edit_user_profile_update', $plugin_admin, 'gtf_student_fields_save' );

		$this->loader->add_action('admin_head', $plugin_admin, 'move_subtitle_field');

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Course_Registration_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_filter( 'template_include', $plugin_public, 'load_templates');
		$this->loader->add_filter('query_vars', $plugin_public, 'add_query_vars');
		$this->loader->add_action( 'registration_form_include', $plugin_public, 'custom_registration_function');
		$this->loader->add_action( 'cancel_form_include', $plugin_public, 'custom_cancel_function');

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Plugin_Name_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
