<?php /*
 Plugin Name: Practica Octubre 3
 Plugin URI: https://www.bisionweb.com/
 Description: WordPress toolkit for Envato Marketplace hosted items. Currently supports the following theme functionality: install, upgrade, & backups during upgrade.
 Version: 1.7.2
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */
 require_once (plugin_dir_path(__FILE__)."includes/add_certificado.php ");
 require_once (plugin_dir_path(__FILE__)."includes/add_scripts.php");


 /*
 =========================================================================
             AGREGAMOS ITEM DE MENU EN EL ESCRITORIO
 =========================================================================
 */

   if (!function_exists("bision_init_function")) {
   	
   	function bision_init_function(){
   
   		add_menu_page('nombre_pagina','Plugin Octubre 3','manage_options','slug1','bision_add_html' );
   
   	}
   }
    add_action('admin_menu','bision_init_function' );

/*
 =========================================================================
             AGREGAMOS VISTA HTML AL ESCRITORIO
 =========================================================================
 */

  if (!function_exists("bision_add_html")) {
  	
  	function bision_add_html(){
  
  		?>

  		<div class="wrap">
  			<h2>Plugin October 3</h2>
  			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut vero magni, nisi.</p>


  			<form action="" method="POST">

  				<?php settings_fields('grupo_oct'); ?>
  				<?php @do_settings_fields('grupo_oct'); ?>

  				<table class="form-table">

  					<tbody>
  						<tr valign="top">
  							<th scope="row">Dictamen</th>
  							<td>
  								<input type="text" class="widefat form-field" name="dictamen" value="<?php echo esc_attr(get_option('dictamen')) ?>">
  							</td>
  						</tr>
              <tr>
                <th scope="row">Direccion</th>
                <td>
                  <input type="text" class="widefat form-field" name="direccion" value="<?php echo esc_attr(get_option('direccion')) ?>">
                </td>
              </tr>
               <tr>
                <th scope="row">Ciudad</th>
                <td>
                  <input type="text" class="widefat form-field" name="ciudad" value="<?php echo esc_attr(get_option('ciudad')) ?>">
                </td>
              </tr>
              <tr>
                <th scope="row">Proyecto</th>
                <td>
                  <input type="text" class="widefat form-field" name="proyecto" value="<?php echo esc_attr(get_option('proyecto')) ?>">
                </td>
              </tr>
              <tr>
                <th scope="row">Propietario</th>
                <td>
                  <input type="text" class="widefat form-field" name="propietario" value="<?php echo esc_attr(get_option('propietario')) ?>">
                </td>
              </tr>
              <tr>
                <th scope="row">Inspector</th>
                <td>
                  <input type="text" class="widefat form-field" name="inspector" value="<?php echo esc_attr(get_option('inspector')) ?>">
                </td>
              </tr>
              <tr>
                <th scope="row">Aprobado</th>
                <td>
                  <input type="text" class="widefat form-field" name="aprobado" value="<?php echo esc_attr(get_option('aprobado')) ?>">
                </td>
              </tr>
              <tr>
                <th scope="row">Observaciones</th>
                <td>
                  <input type="text" class="widefat form-field" name="observaciones" value="<?php echo esc_attr(get_option('observaciones')) ?>">
                </td>
              </tr>
  					</tbody>

  					
  				</table>
  				<?php @submit_button('Guardar Certificado'); ?>
  			</form>
  		</div>
		
  		<?php
  
  	}
  }
/*
=========================================================================
           REGISTRAMOS LOS CAMPOS
=========================================================================
*/

// if (!function_exists("bision_register_settings")) {
	
// 	function bision_register_settings(){

// 		register_setting('grupo_oct','nombre' );

// 	}
// }
//  add_action('admin_init','bision_register_settings' );

  
 

 