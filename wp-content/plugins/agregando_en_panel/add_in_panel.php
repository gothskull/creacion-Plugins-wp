<?php 
/*
 Plugin Name: Add In Panel 
 Plugin URI: https://www.bisionweb.com/
 Description: WordPress toolkit for Envato Marketplace hosted items. Currently supports the following theme functionality: install, upgrade, & backups during upgrade.
 Version: 1.7.2
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */ 
 /*
 =========================================================================
             INICIALIZA LA FUNCION
 =========================================================================
 */
 	
 if (!function_exists("Inicializar_plugin")) {
 	
 	function Inicializar_plugin(){
 
 		add_menu_page( 'Titulo de la pagina','Plugin Bision', 'manage_options','plug_bis','add_to_panel',plugin_dir_url(__FILE__).'img/icon.png','20' );
 		
 	}

 }
add_action('admin_menu', 'Inicializar_plugin');

/*
=========================================================================
            MUESTRA EL HTML
=========================================================================
*/

if (!function_exists("add_to_panel")) {
	
	function add_to_panel(){

	?>
		<div class="wrap">

			<h1>Titulo de Widget</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima magni facilis, alias? Accusantium aliquam, eos.</p>

			<form action="options.php" method="POST">

				<?php settings_fields('grupo1') ?>
				<?php @do_settings_fields('grupo1' ); ?>

				<table class="form-table">

					<tbody>

						<tr valign="top" class="form-field">
							<th scop="row">
								<label for="nombre">Nombre</label>
							</th>
							<td>
								<input type="text" name="nombre" value="<?php echo esc_attr(get_option('nombre')) ?> "><br>
								<small>Texto acompañante pequeño</small>
							</td>
						</tr>
						<tr valign="top">
							<th scop="row"><label for=""></label></th>
							<td><input type="text"><small></small></td>
						</tr>

						<tr>
							<th scop="row"> Atributos</th>
							<td>
								<label for="">
									<input type="checkbox">Number Uno
								</label>
							</td>
						</tr>

					</tbody>
					
				</table>
				<?php @submit_button() ?>
			</form>
		</div>
	<?php
		
	}
}

/*
=========================================================================
            REGISTRA LOS CAMPOS
=========================================================================
*/

if (!function_exists("registrar_campos")) {
	
	function registrar_campos(){

		register_setting('grupo1','nombre' );
		register_setting('grupo1','descripcion' );
		
	}
}
add_action('admin_init','registrar_campos' );