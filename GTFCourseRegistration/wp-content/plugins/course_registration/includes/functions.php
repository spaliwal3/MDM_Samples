<?php
/**
 * The file that defines helper functions
 *
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    course_registration
 * @subpackage course_registration/includes
 */

if ( ! function_exists( 'write_log' ) ) :
/**
 * Helper function for logging messages to wp-content/debug.log
 *
 * @param  String $log Parameter (Use __LINE__ to print the number of lines executed)
 */
function write_log( $log ) {
	if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
}
endif;

if ( ! function_exists( 'append_var_url' ) ) :
/**
 * Helper function for appending new var to the url 
 *
 * @param  String $url - the current url 
 * @param  String $var - new var needs to be added to the url
 *
 * @return String $url - a processed url that contains the new var
 */
function append_var_url( $url, $var ) {
	write_log($var);
	if ( strpos( $url, '?' ) !== false ) {
		$var = '&'.$var;
        $url .= $var;
      } else {
        $var = '?'.$var;
        $url .= $var;
      }
     return $url;
}
endif;
?>