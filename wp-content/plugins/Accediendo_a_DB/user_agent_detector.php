<?php 
/*
 Plugin Name: User Agen0t Detector
 Plugin URI: https://www.bisionweb.com/
 Description: WordPress toolkit for Envato Marketplace hosted items. Currently supports the following theme functionality: install, upgrade, & backups during upgrade.
 Version: 1.7.2
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
*/
/*
=========================================================================
            CREAMOS LAS TABLAS
=========================================================================
*/
	
 if (!function_exists("bision_creating_tables")) {
 	
 	function bision_creating_tables(){
 
 		global $wpdb;
 		$table_name = $wpdb->prefix . 'mi_tabla';

 		if ($wpdb->get_var('SHOW TABLES LIKE ' . $table_name) != $table_name) {
 			
 			$sql = 'CREATE TABLE ' . $table_name . ' (

 			       id INTEGER (10) UNSIGNED AUTO_INCREMENT,
 			       hit_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 			       user_agent 	VARCHAR (255),
 			       PRIMARY KEY (id)

 			)';

 			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
 			dbDelta($sql);

 			add_option('creating_tables_db_version','1.0');
 		}
 
 	}
 }
 register_activation_hook(__FILE__,'bision_creating_tables' );
 
 /*
 =========================================================================
             DETECTA EL USER AGENT
 =========================================================================
 */
 	if (!function_exists("user_detector")) {
 		
 		function user_detector(){
 	
 			global $wpdb;
 			$table_name =  $wpdb->prefix . 'mi_tabla';

 			$wpdb->insert($table_name,array('user_agent' =>$_SERVER['HTTP_USER_AGENT']),array('%s'));
 	
 		}
 	}
 	 add_action('wp_footer','user_detector' );
 	