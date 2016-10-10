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

 	if (!function_exists("bision_register_post_type")) {
 		
 		function bision_register_post_type(){
 	
 			$args = array('public' =>true,'label' =>'Bision Post');

 			register_post_type('bision',$args );
 	
 		}
 	}
 	 add_action('init','bision_register_post_type' );
 	