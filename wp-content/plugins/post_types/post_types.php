<?php
/*
 Plugin Name: Register Post Types
 Plugin URI: https://www.bisionweb.com/
 Description: lorem30
 Version: 1.0
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */

if (!defined('ABSPATH')) {
	exit;
}

//DE ESTA MANERA SE INCLUYEN VARIOS ARCHIVOS
require_once( plugin_dir_path(__FILE__).'content_post_type.php' );

if (!function_exists("bision_admin_enqueue")) {
	
	function bision_admin_enqueue(){

		global $pagenow, $typenow;
		var_dump($pagenow);

	}
}
 add_action('admin_enqueue_scripts','bision_admin_enqueue' );





	
	
 	