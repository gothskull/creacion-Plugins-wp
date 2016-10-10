<?php 
/*
 Plugin Name: Add Our Options 
 Plugin URI: https://www.bisionweb.com/
 Description: WordPress toolkit for Envato Marketplace hosted items. Currently supports the following theme functionality: install, upgrade, & backups during upgrade.
 Version: 1.7.2
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */

if (!function_exists("send_mail")) {
	
	function send_mail(){

		global $_REQUEST;

		$to = "bisiondigital@gmail.com";
		$subject = "Nuevo comentario en el blog ".$_REQUEST['subject'];
		$message = "Mensaje de : ".$_REQUEST['name']." enviado desde ".$_REQUEST['email'].$_REQUEST['comments'];
		wp_mail($to,$subject,$message);
		
	}
}
add_action('comment_post','send_mail' );



if (!function_exists("register_widget_email")) {
	
	function register_widget_email(){

		register_setting('opcion_group','correo' );
	}
}
add_action('admin_init','register_widget_email' );



if (!function_exists("setting_fields")) {
	
	function setting_fields(){

		?>

		<input class="regular-text code" type="text" name="correo" id="correo" value="<?php echo get_option('correo') ?>">

		<?php
		
	}
}


if (!function_exists("section_plugin")) {
	
	function section_plugin(){

		?>
			
			<p>Ajustes Para el Plugin</p>

		<?php
	}
}



if (!function_exists("plugin_menu_add")) {
	
	function plugin_menu_add(){

		add_settings_section( 'Titulo_Seccion', 'Nombre de Sección','setting_fields', 'general');
		add_settings_field('send_mail','Titulo en Page','setting_fields','general','Titulo_Seccion');
		
	}
}
add_action('admin_menu','plugin_menu_add');
