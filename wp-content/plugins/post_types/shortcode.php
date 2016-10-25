<?php 

if (!function_exists("bision_ejemplo_shortcode")) {
	
	function bision_ejemplo_shortcode($atts, $content = null){

		$atts = shortcode_atts(
			array(
				'title' => 'Abriendo los empleos actuales...',
				// 'src' => 'www.bisionweb.com',
			),$atts
		);
		// return '<h1>'.$atts['title'].'</h1>';
/*
=========================================================================
 //en el metodo get_terms, location corresponde a la traxonomia registrada
 en la funcion bision_register_taxonomy en el archivo content_post_type.php
=========================================================================
*/
	
		$empleos = get_terms('location');
		// var_dump($empleos);
		if( !empty($empleos) && !is_wp_error($empleos )){
			$mostrarLista  = '<div id="job-location-list">';
			$mostrarLista .= '<h4>'.esc_html__($atts['title']).'</h4>';
			$mostrarLista .= '<ul>';

				foreach ($empleos as $empleo) {
					$mostrarLista .= '<li class="job-location">';
					$mostrarLista .= '<a href="'. esc_url(get_term_link($empleo)).'">';
					$mostrarLista .=  esc_html__($empleo->name ) .'</a></li>';
				}
			$mostrarLista .= '</ul></div>';
			return $mostrarLista;
		}
	}
}
 add_shortcode('bisionweb','bision_ejemplo_shortcode' );

 /*
 =========================================================================
             OTRA VARIACION O USABILIDAD DE LOS SHORTCODES:
             DYNAMIC SHORTCODE USANDO WP_QUERY
 =========================================================================
 */
 	
 	if (!function_exists("bision_list_empleo_by_location")) {
 		
 		function bision_list_empleo_by_location(){
 	
 			if (!isset($atts['location'])) {
 				return '<p class="job-error">Debes asignar una location para este shortcode</p>';
 			}

 			$atts = shortcode_atts(array(
 				'title'     => 'El empleo actual se esta abriendo',
 				'count'     => 5,
 				'location'  => '',
 				'pagination'=> false
 				),$atts );
 			$paged = get_query_var('paged') ? get_query_var('paged') : 1;

 			$args = array(
 				'post_type'      => 'bision',
 				'post_status'    => 'publish',
 				'no_found_rows'  => $atts['pagination'],
 				'posts_per_page' => $atts['count'],
 				'paged'          => $paged,
 				'tax_query'      => array(
 					array(
 						'taxonomy' => 'location',
 						'field'    => 'slug',
 						'terms'    => $atts['location'],
 					  ),
 					)
 				);
 			$empleos_by_location = new WP_Query($args);
 			var_dump($empleos_by_location->get_posts());
 		}
 	}
 	 add_shortcode('bision_by_location','bision_list_empleo_by_location' );
 	

