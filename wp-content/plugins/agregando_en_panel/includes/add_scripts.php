<?php 
/*
=========================================================================
            FUNCION PARA AGREGAR SCRIPTS JS Y ESTILOS CSS
=========================================================================
*/
	if (!function_exists("bision_adding_scripts")) {
		
		function bision_adding_scripts(){
	
			global $pagenow, $post;
			// var_dump($pagenow);//En este caso es = admin.php
			// exit();
			// var_dump($post->post_name);
			// exit();


			if ($pagenow == 'admin.php') {
				// wp_enqueue_style( 'bision_style', plugins_url('../css/estilos.css',__FILE__) );
			}

	
		}
	}
	 add_action('admin_enqueue_scripts','bision_adding_scripts' );
	