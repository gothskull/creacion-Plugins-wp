<?php 
/*
 Plugin Name: Practica Codex Ajax y Jquery
 Plugin URI: https://www.bisionweb.com/
 Description: WordPress toolkit for Envato Marketplace hosted items. Currently supports the following theme functionality: install, upgrade, & backups during upgrade.
 Version: 1.7.2
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */ 
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

add_action( 'wp_enqueue_scripts', 'sa_add_ajax_support' );
/**
 * Adds support for WordPress to handle asynchronous requests on both the front-end
 * and the back-end of the website.
 *
 * @since    1.0.0
 */
function sa_add_ajax_support() {
     
	wp_enqueue_script(
    'ajax-script',
    plugin_dir_url( __FILE__ ) . 'js/frontend.js',
    array( 'jquery' )
);

    wp_localize_script(
        'ajax-script',
        'sa_demo',
        array(
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        )
    );
  












/**
 * Determines if a user is logged into the site using the specified user ID. If not,
 * then the following error code and message will be returned to the client:
 *
 * -2: The visitor is not currently logged into the site.
 *
 * @access   private
 * @since    1.0.0
 *
 * @param    int    $user_id    The current user's ID.
 */
function _sa_user_is_logged_in( $user_id ) {
 
    if ( 0 === $user_id ) {
 
        wp_send_json_error(
            new WP_Error( '-2', 'The visitor is not currently logged into the site.' )
        );
 
    }
 
}





}add_action( 'wp_ajax_get_current_user_info', 'sa_get_current_user_info' );
add_action( 'wp_ajax_nopriv_get_current_user_info', 'sa_get_current_user_info' );
/**
 * Retrieves information about the user who is currently logged into the site.
 *
 * This function is intended to be called via the client-side of the public-facing
 * side of the site.
 *
 * @since    1.0.0
 */
function sa_get_current_user_info() {
 
    // Grab the current user's ID
    $user_id = get_current_user_id();
 
    // If the user is logged in and the user exists, return success with the user JSON
    if ( _sa_user_is_logged_in( $user_id ) && _sa_user_exists( $user_id ) ) {
 
        wp_send_json_success(
            json_encode( get_user_by( 'id', $user_id ) )
        );
 
    }
 
}