<?php
	/*
	 =========================================================================
	             CREAMOS LA BASE DE DATOS AL ACTIVAR EL PLUGIN
	 =========================================================================
	 */
	 	
	 if (!function_exists("bision_certificados_init")) {
	 	
	 	function bision_certificados_init()
	 	{
	 
	 		global $wpdb;
	 		$tabla = $wpdb->prefix."certificados";

	 		if ($wpdb->get_var('SHOW TABLES LIKE '.$tabla) !=$tabla) {
	 			
	 			$sql = "CREATE TABLE IF NOT EXISTS ".$tabla."(
	 			     id             INTEGER (10)  UNSIGNED AUTO_INCREMENT,
	 			     dictamen       VARCHAR (50)  NOT NULL,
	 			     direccion      VARCHAR (50)  NOT NULL,
	 			     ciudad         VARCHAR (100) NOT NULL,
	 			     proyecto       VARCHAR (200) NOT NULL,
	 			     propietario    VARCHAR (120) NOT NULL,
	 			     inspector      VARCHAR (100) NOT NULL,
	                 aprobado       VARCHAR (2)   NOT NULL,
	                 observaciones  VARCHAR (500),
	                 url_archivo    VARCHAR (150) NOT NULL,
	                 fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	                 PRIMARY KEY (id)
	 			)";
	 			require_once(ABSPATH.'wp-admin/includes/upgrade.php');
	 			dbDelta($sql);
	 		}
	 
 	}
 }
  add_action('admin_menu','bision_certificados_init' );
  



  