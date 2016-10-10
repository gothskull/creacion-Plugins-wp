<?php 
/*
 Plugin Name: Practica Octubre 3
 Plugin URI: https://www.bisionweb.com/
 Description: WordPress toolkit for Envato Marketplace hosted items. Currently supports the following theme functionality: install, upgrade, & backups during upgrade.
 Version: 1.7.2
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */
 if (!function_exists("bision_init_function")) {
 	
 	function bision_init_function(){
 
 		add_menu_page('nombre_pagina','Plugin Octubre 3','manage_options','slug1','bision_add_html' );
 
 	}
 }
  add_action('admin_menu','bision_init_function' );



  if (!function_exists("bision_add_html")) {
  	
  	function bision_add_html(){
  
  		?>

  		<div class="wrap">
  			<h2>Plugin October 3</h2>
  			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut vero magni, nisi.</p>


  			<form action="options.php" method="POST">

  				<?php settings_fields('grupo_oct'); ?>
  				<?php @do_settings_fields('grupo_oct'); ?>

  				<table class="form-table">

  					<tbody>
  						<tr valign="top">
  							<th scope="row">Atributo Number One</th>
  							<td>
  								<input type="text" class="widefat" name="nombre" value="<?php echo esc_attr(get_option('nombre')) ?>">
  							</td>
  						</tr>
  					</tbody>

  					
  				</table>
  				<?php @submit_button(); ?>
  			</form>
  		</div>
		
  		<?php
  
  	}
  }


if (!function_exists("bision_register_settings")) {
	
	function bision_register_settings(){

		register_setting('grupo_oct','nombre' );

	}
}
 add_action('admin_init','bision_register_settings' );

  
 

 