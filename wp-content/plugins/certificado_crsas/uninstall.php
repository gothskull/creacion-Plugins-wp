<?php 

    if (!defined('WP_UNINSTALL_PLUGIN')) {
		die();
    }
    if (!function_exists("bision_uninstall_certificados")) {
    	
    	function bision_uninstall_certificados()
        {
    
    		global $wpdb;

    		$tabla = $wpdb->prefix .'certificados';
            $wpdb->query("DROP TABLE IF EXISTS $tabla");
    
    	}
    }
    bision_uninstall_certificados();
    