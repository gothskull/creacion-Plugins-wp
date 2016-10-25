<?php
/*
 Plugin Name: Register Post Types
 Plugin URI: https://www.bisionweb.com/
 Description: lorem30
 Version: 1.0
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */

if (!defined('ABSPATH')) {
	exit;
}

/*
=========================================================================
            DE ESTA MANERA SE INCLUYEN VARIOS ARCHIVOS
=========================================================================
*/
	
require_once( plugin_dir_path(__FILE__).'content_post_type.php' );
require_once( plugin_dir_path(__FILE__).'shortcode.php');

/*
=========================================================================
            FUNCION PARA AGREGAR SCRIPTS JS Y ESTILOS CS
=========================================================================
*/
	
if (!function_exists("bision_admin_enqueue")) {
	
	function bision_admin_enqueue(){

		global $pagenow, $typenow;
		// var_dump($typenow);
		// exit();
		$screen = get_current_screen();
		// var_dump($screen->post_type);
		// exit();
		if ( $typenow == 'bision') {
			wp_enqueue_style('bision_css', plugins_url( 'css/estilos.css', __FILE__ ) );
		}

		if (($pagenow == 'post.php' || $pagenow == 'post-new.php') && $typenow == 'bision') {
			
			wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );
			wp_enqueue_script('script_js', plugins_url( 'js/myjava.js', __FILE__ ),array('jquery','jquery-ui-datepicker'),'1.0',true);
			wp_enqueue_script('quick_tag_js', plugins_url( 'js/quick_tag.js', __FILE__ ),array('quicktags'),'1.0',true);
		}

		if ( $pagenow == 'edit.php' && $typenow == 'bision') {
			wp_enqueue_script('ordenar_js', plugins_url( 'js/reordenar.js', __FILE__ ),array('jquery','jquery-ui-sortable'),'1.0',true);
			wp_localize_script('ordenar_js','WP_JOB_LISTING',array(
				'security' => wp_create_nonce('wp-job-order' ),
				'success'  => 'El reordenamiento de empleos ha sido guardado',
				'failure'  => 'Hubo un error al guardar los cambios, o no tienes los permisos necesarios.',
			));
		}

	}
}
/*
=========================================================================
            AGREGAR SUBMENU OPTIONS
=========================================================================
*/

 add_action('admin_enqueue_scripts','bision_admin_enqueue' );

 if (!function_exists("bision_add_submenu_page")) {
 	
 	function bision_add_submenu_page(){
 
 		// add_submenu_page( $parent_slug,             $page_title,     $menu_title,     $capability,     $menu_slug, $function );
 		add_submenu_page('edit.php?post_type=bision','Submenu Bision','Submenu Bision','manage_options','slug_submenu','bision_submenu_callback');
 
 	}
 }
  add_action('admin_menu','bision_add_submenu_page' );


  if (!function_exists("bision_submenu_callback")) {
  	
  	function bision_submenu_callback(){

  		// global $typenow,$pagenow;
  		
  		$args = array(
  			'post_type'              => 'bision',//debe coincidir con el register post type
  			'orderby'                => 'menu_order',
  			'order'                  => 'ASC',
  			'no_found_rows'          => true,
  			'update_post_term_cache' => false,
  			'post_per_post'          => 50
  		);

  		$lista_empleos = new WP_Query( $args );
  		?>

		<div id="job_sort" class="wrap">
			<div id="icon_job_admin" class="icon32"><br> </div>

			<h2><?php _e( 'Ordenar Posición de Empleos','wp-job-listing') ?> 

			<img src="<?php echo esc_url( admin_url()) .'/images/loading.gif' ?> " alt="" id="loading-animation"></h2>

				<?php if( $lista_empleos->have_posts() ) : ?>

					<p><?php  _e('<strong>Nota:</strong> Esto solo afectará la lista usando funciones','wp-job-listing'); ?>  </p>

					<ul id="custom-type-list">

						<?php while ( $lista_empleos->have_posts() ) : $lista_empleos->the_post(); ?>

						<li id="<?php esc_attr(the_id() ); ?>" ><?php esc_html(the_title()); ?> </li>

					<?php endwhile ?>

					</ul>

					<?php else : ?>

						<p><?php _e( 'No se han ordenado los empleos','wp-job-listing'); ?>  </p>

					<?php endif;  ?>
		</div>

  		<?php
  		// var_dump($typenow);
  		// var_dump($pagenow);
  
  	}
  }
 

 if (!function_exists("bision_save_reordenar")) {
 	
 	function bision_save_reordenar(){
 /*
 =========================================================================
 //verificamos o revisamos los nonce, el primer parametro debe coincidir con el
 nonce creado con wp_create_nonce, en la funcion bision_admin_enqueue de este archivo.  
 =========================================================================
 */
 	
 		if( !check_ajax_referer('wp-job-order','security')){
 			return wp_send_json_error('Nonce invalido');
 		}

 		if (!current_user_can('manage_options' )) {
 			return wp_send_json_error('No estas habilitado para hacer esto.');
 		}

 		$order = $_POST['order'];//order es recogida de ajax data order en reordenar.js
 		$counter = 0;

 		foreach ($order as $item_id) {
 			
 			$post = array(
 				'ID' => (int)$item_id,
 				'menu_order' => $counter
 			);

 			wp_update_post($post);
 			$counter++;
 		}

 		wp_send_json_success('Post guardado correctamente.' );
 
 	}
 }
 /*
 =========================================================================
     en la siguiente linea, el nombre despues de wp_ajax_  debe ser igual 
     al colocado en data action en la peticion ajax(Archivo reordenar.js)
 =========================================================================
 */
 	
  add_action('wp_ajax_save_post','bision_save_reordenar' );
 
  
 





	
	
 	