<?php 

 	if (!function_exists("bision_register_post_type")) {

 		function bision_register_post_type(){

 			$singular = 'Empleo';
 			$plural   = 'Empleos';

 			$labels = [
 				'name'               => $plural,
 				'singular_name'      => $singular,
 				'add_name'           => 'Agregar Nuevo',
 				'add_new_item'       => 'Agregar Nuevo '.$singular,
 				'edit'               => 'Editar',
 				'edit_item' 	     => 'Editar '.$singular,
 				'new_item' 		     => 'Nuevo '.$singular,
 				'view' 			     => 'Ver '.$singular,
 				'view_item'          => 'Ver '.$singular,
 				'search_term'        => 'Buscar '.$singular,
 				'parent'             => 'Padre '.$singular,
 				'not_found'          => 'No se encontraron '.$plural,
 				'not_found_in_trash' => 'No se encontraron '.$plural.' en la papelera.',
            ];

 			$args = array(
 				'labels'             => $labels,
 				'public'             => true,//se refiere a la visibilidad
 				'publicly_queryable' => true,
 				'exclude_from_search'=> true,
 				'show_in_nav_menus'  => true,//Se muestra o no en el menu del dashboard
 				'show_ui'            => true,
 				'show_in_menu'       => true,
 				'show_in_admin_bar'  => true,
 				'menu_position'      => 10,
 				'menu_icon'          => 'dashicons-businessman',
 				'can_export'         => true,
 				'delete_with_user'   => false,
 				'hierarchical'       => false,
 				'has_archive'        => true,
 				'query_var'          => true,
 				'capabiliy_type'     => 'post',
 				'map_meta_cap'       => true,
 				// 'capabilities' => array(),
 				'rewrite'            => array(
 					'slug'       => 'jobs',
 					'with_front' => true,
 					'pages'      => true,
 					'feeds'      => true,
 				),
 				'supports' => array(
 					'title',
 					'editor',
 					'author',
 					'custom-fields',
 					'thumbnail'
 				),



 			);

 			register_post_type('bision',$args );

 		}
 	}
 	 add_action('init','bision_register_post_type' );


/*
=========================================================================
            REGISTRAR TAXONOMIA
=========================================================================
*/
	if (!function_exists("bision_register_taxonomy")) {
		
		function bision_register_taxonomy(){
			
			$singular = 'Empleo';
			$plural   = 'Empleos';

			$labels = array(
	 		'name'					=> $plural,
	 		'singular_name'			=> $singular,
	 		'search_items'			=> __( 'Buscar '.$plural ),
	 		'popular_items'			=> __( $plural.' Populares' ),
	 		'all_items'				=> __( 'Todos los '.$plural ),
	 		'parent_item'			=> null,
	 		'parent_item_colon'		=> null,
	 		'edit_item'				=> __( 'Editar '.$singular ),
	 		'update_item'			=> __( 'Actualizar '.$singular ),
	 		'add_new_item'			=> __( 'Agregar nuevo '.$singular ),
	 		'new_item_name'			=> __( 'Nuevo '.$singular ),
	 		'add_or_remove_items'	=> __( 'Agregar o Remover '.$plural ),
	 		'choose_from_most_used'	=> __( 'Escoger de los mas comunes '.$plural ),
	 		'menu_name'				=> __( $plural ),
	 		'not_found'            	=> __('No se encontraron '.$plural),
	 	);

			$args = array(
				'labels'            => $labels,
				'public'            => true,
				'show_in_nav_menus' => true,
				'show_admin_column' => true,
				'hierarchical'      => true,
				'show_tagcloud'     => true,
				'show_ui'           => true,
				'query_var'         => true,
				'rewrite'           => array('slug' => 'Trabajo'),
				'query_var'         => true,
				'capabilities'      => array(),
			);

			register_taxonomy( 'location', 'bision', $args );
	
		}
	}
	 add_action('init','bision_register_taxonomy' );




?>