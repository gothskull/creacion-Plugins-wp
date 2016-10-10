<?php 
/*
 Plugin Name: Ajax y Jquery
 Plugin URI: https://www.bisionweb.com/
 Description: WordPress toolkit for Envato Marketplace hosted items. Currently supports the following theme functionality: install, upgrade, & backups during upgrade.
 Version: 1.7.2
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */ 

 if (!function_exists("ajax_jquery")) {
 	
 	function ajax_jquery(){
 
 		global $_REQUEST;

 		$to = "chaza-hejo-strong@hotmail.com";
 		$subject = "Mensaje de ajas y Jquery ".$_REQUEST['subject'];
 		$message = "Mensaje de: ".$_REQUEST['name']." enviado desde ".$_REQUEST['email']." \n ".$_REQUEST['comments'];

 		wp_mail($to,$subject,$message);
 		
 	}

 }
 add_action('comment_post','ajax_jquery');



 if (!function_exists("register_fields_jquery")) {
 	
 	function register_fields_jquery(){
 	
 		register_setting('grupo_jquery','correo_jq');
 			
 	}
 }
 add_action('admin_init','register_fields_jquery');



 if (!function_exists("campos_prueba_jquery")) {
 	
 	function campos_prueba_jquery(){
 
 		?>

 			<input class="regular-text code" type="text" name="correo_jq" id="correo_jq" value="<?php echo get_option('correo_jq') ?>">
			<div id="emailInfo"></div>
			
 		<?php
 		
 	}
 }


 if (!function_exists("seccion_plugin_jquery")) {
 	
 	function seccion_plugin_jquery(){
 
 		?>
			
			<p>Sección de Prueba Jquery Plugin</p>

 		<?php
 		
 	}
 }


 if (!function_exists("adding_jquery_seccion")) {
 	
 	function adding_jquery_seccion(){
 
 		add_settings_section('id_jquery','Seccion de Jquery Plugin','campos_prueba_jquery','general');
 		add_settings_field('id_campo','Nombre del campo','campos_prueba_jquery','general','id_jquery');
 		
 	}
 }
 add_action('admin_menu','adding_jquery_seccion' );


 if (!function_exists("check_email_jquery")) {
 	
 	function check_email_jquery(){
 
 		$email = isset($_POST['correo_jq']) ? $_POST['correo_jq'] : null;
 		$msg = 'No valido';

 		if ($email) {
 			
 			if (is_email($email)) {
 				
 				$msg ='Valido';
 			}
 		}
 		echo $msg;
 		die();
 
 	}
 }
 add_action('wp_ajax_check_email_jquery','check_email_jquery');
 add_action('admin_print_scripts-options-general.php','check_email_jquery');


 if (!function_exists("check_email_jquery")) {
 	
 	function check_email_jquery(){
 
 		wp_enqueue_script('jquery_plugin',path_join(WP_PLUGIN_URL,basename(dirname(__FILE__))."/myjava.js")).array('jquery');
 		// wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
 	}
 }
 
 
 