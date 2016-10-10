<?php 
/*
 Plugin Name: Envia Correo 
 Plugin URI: https://www.bisionweb.com/
 Description: WordPress toolkit for Envato Marketplace hosted items. Currently supports the following theme functionality: install, upgrade, & backups during upgrade.
 Version: 1.7.2
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */ 

if (!function_exists("envia_correo_goth")) {
	
	function envia_correo_goth(){

		global $_REQUEST;
		
		$to = "bisiondigital@gmail.com";
		$subject = "Mensaje  del blog ".$_REQUEST['subject'];
		$message = "Correo enviado desde wordpress ".$_REQUEST['name']." enviado desde ".$_REQUEST['email'].$_REQUEST['comments'];

		mail($to, $subject, $message);
	}
}
add_action('comment_post', 'envia_correo_goth');
