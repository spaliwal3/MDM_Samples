<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    course_registration
 * @subpackage course_registration/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    course_registration
 * @subpackage course_registration/includes
 * @author     Xiaoxuan Wang <wangxx@gatech.edu>
 */
class Course_Registration_Activator {

	/**
	 * 1.setup eventbrite API when activate course registration. (use period)
	 *
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		/**
		 * 1. Set our token option on activation
		 * if an Eventbrite connection already exists in Keyring.
		 */
		// if ( ! class_exists( 'Keyring_SingleStore' ) ) {
		// 	return;
		// }

		// // Get any Eventbrite tokens we may already have.
		// $tokens = Keyring_SingleStore::init()->get_tokens( array( 'service'=>'eventbrite' ) );

		// // If we have one, just use the first.
		// if ( ! empty( $tokens[0] ) ) {
		// 	update_option( 'eventbrite_api_token', $tokens[0]->unique_id );
		// }
		if(!class_exists('Eventbrite_Requirements')){
			return;
		}

		

		// get 
	}

}
