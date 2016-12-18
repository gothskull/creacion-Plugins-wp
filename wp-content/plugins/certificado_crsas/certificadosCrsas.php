<?php 
/*
 Plugin Name: Certificados New Version
 Plugin URI: https://www.bisionweb.com/
 Description:  Plugin para la creación, almacenamiento en base de datos, visualización y descarga de los certificados expedidos por la empresa.
 Version: 1.0
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */ 

require_once(plugin_dir_path(__FILE__).'/admin/table_class1.php');
require_once(plugin_dir_path(__FILE__).'/includes/db_actions.php');
require_once(plugin_dir_path(__FILE__).'/includes/adding_scripts.php');


/*
=========================================================================
           REGISTRAMOS LOS CAMPOS
=========================================================================
*/

  if (!function_exists("bision_register_new_certificado")) 
  {
  	
  	function bision_register_new_certificado()
    {
  
  		register_setting('certificados_crsas','dictamen' );
  
  	}
  }
   add_action('admin_init','bision_register_new_certificado' );
   