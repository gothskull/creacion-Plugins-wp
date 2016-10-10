<?php 
/*
 Plugin Name: Consultas Basicas a DB 
 Plugin URI: https://www.bisionweb.com/
 Description: WordPress toolkit for Envato Marketplace hosted items. Currently supports the following theme functionality: install, upgrade, & backups during upgrade.
 Version: 1.7.2
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
*/

 if (!function_exists("bision__basic_queries_db")) {
 	
 	function bision__basic_queries_db(){

 		global $wpdb;
 		global $current_user;
 		?>

 		<p><b>Ultima Consulta:</b> <?php echo $wpdb->last_query ?></p>
 		
 	   <p><b> Ultimo error:</b> <?php echo $wpdb->last_error ?></p>
 		
		<p><b>Usuarios:</b> <?php echo $wpdb->query('SELECT ID FROM plugins_users') ?></p>
 		
 		<p><b>Post por autor: </b><?php echo $wpdb->get_var('SELECT post_title FROM '. $wpdb->posts. ' WHERE post_author = '.$current_user->ID) ?></p>
 		
 		
 		<?php
 	}
 }


  if (!function_exists("bision_register_init_funcion")) {
  	
  	function bision_register_init_Funcion(){
  
  		wp_add_dashboard_widget('nombre_simple','Nombre del Widget','bision__basic_queries_db');
  
  	}
  }
   add_action('wp_dashboard_setup','bision_register_init_funcion' );
  
 