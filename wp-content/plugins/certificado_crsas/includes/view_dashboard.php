<?php 
 
require_once(plugin_dir_path(__FILE__ ).'insert_data.php');

 /*
 =========================================================================
             AGREGAMOS VISTA HTML AL ESCRITORIO
 =========================================================================
 */
 
	 if (!function_exists("bision_add_new_html")) {
  	
  	function bision_add_new_html()
    {
  
  		?>

  		<div class="wrap">
  			<h2>Certificados CRSAS</h2>
  			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut vero magni, nisi.</p>


  			<form action="" method="POST">

  				<?php settings_fields('grupo_oct'); ?>
  				<?php @do_settings_fields('grupo_oct'); ?>

  				<table class="form-table">

  					<tbody>
  						<tr valign="top">
  							<th scope="row">Dictamen</th>
  							<td>
  								*<input type="text" class="widefat form-field" name="dictamen" value="<?php echo esc_attr(get_option('dictamen')) ?>">
  							</td>
  						</tr>
              <tr>
                <th scope="row">Direccion</th>
                <td>
                  *<input type="text" class="widefat form-field" name="direccion" value="<?php echo esc_attr(get_option('direccion')) ?>">
                </td>
              </tr>
               <tr>
                <th scope="row">Ciudad</th>
                <td>
                  *<input type="text" class="widefat form-field" name="ciudad" value="<?php echo esc_attr(get_option('ciudad')) ?>">
                </td>
              </tr>
              <tr>
                <th scope="row">Proyecto</th>
                <td>
                  *<input type="text" class="widefat form-field" name="proyecto" value="<?php echo esc_attr(get_option('proyecto')) ?>">
                </td>
              </tr>
              <tr>
                <th scope="row">Propietario</th>
                <td>
                  *<input type="text" class="widefat form-field" name="propietario" value="<?php echo esc_attr(get_option('propietario')) ?>">
                </td>
              </tr>
              <tr>
                <th scope="row">Inspector</th>
                <td>
                  *<input type="text" class="widefat form-field" name="inspector" value="<?php echo esc_attr(get_option('inspector')) ?>">
                </td>
              </tr>
              <tr>
                <th scope="row">Aprobado</th>
                <td>
                  *<input type="text" class="widefat form-field" name="aprobado" value="<?php echo esc_attr(get_option('aprobado')) ?>">
                </td>
              </tr>
              <tr>
                <th scope="row">Observaciones</th>
                <td>
                  *<input type="text" class="widefat form-field" name="observaciones" value="<?php echo esc_attr(get_option('observaciones')) ?>">
                </td>
              </tr>
              <tr>
                <th scope="row">Url del Archivo</th>
                <td>
                  *<input type="url" class="widefat form-field" name="url_archivo" value="<?php echo esc_attr(get_option('url_archivo')) ?>">
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
