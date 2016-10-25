<?php 
/*
 Plugin Name: Añadir Plugin en Panel
 Plugin URI: https://www.bisionweb.com/
 Description: WordPress toolkit for Envato Marketplace hosted items. Currently supports the following theme functionality: install, upgrade, & backups during upgrade.
 Version: 1.7.2
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */
/*
=========================================================================
            INICIALIZA LA FUNCION - 1
=========================================================================
*/
	

if (!function_exists("add_options_panel")) {
	
	function add_options_panel(){
	 // add_options_page( $page_title,         $menu_title,         $capability,    $menu_slug,    $function );
		add_menu_page("Opciones del Panel","Plugin Bision Web","manage_options","goth","agregar_al_panel", plugin_dir_url( __FILE__ ) .'img/icon.png','20' );
	}
}
add_action("admin_menu","add_options_panel" );//Inicializa y registra la funcion de aparecer en  el panel de administracion
/*
=========================================================================
            CODIGO HTML PARA  MOSTRAR EN EL PANEL - 2
=========================================================================
*/


if (!function_exists("agregar_al_panel")) {
	
	function agregar_al_panel(){ 
	?>
		<div class="wrap">

			<h1>Plugin de SirGothSkull</h1>
			<h3 class="title">Titulo Opcional</h3>
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil doloremque, dolorum deserunt soluta, id consequatur, debitis asperiores recusandae eligendi atque sed repellendus magni porro amet cupiditate maxime quo nesciunt qui.
			<p>lipsu </p>

			<form method="post" action="options.php">

				<?php settings_fields("Grupo1" ); ?>
				<?php @do_settings_fields("Grupo1" ); ?>

				<table class="form-table">
					<tr >
						<th scope="row">
							<label for="nombre">Nombre</label>
						</th>
						<td>
							<input type="text" name="nombre" id="" value="<?php echo esc_attr(get_option("nombre" )); ?>"><br>
							<small>Texto pequeño</small>
						</td>
						
					</tr>

					<tr valign="top">
						<th scope="row">
							<label for="descripción">Descripción</label>
						</th>
						<td>
							<textarea  name="descripción" class="widefat" id="" ><?php echo get_option("descripción" ); ?></textarea><br>
							<small>Texto pequeño descripcion</small>
						</td>

						
					</tr>
				</table>
				<?php @submit_button(); ?>
			</form>

		</div>
	
	<?php
	}
}

/*
=========================================================================
            REGISTRA LOS CAMPOS  QUE APARECERAN
=========================================================================
*/

 if (!function_exists("registro_campos")) {
 	
 	function registro_campos(){
 
 		register_setting( "Grupo1", "nombre" );
 		register_setting( "Grupo1", "descripción" );
 	}
 }
add_action("admin_init","registro_campos" );//permite registrar los campos del formulario

