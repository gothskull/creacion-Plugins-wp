<?php 
/*
 Plugin Name: Certificados New Version
 Plugin URI: https://www.bisionweb.com/
 Description:  Plugin para la creación, almacenamiento en base de datos, visualización y descarga de los certificados expedidos por la empresa.
 Version: 1.0
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */ 

require_once(plugin_dir_path(__FILE__).'/includes/db_actions.php');
require_once(plugin_dir_path(__FILE__).'/includes/view_dashboard.php');
require_once(plugin_dir_path(__FILE__)."/includes/adding_scripts.php");


 /*
 =========================================================================
             AGREGAMOS ITEM DE MENU EN EL ESCRITORIO
 =========================================================================
 */


 if (!function_exists("bision_iniciar_plugin")) {
 	
 	function bision_iniciar_plugin(){
 
 		add_menu_page( 'cetificado_new', 'Nuevo Certificado', 'manage_options', 'new_certificado', 'bision_add_new_html', plugins_url('img/icon.png',__FILE__ ), '20' );
 
 	}
 }
  add_action('admin_menu','bision_iniciar_plugin' );
  
/*
=========================================================================
           REGISTRAMOS LOS CAMPOS
=========================================================================
*/

  if (!function_exists("bision_register_new_certificado")) {
  	
  	function bision_register_new_certificado(){
  
  		register_setting('certificados_crsas','dictamen' );
  
  	}
  }
   add_action('admin_init','bision_register_new_certificado' );
  
 