<?php 
/*
 Plugin Name: Removiendo_widget
 Plugin URI: https://www.bisionweb.com/
 Description: lorem35
 Version: 
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */ 

 if (!function_exists("bision_removiendo_widget")) {
 	
 	function bision_removiendo_widget(){
 
 		global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);		
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
 
 	}
 }
  add_action('wp_dashboard_setup','bision_removiendo_widget' );
  remove_action('welcome_panel', 'wp_welcome_panel');

  if (!function_exists("bision_add_item")) {
  	
  	function bision_add_item(){
  
  		global $wp_admin_bar;

  		$wp_admin_bar->add_menu(array(
  			'id'=> 'bisio_web',
  			'title' => 'Bision Web',
  			'href' => 'http://www.bisionweb.com'
  		));
  
  	}
  }
   add_action('wp_before_admin_bar_render','bision_add_item' );
  
 