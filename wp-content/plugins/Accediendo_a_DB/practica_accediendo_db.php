<?php 
/*
 Plugin Name: Accediendo a DB Practice 
 Plugin URI: https://www.bisionweb.com/
 Description: lorem50
 Version: 1.3
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */ 	
 
if (!function_exists("bision_crear_tabla")) {
	
	function bision_crear_tabla(){

		global $wpdb;
		$tabla = $wpdb->prefix."goth";

		if ($wpdb->get_var('SHOW TABLES LIKE '.$tabla) != $tabla) {
			
			$sql = "CREATE TABLE ".$tabla." (
				id INTEGER (10) UNSIGNED AUTO_INCREMENT,
				nombre VARCHAR (120),
				descripcion VARCHAR (255),
				PRIMARY KEY (id)
			)";

			require_once(ABSPATH.'wp-admin/includes/upgrade.php');
			dbDelta($sql);

			add_option('version','1.0');
		}

	}
}
register_activation_hook(__FILE__,'bision_crear_tabla' );


if (!function_exists("bision_detecta_navegador")) {
	
	function bision_detecta_navegador(){

		global $wpdb;
		$tabla = $wpdb->prefix.'goth';

		$wpdb->insert($tabla,array('nombre'=>$_SERVER['HTTP_USER_AGENT']),array('%s'));

	}
}
 add_action('wp_footer','bision_detecta_navegador' );


 
 