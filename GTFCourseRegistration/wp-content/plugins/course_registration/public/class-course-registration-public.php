<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    course_registration
 * @subpackage course_registration/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    course_registration
 * @subpackage course_registration/public
 * @author     Your Name <email@example.com>
 */
class Course_Registration_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/course-registration-public.css', array(), $this->version, 'all' );
		// Include stylesheets for Fontello
		wp_enqueue_style( 'fontello-style', plugin_dir_url( __FILE__ ) . 'css/cr-font.css' );
		wp_enqueue_style( 'fontello-style-animation', plugin_dir_url( __FILE__ ) . 'css/animation.css' );

		/**
		 * Precisely load stylesheet for different Pages 
		 */
		// Course Detail Page
		if ( is_singular('course')) {
			// Stylesheet required by addtocalendar plugin
			wp_enqueue_style( 'addtocalendar-style', 'http://addtocalendar.com/atc/1.5/atc-style-blue.css' );
		}
	
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/course-registration-public.js', array( 'jquery' ), $this->version, false );

		/**
		 * Precisely load scripts for different Pages 
		 */
		// Course Detail Page
		global $wp;
		if ( is_singular('course')) {
			// Prepare Variables
			$location = get_field('course_address'); 
			$date = DateTime::createFromFormat('Ymd', get_field('start_date'));
			$params = array (
				'lat' => $location['lat'],
				'lng' => $location['lng'],
			);
			// Load Google Map API
			wp_enqueue_script( 'google-map-api', 'https://maps.googleapis.com/maps/api/js' );	
			wp_enqueue_script( 'course-registration-single', plugin_dir_url( __FILE__ ) . 'js/course-registration-single.js', array( 'jquery' ), $this->version, false );
			wp_localize_script( 'course-registration-single', 'course_params', $params);

			// if ( isset ( $wp -> query_vars [ 'register' ] ) ) {
			// 	wp_enqueue_script( 'bootstrap_wizard', plugin_dir_url( __FILE__ ) . 'js/jquery.bootstrap.wizard.min.js' );
			// }
		} 
	}

	/**
	 * Check the type of the page/post being viewed and load the corresponding template
	 *
	 * @param  $template
	 *
	 * @return $template 
	 */
	public function load_templates( $template ) {
		 
		global $wp;
	    global $wp_query;

		// Post Type
		if ( is_page('course-list') ) {
			return $this->course_registration_get_template_hierarchy( 'course-registration-page' );
		} elseif ( is_singular('course') ) {
			if ( isset( $wp -> query_vars[ 'register' ] ) ) {
				return $this->course_registration_get_template_hierarchy( 'course-registration-application' );	
			} elseif (isset( $wp -> query_vars[ 'cancel' ] ) ) {
				return $this->course_registration_get_template_hierarchy( 'course-registration-cancel' );
			} else {
				return $this->course_registration_get_template_hierarchy( 'course-registration-single' );	
			}
		}

		return $template;
	}

	/**
	 * Register new variables that will be passed via URL
	 *
	 * @param  $vars
	 * @return $vars - updated 
	 */
	public function add_query_vars($vars) {
		// register variable to trigger the registration process
	    $new_vars = array('register','cancel','uid');
	    $vars = $new_vars + $vars;

	    return $vars;
	}

	/**
	 * Function that register all functions related to registration
	 *
	 * @param
	 * @return
	 */
	public function custom_registration_function($c_id) {
		global $email, $first_name, $last_name, $last_4_ssn, $degree, $job_title, $work_facility, $dietary_needs,
			$address_line_1, $address_line_2, $city, $county, $state, $zip, $phone, $years_exp, $worked_dept,
			$course_id, $reg_errors;
			
		if ( isset( $_POST['btn-submit'] ) ) {
			$this->registration_validation (
				$_POST['email'],
				array (
					$_POST['first-name'],
					$_POST['last-name'],
					$_POST['last-4-ssn'],
					$_POST['degree'],
					$_POST['job-title'],
					$_POST['work-facility'],
					$_POST['address-line-1'],
					$_POST['city'],
					$_POST['state'],
					$_POST['zip'],
					$_POST['phone'],
					$_POST['years-exp'],
					$_POST['worked-dept']
				)
			);

			$course_id = $c_id;

			$email = sanitize_email( $_POST['email'] );
			$first_name = sanitize_text_field( $_POST['first-name'] );
			$last_name = sanitize_text_field( $_POST['last-name'] );
			$last_4_ssn = sanitize_text_field( $_POST['last-4-ssn']);
			$degree = sanitize_text_field( $_POST['degree'] );
			$job_title = sanitize_text_field( $_POST['job-title'] );
			$work_facility = $_POST['work-facility'];
			$dietary_needs = sanitize_text_field($_POST['dietary-needs']);
			$address_line_1 = sanitize_text_field( $_POST['address-line-1'] );
			$address_line_2 = sanitize_text_field( $_POST['address-line-2'] );
			$city = sanitize_text_field( $_POST['city'] );
			$county = $_POST['county'];
			$state = $_POST['state'];
			$zip = sanitize_text_field( $_POST['zip'] );
			$phone = sanitize_text_field( $_POST['phone'] );
			$years_exp = $_POST['years-exp'];
			$worked_dept = $_POST['worked-dept'];

			if ( 1 > count( $reg_errors->get_error_messages() ) ) {
				$this->complete_registration();
			} else {
				$this->registration_form(
					$email,
					$first_name,
					$last_name,
					$last_4_ssn, $degree, $job_title, $work_facility, $dietary_needs,
			$address_line_1, $address_line_2, $city, $state, $zip, $phone, $years_exp, $worked_dept, $county
				);
			}
		} else {

			$this->registration_form(
					$email,
					$first_name,
					$last_name,
					$last_4_ssn, $degree, $job_title, $work_facility, $dietary_needs,
			$address_line_1, $address_line_2, $city, $state, $zip, $phone, $years_exp, $worked_dept, $county
			);

		}

	}
	/**
	 * Function that register all functions related to cancellation
	 *
	 * @param
	 * @return
	 */
	public function custom_cancel_function($c_id) {
		global $email, $course_id, $uid, $wp_query;
		$course_id = $c_id;
		if ( isset( $_POST['btn-submit'] ) && isset($wp_query->query_vars['uid']) ) {
			$this->cancel_validation (
				$_POST['email']
			);

			$email = sanitize_email( $_POST['email'] );
			
			$uid =  $wp_query->query_vars['uid'];
			$this->cancel_registration (
				$email,
				$uid,
				$course_id
			);

		} else {
			$this->cancel_form(
				$email,
				$course_id
			);

		}

	}




	/************************
	 *
	 * Local Helper Functions
	 *
	 ************************/

	/**
	 * Helper function for getting the template hierarchy
	 *
	 * @param  $template
	 * @return $template
	 */
	function course_registration_get_template_hierarchy( $template ) {
		 
		// Get the template slug
	    $template_slug = rtrim( $template, '.php' );
	    $template = $template_slug . '.php';
	    // Check if a custom template exists in the theme folder, if not, load the plugin template file
	    $file = dirname(__FILE__) . '/partials/' . $template;
	    return apply_filters( 'course_registration_repl_template_' . $template, $file );
	}

	/**
	 * Function used to print the skeleton of the registration form
	 *
	 * @param  $email
	 * @param  $first_name
	 * @param  $last_name
	 *
	 */
	function registration_form($email,$first_name,$last_name,$last_4_ssn, $degree, $job_title, $work_facility,$dietary_needs,
			$address_line_1, $address_line_2, $city, $state, $zip, $phone, $years_exp, $worked_dept, $county) {
		include(plugin_dir_path(__FILE__).'/partials/course-registration-form.php');
	}

	/**
	 * Function used to print the skeleton of the cancel form
	 *
	 * @param  $email
	 *
	 */
	function cancel_form($email,$course_id) {

		$date = get_post_meta($course_id, 'start_date', true);
		if ( empty($date) ) {
			echo '
				<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
					<p class="cr-cancel-form-title">Please type your email address used for the registration to confirm.</p>
					<input id="email" name="email" type="email" placeholder="Your Email" class="form-control input-md" required="" value="'.(isset($_POST['email']) ? $email : null).'">
					<button id="btn-submit" name="btn-submit" class="btn btn-primary cr-btn-cancel-registration">Cancel Registration</button>
				</form>
			';
		} else {
			$course_date = DateTime::createFromFormat('Y/m/d', $date);
			$today = date("Ymd");
			$course_list_url = get_the_permalink(get_page_by_path('course-list'));
			if ($today < $course_date) {
				echo '
					<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
						<p class="cr-cancel-form-title">Please type your email address used for the registration to confirm.</p>
						<input id="email" name="email" type="email" placeholder="Your Email" class="form-control input-md" required="" value="'.(isset($_POST['email']) ? $email : null).'">
						<button id="btn-submit" name="btn-submit" class="btn btn-primary cr-btn-cancel-registration">Cancel Registration</button>
					</form>
				';
			} else {
				echo '
			    <div class="alert alert-warning" role="alert">Sorry, you cannot cancel the program now.</div>
				<a href="'.$course_list_url.'" class="btn btn-primary cr-btn-back-home">Back to Program List</a>
			    ';
			}	
		}
	}

	/**
	 * Validation function - using WP_Error 
	 *
	 * @param  $email
	 * @param  $first_name
	 * @param  $last_name
	 *
	 */
	function registration_validation( $p_email, $info)  {
		
		global $reg_errors;
		$reg_errors = new WP_Error;

		if ( empty( $p_email )) {
			
			$reg_errors->add('field', 'Required form field is missing');
		
		} else {
			$is_all_filled = true;
			foreach ($info as $value) {
				if (empty($value)) {
					$is_all_filled = false;
				}
			}
			if (!$is_all_filled) {
				$reg_errors->add('field', 'Required form field is missing');
			}
			if ( !is_email( $p_email ) ) {
			   $reg_errors->add( 'email_invalid', 'Email is not valid' );
			}
		}

		if ( count( $reg_errors->get_error_messages() ) > 1 ){
 			echo "<div class='alert alert-danger'>";
		    foreach ( $reg_errors->get_error_messages() as $error ) {
		     
		        echo '<div>';
		        echo $error . '<br/>';
		        echo '</div>';
		         
		    }
		 	echo "</div>";
		}

	}
	/**
	 * Validation function - using WP_Error 
	 *
	 * @param  $email
	 *
	 */
	function cancel_validation( $email )  {
		
		global $reg_errors;
		$reg_errors = new WP_Error;

		if ( empty( $email )) {
			
			$reg_errors->add('field', 'Required form field is misisng');
		
		}

		if ( !is_email( $email ) ) {
		
		    $reg_errors->add( 'email_invalid', 'Email is not valid' );
		
		}

		if ( count( $reg_errors->get_error_messages() ) > 1 ){

 			echo "<div class='alert alert-danger'>";
		    foreach ( $reg_errors->get_error_messages() as $error ) {
		     
		        echo '<div>';
		        echo $error . '<br/>';
		        echo '</div>';
		         
		    }
		 	echo "</div>";
		}
	}

	/**
	 * Function that handles the user registration 
	 *
	 * @param  $email
	 * @param  $first_name
	 * @param  $last_name
	 *
	 */
	function complete_registration() {
		global $email, $first_name, $last_name, $last_4_ssn, $degree, $job_title, $work_facility,$dietary_needs,
			$address_line_1, $address_line_2, $city, $county, $state, $zip, $phone, $years_exp, $worked_dept,
			$course_id, $reg_errors;
		
		 $cur_seats_str = get_post_meta($course_id,'available_seats',true);
		 $cur_seats = intval($cur_seats_str);
		 $course_list_url = get_the_permalink(get_page_by_path('course-list'));
		    
		if ( $cur_seats > 0 ) {

			// Create user data that is required but not collected yet
			$username = $email;
			$password = $username;
			$website = $username;
			$nickname = preg_replace('/\s+/', ' ', $first_name.'_'.$last_name);
			$nickname = strtolower($nickname);
			$bio = $username;
			$role = 'subscriber';

			$userdata  = array (
				'user_login'    =>   $username,
		        'user_email'    =>   $email,
		        'user_pass'     =>   $password,
		        'user_url'      =>   $website,
		        'first_name'    =>   $first_name,
		        'last_name'     =>   $last_name,
		        'nickname'      =>   $nickname,
		        'description'   =>   $bio,
		        'role'			=>   $role
			);

			if( ! email_exists( $email ) ) {
				$user = wp_insert_user( $userdata );

				if ( is_wp_error( $user) ) {  
					echo '
				    <div class="alert alert-danger" role="alert">'. $user->get_error_message() .'</div>
					<a href="'.$course_list_url.'" class="btn btn-primary cr-btn-back-home">Back to Program List</a>
				    ';
				}
			}
		
			$user = get_user_by( 'email', $email);
			$user_id = $user->ID;

			$courses_id = get_user_meta($user_id, 'registed_courses', true);

			if ( (empty($courses_id)) || (! in_array($course_id, $courses_id )) ) {
				if ( empty($courses_id) ) {
					// Create an array if the user never registered any course
					$courses_id = array ();
				} 
				// Add the course id into the array if the user has not registered this course
				array_push($courses_id, $course_id);
				update_user_meta( $user_id, 'registed_courses', $courses_id );

				global $STATE_LIST, $WORK_FACILITY, $YEAR_OF_EXPERIENCE, $COUNTY_LIST;

				// Update all user information 
				update_user_meta( $user_id, 'last_4_ssn', $last_4_ssn);
				update_user_meta( $user_id, 'cellphone', $phone);
				update_user_meta( $user_id, 'address1', $address_line_1);
				update_user_meta( $user_id, 'address2', $address_line_2);
				update_user_meta( $user_id, 'city', $city);
				update_user_meta( $user_id, 'county', $COUNTY_LIST[$county]);
				update_user_meta( $user_id, 'state', $STATE_LIST[$state]);
				update_user_meta( $user_id, 'zipcode', $zip);
				update_user_meta( $user_id, 'degree', $degree);
				update_user_meta( $user_id, 'work_facility', $WORK_FACILITY[$work_facility]);
				update_user_meta( $user_id, 'work_department', $worked_dept);
				update_user_meta( $user_id, 'job_title', $job_title);
				update_user_meta( $user_id, 'dietary_needs', $dietary_needs);
				update_user_meta( $user_id, 'year_of_experience', $YEAR_OF_EXPERIENCE[$years_exp]);

				echo '
			    <div class="alert alert-success" role="alert">Great! Your registration has been completed!.</div>
				<a href="'.$course_list_url.'" class="btn btn-primary cr-btn-back-home">Back to Program List</a>
			    ';
			   
			   // Send Confirmation Email
				$course_name = get_the_title($course_id);
			    $post_url = get_the_permalink($course_id);
			   	$to = $email;
			    $subject = "Program Registration Confirmation";
			    $headers = array('Content-Type: text/html; charset=UTF-8','Bcc:contact@georgiatraumafoundation.org');
			    $message = '';		    
				 // Assign Email HTML Template to Message
			    include(plugin_dir_path(__FILE__).'/partials/email_confirmation.php');
			    $is_sent = wp_mail( $to, $subject, $message, $headers); 
			    
			    // Update Avaiable Seats
			     $updated_seats = $cur_seats - 1;
			    update_post_meta($course_id,'available_seats',$updated_seats);
			  
			} else {
				echo '
			    <div class="alert alert-warning" role="alert">Sorry, you have already registered this program.</div>
				<a href="'.$course_list_url.'" class="btn btn-primary cr-btn-back-home">Back to Program List</a>
			    ';
			}
		} else {
			echo '
		    <div class="alert alert-danger" role="alert">No Available Seats!</div>
			<a href="'.$course_list_url.'" class="btn btn-primary cr-btn-back-home">Back to Program List</a>
		    ';
		}
	}

	/**
	 * Function that handles cancelliing registration 
	 *
	 *
	 */
	function cancel_registration() {
		
		global $reg_errors, $email, $course_id, $uid;
		$cur_seats_str = get_post_meta($course_id,'available_seats',true);
		$cur_seats = intval($cur_seats_str);
		$total_seats_str = get_post_meta($course_id,'course_capacity',true);
		$total_seats = intval($total_seats_str);
		$course_list_url = get_the_permalink(get_page_by_path('course-list'));
		$course_url = get_the_permalink($course_id);

		$cancel_url = '';
		if ( false === strpos($course_url, '?') ) {
		    $cancel_url = $course_url.'?uid='.$uid.'&cancel';
		} else {
		    $cancel_url = $course_url.'&uid='.$uid.'&cancel';
		}
		
		$user = get_user_by('email',$email);
		$uid_by_email = $user->ID;

		if ( 1 > count( $reg_errors->get_error_messages() )) {
			if ( $uid != $uid_by_email) {
				echo '
			    <div class="alert alert-warning" role="alert">
			    	Sorry, you did not register for the program or your registration has been cancelled.
			    </div>
			    <a href="'.$cancel_url.'" class="btn btn-primary cr-btn-retry">Retry</a>
				<a href="'.$course_list_url.'" class="btn btn-primary cr-btn-back-home">Back to Program List</a> 
			    ';
			} else {
				$courses_id = get_user_meta($uid, 'registed_courses', true);
				if ( empty($courses_id) ) {
					echo '
				    <div class="alert alert-warning" role="alert">
				    	Sorry, you did not register for the program or your registration has been cancelled.
				    </div>
				    <a href="'.$cancel_url.'" class="btn btn-primary cr-btn-retry">Retry</a>
					<a href="'.$course_list_url.'" class="btn btn-primary cr-btn-back-home">Back to Program List</a> 
				    ';
				} elseif (! in_array($course_id, $courses_id ) ) {
					echo '
				     <div class="alert alert-warning" role="alert">
				    	Sorry, you did not register for the program or your registration has been cancelled.
				    </div>
				    <a href="'.$cancel_url.'" class="btn btn-primary cr-btn-retry">Retry</a>
					<a href="'.$course_list_url.'" class="btn btn-primary cr-btn-back-home">Back to Program List</a> 
				    ';
				} else {
					$index = array_search($course_id, $courses_id);
					unset($courses_id[$index]);
					update_user_meta( $uid, 'registed_courses', $courses_id );

					// Update avaiable seats
				    $updated_seats = ($cur_seats < $total_seats) ?  ($cur_seats + 1) : $total_seats;
				    update_post_meta($course_id,'available_seats',$updated_seats);
					
					echo '
				    <div class="alert alert-success" role="alert">Great! Your registration has been cancelled!.</div>
					<a href="'.$course_list_url.'" class="btn btn-primary cr-btn-back-home">Back to Program List</a>
				    ';
				}
			}
		} else {
			echo '
		    <div class="alert alert-danger" role="alert">'.$reg_errors->message.'</div>
			<a href="'.$course_list_url.'" class="btn btn-primary cr-btn-back-home">Back to Program List</a>
		    ';
		}	
	}
}
