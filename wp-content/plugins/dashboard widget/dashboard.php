<?php 
/*
 Plugin Name: Plugin en Dashboard
 Plugin URI: https://www.bisionweb.com/
 Description: WordPress toolkit for Envato Marketplace hosted items. Currently supports the following theme functionality: install, upgrade, & backups during upgrade.
 Version: 1.7.2
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */

 function simple_dashboard_widget(){

 	?>
	
	<h2>Acceso web</h2>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis asperiores, dolores tempore.</p>
	<p><a href="#">Enlace de prueba | </a><a href="#">Distribución |</a></p>

 	<?php

 }
  if (!function_exists("dashboard_register_widget")) {
  	
  	function dashboard_register_widget(){
  
  		wp_add_dashboard_widget('simple_widget','Widget de Escritoio','simple_dashboard_widget');
  		
  	}
  }
  add_action('wp_dashboard_setup','dashboard_register_widget' );