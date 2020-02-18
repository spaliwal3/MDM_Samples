<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    course_registration
 * @subpackage course_registration/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    course_registration
 * @subpackage course_registration/admin
 * @author     Your Name <email@example.com>
 */
class Course_Registration_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * load dependencies from eventbrite class
	 *
	 * @since  1.0.0
	 */
	public function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/eventbrite/class-eventbrite-event.php';
	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style(
			"gtf-admin-css",
			plugin_dir_url( __FILE__ ) . 'css/course-registration-admin.css',
			array(),
			$this->version,
			'all' );
        wp_enqueue_style(
            "gtf-timepicker-css",
            plugin_dir_url( __FILE__ ) . 'css/jquery.timepicker.css',
            array(),
            $this->version,
            'all' );
        wp_enqueue_style(
            "gtf-datepicker-css",
            plugin_dir_url( __FILE__ ) . 'css/bootstrap-datepicker.css',
            array(),
            $this->version,
            'all' );
        wp_enqueue_style(
            "gtf-datetimepicker-css",
            plugin_dir_url( __FILE__ ) . 'css/bootstrap-datetimepicker.min.css',
            array(),
            $this->version,
            'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

        wp_enqueue_script('bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
        wp_enqueue_script('timepicker-js', 'https://jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"');
		wp_enqueue_script( 'course-registration-admin',  plugin_dir_url( __FILE__ ) . 'js/course-registration-admin.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script('datetimepicker-js', plugin_dir_url( __FILE__ ) . 'js/bootstrap-datepicker.js', array( 'jquery' ), $this->version, false );
         wp_enqueue_script('datapair-js', plugin_dir_url( __FILE__ ) . 'js/datepair.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 ******* This section is for student list under course. ******
	 */

	/**
	 * Add student list page under course menu.
	 *
	 */
	public function gtf_student_option(){
		add_submenu_page( 'edit.php?post_type=course',
						 'Student',
						 'Student',
						 'manage_options',
						 __FILE__.'gtf_studnet_list',
						 array( $this, 'gtf_student_list_page'));
	}

	// Display the student table list
	function gtf_student_list_page(){
		if ( !current_user_can( 'manage_options' ) )
		{
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		$students = get_users( 'role=subscriber' );
		write_log($students);


		// Find corresponding include path.
		set_include_path( plugin_dir_path(__FILE__) . 'partials');
		// Display the content
		include 'gtf-student-list-display.php';
	}

	/*
	 * Modify user model to add more field for student profile
	 *
	 * @since 1.0.0
	 *
	 */
	public function gtf_student_fields_show($user){
        //Find corresoonding include path.
        set_include_path( plugin_dir_path(__FILE__) . 'partials');
        //Display the content
        include 'gtf-student-additional-info.php';
	}

	public function gtf_student_fields_save( $user_id )
	{
	    if ( !current_user_can( 'edit_user', $user_id ) )
	        return false;
	    /* Update the content of student profile for user model*/
        if (isset ($_POST['cellphone'])){
            update_user_meta($user_id, 'cellphone', $_POST['cellphone']);
        }
	    if (isset( $_POST['last_4_ssn'])){
	    	update_user_meta( $user_id, 'last_4_ssn', $_POST['last_4_ssn']);
	    }
	    if (isset( $_POST['address1'])){
	   		update_user_meta( $user_id, 'address1', $_POST['address1'] );
	   	}
        if (isset( $_POST['address2'])){
            update_user_meta( $user_id, 'address2', $_POST['address2'] );
        }
        if (isset( $_POST['city'])){
            update_user_meta( $user_id, 'city', $_POST['city'] );
        }
        if (isset( $_POST['county'])){
            update_user_meta( $user_id, 'county', $_POST['county'] );
        }
        if (isset( $_POST['state'])){
            update_user_meta( $user_id, 'state', $_POST['state'] );
        }
        if (isset( $_POST['zipcode'])){
            update_user_meta( $user_id, 'zipcode', $_POST['zipcode'] );
        }
        if (isset( $_POST['degree'])){
            update_user_meta( $user_id, 'degree', $_POST['degree'] );
        }
        if (isset( $_POST['work_facility'])){
            update_user_meta( $user_id, 'work_facility', $_POST['work_facility'] );
        }
        if (isset( $_POST['previous_work_facility'])){
            update_user_meta( $user_id, 'previous_work_facility', $_POST['previous_work_facility'] );
        }
        if (isset( $_POST['work_department'])){
            update_user_meta( $user_id, 'work_department', $_POST['work_department'] );
        }
	   	if(isset( $_POST['job_title'])){
		    update_user_meta( $user_id, 'job_title', $_POST['job_title'] );
		}
		if(isset( $_POST['dietary_needs'])){
	 	    update_user_meta( $user_id, 'dietary_needs', $_POST['dietary_needs'] );
		}
		if(isset( $_POST['registed_courses'])){
            // get original course ids
            $original_courses_ids = get_user_meta($user_id, 'registed_courses', true);
            // release one seats for orginal courses
            foreach($original_courses_ids as $cid)
            {
                // Update Avaiable Seats by add 1
                $cur_seats = intval(get_post_meta($cid,'available_seats',true));
                $updated_seats = $cur_seats + 1;
                update_post_meta($cid, 'available_seats', $updated_seats);
            }
			update_user_meta( $user_id, 'registed_courses', $_POST['registed_courses'] );
            // update availibity by minus 1
            foreach($_POST['registed_courses'] as $cid)
            {
                $cur_seats = intval(get_post_meta($cid,'available_seats',true));
                $updated_seats = $cur_seats - 1;
                update_post_meta($cid, 'available_seats', $updated_seats);
            }
		}
        else
        {
            $original_courses_ids = get_user_meta($user_id, 'registed_courses', true);
            // release one seats for orginal courses
            foreach($original_courses_ids as $cid)
            {
                // Update Avaiable Seats by add 1
                $cur_seats = intval(get_post_meta($cid,'available_seats',true));
                $updated_seats = $cur_seats + 1;
                update_post_meta($cid, 'available_seats', $updated_seats);
            }
            $registed_courses = [];
            update_user_meta( $user_id, 'registed_courses', $registed_courses);
        }
        if(isset( $_POST['year_of_experience'])){
            update_user_meta($user_id, 'year_of_experience', $_POST['year_of_experience']);
        }

		// need to update after combine with registration process !!
	}

    // insert item in course_student_relation table
    function insert_course_student_relation($course_id, $student_id, $status='registrated'){
        global $wpdb;
        $table_name = $wpdb->prefix . 'coursestudentrelation';
        $wpdb ->insert(
            $table_name,
            array(
                'course_id' => $course_id,
                'student_id' => $student_id,
                'status' => $status,
            )
        );
    }

    /**
     * create food preference  field for course post type.
     */
    public function gtf_course_subtitle_create(){
        write_log("Create field function");
        add_meta_box('course-subtitle-meta',
                     'Program Subtitle',
                     array($this, 'gtf_course_subtitle_display'),
                     'course',
                     'normal',
                     'high' );
    }

    function gtf_course_subtitle_display($post){

        // retrive the metadata values if they exists
        $course_subtitle = get_post_meta($post->ID, '_course_subtitle', true);
        ?>
        <p> <input id="course_subtitle" type="text" name="course_subtitle" value="<?php echo esc_attr($course_subtitle); ?>" placeholder="Enter subtitle here"/> </p>
    <?php
    }

    function move_subtitle_field() {
        write_log("Load move function");
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                $ = jQuery;
                $("#course-subtitle-meta").prependTo("#postdivrich");
            });
        </script>
        <?php
    }

    function gtf_course_subtitle_meta($post_id){
        //verify the data is setted
        if (isset($_POST['course_subtitle'])){
            //save meta
            update_post_meta($post_id,
                             '_course_subtitle',
                             strip_tags($_POST['course_subtitle']));
            update_post_meta($post_id,
                             'course_subtitle',
                             strip_tags($_POST['course_subtitle']));
        }
    }

	/**
	 * create available seats field for course post type.
	 */
	public function gtf_course_capacity_create(){
		add_meta_box('course_capacity-meta',
					 'Program Capacity',
					 array($this, 'gtf_course_capacity_function'),
					 'course',
					 'side',
					 'high',
                     null );

	}

	function gtf_course_capacity_function($post){

		// retrive the metadata values if they exists
		$course_capacity = get_post_meta($post->ID, '_course_capacity', true);
		?>
		<p><b>Number of Seats:</b> <input type="text" name="course_capacity" value="<?php echo esc_attr($course_capacity); ?>" /> </p>
        <h6>Please fill out the how many seats will be available for this program.</h6>
	<?php
	}

	function gtf_course_capacity_save_meta($post_id){
		//verify the data is setted
		if (isset($_POST['course_capacity'])){
            $course_capacity = get_post_meta($post_id, '_course_capacity', true);
            $available_seats = get_post_meta($post_id, 'available_seats', true);
            $new_capacity = intval(strip_tags($_POST['course_capacity']));

            update_post_meta($post_id,
                             '_course_capacity',
                             $new_capacity);
            update_post_meta($post_id,
                             'course_capacity',
                             $new_capacity);
            if (empty($available_seats)) {
                update_post_meta($post_id,
                             'available_seats',
                             $new_capacity);
            } else {
                $registered = $course_capacity - $available_seats;
                $new_available = $new_capacity - $registered;
                if ($new_available < 0) {
                    update_post_meta($post_id,
                             'available_seats',0);
                } else {
                    update_post_meta($post_id,
                             'available_seats',
                             $new_available);
                }
            }
		}
	}

	/**
	 * create available seats field for course post type.
	 */
	public function gtf_deposit_amount_create(){
		add_meta_box('deposit-amount-meta',
					 'Deposit Amount',
					 array($this, 'gtf_deposit_amount_display'),
					 'course',
					 'side',
					 'high' );
	}

    function gtf_deposit_amount_display($post){
        // retrive the metadata values if they exists
        $deposit_amount = get_post_meta($post->ID, '_deposit_amount', true);
        ?>
        <p><b>Deposit Amount ($):</b> <input type="text" name="deposit_amount" value="<?php echo esc_attr($deposit_amount); ?>" /> </p>
        <h6>Please fill out the amount of deposit.</h6>
    <?php
    }

    function gtf_deposit_amount_save_meta($post_id){
        //verify the data is setted
        if (isset($_POST['deposit_amount'])){
            //save meta
            update_post_meta($post_id,
                             '_deposit_amount',
                             strip_tags($_POST['deposit_amount']));
            update_post_meta($post_id,
                             'deposit_amount',
                             strip_tags($_POST['deposit_amount']));
        }
    }

    /**
     * create food preference  field for course post type.
     */
    public function gtf_food_preference_create(){
        add_meta_box('food-preference-meta',
                     'Food Preference',
                     array($this, 'gtf_food_preference_display'),
                     'course',
                     'advanced',
                     'high' );

    }

    function gtf_food_preference_display($post){

        // retrive the metadata values if they exists
        $food_preference = get_post_meta($post->ID, '_food_preference', true);
        ?>
        <p> <input id="food_preference" type="text" name="food_preference" value="<?php echo esc_attr($food_preference); ?>" /> </p>
    <?php
    }

    function gtf_food_preference_meta($post_id){
        //verify the data is setted
        if (isset($_POST['food_preference'])){
            //save meta
            update_post_meta($post_id,
                             '_food_preference',
                             strip_tags($_POST['food_preference']));
            update_post_meta($post_id,
                             'food_preference',
                             strip_tags($_POST['food_preference']));
        }
    }

    /**
     * create payment preference field for course post type.
     */
    public function gtf_payment_preference_create(){
        add_meta_box('payment-preference-meta',
                     'Payment Preference',
                     array($this, 'gtf_payment_preference_display'),
                     'course',
                     'advanced',
                     'high' );

    }

    function gtf_payment_preference_display($post){

        // retrive the metadata values if they exists
        $payment_preference = get_post_meta($post->ID, '_payment_preference', true);
        ?>
        <p> <input id="payment_preference" type="text" name="payment_preference" value="<?php echo esc_attr($payment_preference); ?>" /> </p>
    <?php
    }

    function gtf_payment_preference_meta($post_id){
        //verify the data is setted
        if (isset($_POST['payment_preference'])){
            //save meta
            update_post_meta($post_id,
                             '_payment_preference',
                             strip_tags($_POST['payment_preference']));
            update_post_meta($post_id,
                             'payment_preference',
                             strip_tags($_POST['payment_preference']));
        }
    }

	/**
	 * Add custom field via advanced custom field in course post type
	 */
	// Add date of the course
    public function gtf_course_date_time_create(){
        add_meta_box('course-data-time-meta',
                     'Date & Time',
                     array($this, 'gtf_start_date_time_display'),
                     'course',
                     'advanced',
                     'high' );
    }

    // add start time picker
    function gtf_start_date_time_display($post){
        // retrive the metadata values if they exists
        $start_date = get_post_meta($post->ID, 'start_date', true);
        $start_time = get_post_meta($post->ID, 'start_time', true);

        $end_date = get_post_meta($post->ID, 'end_date', true);
        $end_time = get_post_meta($post->ID, 'end_time', true);

        $is_scheduled = get_post_meta($post->ID, 'is_scheduled', true);
        date_default_timezone_set('America/New_York');

        if (!$start_date){
            $datetime = new DateTime();
            $start_date = $datetime->format('Y/m/d');
        }

        if (!$end_date) {
        	$end_date = $start_date;
        }

        // set default time
        if(!$start_time){
            $start_time = '9:00am';
        }

        if(!$end_time){
            $end_time = $start_time;
        }

        if(!$is_scheduled) {
            $is_scheduled = 0;
        }
        ?>
        <div id='dateTime' class="row">
            <div class="col-md-4">
                <input id="is_scheduled" type="checkbox" name="is_scheduled" value="1" <?php if ($is_scheduled == 1) { echo "checked"; }?>/>
                <label for="is_scheduled">No schedule yet</label>
            </div>
        	<div class="start-datetime col-md-4">
        		<label>Starts</label>
        		<div>
        			<input type="text" id="start_date" name="start_date" class="date start" value="<?php echo esc_attr($start_date); ?>" />
    				<input type="text" id="start_time" name="start_time" class="time start" value="<?php echo esc_attr($start_time); ?>" />
    			</div>
        	</div>
        	<div class="end-datetime col-md-4">
        		<label>Ends</label>
        		<div>
        			<input type="text" id="end_date" name="end_date" class="date end" value="<?php echo esc_attr($end_date); ?>" />
    				<input type="text" id="end_time" name="end_time" class="time end" value="<?php echo esc_attr($end_time); ?>" />
    			</div>
        	</div>
        </div>
        <script>
            jQuery(document).ready(function(){
                $ = jQuery;
                $('#dateTime .date').datepicker({
                    'format': 'yyyy/mm/dd',
                    'autoclose': true
                });

                $('#dateTime  .time').timepicker({
                    'showDuration': true,
                    'timeFormat': 'g:ia'
                });
            });
        </script>
    <?php
    }

    // // Need to fix the bug of date & time save
    function gtf_course_date_time_save_meta($post_id){
        if (isset($_POST['is_scheduled'])) {
            update_post_meta($post_id,
                            'is_scheduled',
                            $_POST['is_scheduled']);
        } else {
            //verify the data is setted
            if (isset($_POST['start_date'])){
                //save meta
                update_post_meta($post_id,
                                 'start_date',
                                 strip_tags($_POST['start_date']));
                update_post_meta($post_id,
                                 '_start_date',
                                 strip_tags($_POST['start_date']));
            }
            if (isset($_POST['start_time']))
            {
                update_post_meta($post_id,
                                 'start_time',
                                 strip_tags($_POST['start_time']));
                update_post_meta($post_id,
                                 '_start_time',
                                 strip_tags($_POST['start_time']));
            }
            if (isset($_POST['end_date'])){
                //save meta
                update_post_meta($post_id,
                                 'end_date',
                                 strip_tags($_POST['end_date']));
                update_post_meta($post_id,
                                 '_end_date',
                                 strip_tags($_POST['end_date']));
            }
            if (isset($_POST['end_time']))
            {
                update_post_meta($post_id,
                                 'end_time',
                                 strip_tags($_POST['end_time']));
                update_post_meta($post_id,
                                 '_end_time',
                                 strip_tags($_POST['end_time']));
            }
        }
    }

	/**
	 * Input address by google map
	 */
	public function gtf_course_address_create(){
		if( function_exists('acf_add_local_field_group') ):
			acf_add_local_field_group(array (
				'key' => 'group_562ed9adde099',
				'title' => 'Address',
				'fields' => array (
					array (
						'key' => 'field_gtf_course_address',
						// 'label' => 'Address',
						'name' => 'course_address',
						'type' => 'google_map',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'center_lat' => '',
						'center_lng' => '',
						'zoom' => '',
						'height' => '',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'course',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
			));

			endif;
	}

	function gtf_course_google_map_address_save_meta($post_id){
		// bail early if no ACF data
	    if( empty($_POST['acf']) ) {
	        return;
	    }


	    // array of field values
	    $fields = $_POST['acf'];


	    // specific field value
	    $field = $fields['field_gtf_course_address'];

		//verify the data is setted
		if (isset($field)){
			//save meta
			update_post_meta($post_id,
							 '_course_address',
							 $field);
			update_post_meta($post_id,
							 'course_address',
							 $field);
		}
	}

	/**
	 * image field for course post type
	 */
	public function gtf_course_image_create(){
		if( function_exists('acf_add_local_field_group') ):
			acf_add_local_field_group(array (
				'key' => 'group_8dmvib7kzvo7',
				'title' => 'Program Image',
				'fields' => array (
					array (
						'key' => 'field_gtf_course_image',
						// 'label' => 'image',
						'name' => 'course_image',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'center_lat' => '',
						'center_lng' => '',
						'zoom' => '',
						'height' => '',
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'course',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
			));
			endif;
	}

	function gtf_course_image_save_meta($post_id){
		// bail early if no ACF data
	    if( empty($_POST['acf']) ) {
	        return;
	    }


	    // array of field values
	    $fields = $_POST['acf'];


	    // specific field value
	    $field = $fields['field_gtf_course_image'];

		//verify the data is setted
		if (isset($field)){
			//save meta
			update_post_meta($post_id,
							 '_course_image',
							 $field);
			update_post_meta($post_id,
							 'course_image',
							 $field);
		}
	}

	/**
	 * Send event to eventBrite via API, when post is saved.
	 * if the event is not exists, create new event; if the event has
	 * already existed, update data to eventbrite site.
	 *
	 */
	function gtf_course_push_to_eventbrite($post_id){
		// bail early if the post_type is not course
		if(!array_key_exists('post_type', $_POST) or $_POST['post_type'] !== 'course')
		{
			return;
		}
		$events = eventbrite()->post_event( $post_id );
	}

/**
 *  Customize the table header for course(customized post type)
 */
	function gtf_course_table_head($columns){
		return array_merge($columns,
							array(
						        'title' => __('Program'),
						        'start_date' => __('Starts at'),
						        'course_capacity' => __('Program Capacity'),
						        'available_seats' => __('Available Seats'),
						    ));
    return $columns;
	}

	function gtf_course_table_content($column, $post_id){
		 switch ( $column ) {
	        case 'start_date' :
	            $course_date = get_post_meta( $post_id, 'start_date', true );
      			echo  date( _x( 'd/m/Y', 'Program date format', 'textdomain' ), strtotime( $course_date ) );
	            break;
	        case 'course_capacity' :
	        	if (get_post_meta( $post_id , '_course_capacity' , true ) == null)
	        		echo __('0');
	            else
	            	echo get_post_meta( $post_id , '_course_capacity' , true );
	            break;
	        case 'available_seats' :
                if (!get_post_meta( $post_id , 'available_seats' , true ))
                    echo __('0');
                else
                    echo get_post_meta( $post_id , 'available_seats' , true );
                break;
	    }
	}

	function gtf_course_table_sorting($columns)
	{
		$columns['start_date'] = 'start_date';
		$columns['available_seats'] = 'available_seats';
        $columns['course_capacity'] = 'course_capacity';
		return $columns;
	}

	function gtf_course_available_seats_column_orderby($vars)
	{
		if ( isset( $vars['orderby'] ) && 'available_seats' == $vars['orderby'] ) {
		    $vars = array_merge( $vars, array(
		        'meta_key' => '_available_seats',
		        'orderby' => 'meta_value'
		    ) );
		}

		return $vars;
    }
    function gtf_course_capacity_column_orderby($vars)
    {
        if ( isset( $vars['orderby'] ) && 'course_capacity' == $vars['orderby'] ) {
            $vars = array_merge( $vars, array(
                'meta_key' => '_course_capacity',
                'orderby' => 'meta_value'
            ) );
        }

        return $vars;
    }

    // Implement exportation functionality
    /**
     * Step 1: add the custom Bulk Action to the select menus
     */
    function add_bulk_admin_action_export(){
        global $post_type;
        if($post_type == 'course') {
        ?>
        <script type="text/javascript">
          jQuery(document).ready(function() {
            jQuery('<option>').val('export').text('<?php _e('Export Student List')?>').appendTo("select[name='action']");
            jQuery('<option>').val('export').text('<?php _e('Export Student List')?>').appendTo("select[name='action2']");
          });
        </script>
        <?php
        }
    }
    /**
     * Step 2: handle the custom Bulk Action
     *
     * Based on the post http://wordpress.stackexchange.com/questions/29822/custom-bulk-action
     */
    function custom_bulk_action_exportation(){
        // get the action
        $wp_list_table = _get_list_table('WP_Posts_List_Table');
        $post_type = 'course';
        $action = $wp_list_table->current_action();

        $allowed_actions = array('export');
        if(!in_array($action, $allowed_actions)) return;

        //security check
        check_admin_referer('bulk-posts');

        // get all request ids.
        if(isset($_REQUEST['post'])){
            $post_ids = array_map('intval', $_REQUEST['post']);
        }
        if(empty($post_ids)) return;

        $sendback = remove_query_arg(array('exported', 'untrashed', 'deleted', 'ids'), wp_get_referer() );
        if(!sendback)
        {
            $sendback = admin_url("edit.php?post_type=$post_type");
        }

        $pagenum = $wp_list_table->get_pagenum();
        $sendback = add_query_arg('paged', $pagenum, $sendback);

        switch($action){
            case 'export':
                $exported = 0;
                foreach($post_ids as $post_id){
                    if(!$this->perform_export($post_id))
                    {
                        wp_die( __("Error exporting post."));
                    }
                    $exported++;
                }
                $sendback = add_query_arg(array('exported' => $exported, 'ids' => join(',', $post_ids)), $sendback);
                break;
            default; return;
        }
        $sendback = remove_query_arg(array('action', 'action2', 'tags_input', 'post_author', 'comment_status', 'ping_status', '_status', 'post', 'bulk_edit', 'post_view'), $sendback);
        wp_redirect($sendback);
        exit();
    }

    function custom_bulk_admin_notices() {
            global $post_type, $pagenow;

            if($pagenow == 'edit.php' && $post_type == 'course' && isset($_REQUEST['exported']) && (int) $_REQUEST['exported']) {
                $message = sprintf( _n( 'Post exported.', '%s posts exported.', $_REQUEST['exported'] ), number_format_i18n( $_REQUEST['exported'] ) );
                echo "<div class=\"updated\"><p>{$message}</p></div>";
            }
        }

    function perform_export($cid) {
        // Export excel file.

        //Initialize excel file and table head.
        $courseName = str_replace(" ", "_", get_the_title($cid));
        $xls_file_name = $courseName."_students_information";

        $xls_file = 'Student Name' . ',' . 'Email' . ',' . 'Phone' . ',' .
            'Last 4 digits of SSN' .',' . 'Degree' . ',' .
            'Job Title' . ',' . 'Work Facility' . ',' .
            'Dietary Needs' . ',' . 'Year of Experience' . ',' .
            'Department' . "\r\n";

        // get all registered student.
        $students = get_users( '&role=subscriber');
        foreach ($students as $student){
            $courses_id = get_user_meta($student->data->ID, 'registed_courses', true);
            if (in_array($cid, $courses_id)){
                $phone = esc_attr(get_the_author_meta( 'cellphone', $student->ID )) ;
                $last_4_ssn = esc_attr(get_the_author_meta( 'last_4_ssn', $student->ID ));
                $degree = get_user_meta( 'degree', $student->ID ) ;
                $job_title = esc_attr(get_the_author_meta( 'job_title', $student->ID ));
                $work_facility = esc_attr(get_the_author_meta( 'work_facility', $student->ID ));
                $dietary_needs = esc_attr(get_the_author_meta( 'dietary_needs', $student->ID ));
                $year_of_experience = esc_attr(get_the_author_meta( 'year_of_experience', $student->ID ));
                $department = esc_attr(get_the_author_meta( 'work_department', $student->ID ));
                $degree = get_user_meta( 'degree', $student->ID ) ;
                $xls_file .= $student->data->display_name . ',' .
                             $student->data->user_email . ',' .
                             $phone . ',' . $last_4_ssn . ',' .
                             $degree . ',' . $job_title . ',' . $degree . ',' .
                             $work_facility . ',' . $dietary_needs . ',' .
                             $year_of_experience . ',' . $department . "\r\n";
            }
        }
        // write_log($xls_file);

        $xls_file_name .= $xls_file_name . '.csv';
        // write to xls file
        ob_clean();
        header( "Content-Type: text/x-csv" );
        header( "Content-disposition: attachment; filename=$xls_file_name" );
        header("Pragma: no-cache");
        header("Expires: 0");
        echo($xls_file);
        exit();
        return True;
    }


    /**
     * [gtf_update_student_course_list Update student course meta when the course is deleted]
     * @return [type] [description]
     */
    function gtf_update_student_course_list($cid)
    {
        $students = get_users( '&role=subscriber');
        foreach ($students as $student){
            $courses_id = get_user_meta($student->data->ID, 'registed_courses', true);
            $index = array_search($courses_id, $cid);
            if ($index){
                 unset($courses_id[$index]);
                 update_user_meta( $uid, 'registed_courses', $courses_id );
            }
        }
    }

}

?>
