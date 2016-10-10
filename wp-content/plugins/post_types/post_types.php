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

 	if (!function_exists("bision_register_post_type")) {

 		function bision_register_post_type(){

 			$singular = 'Lista de Empleo';
 			$plural   = 'Lista de Empleos';

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
 				'exclude_from_search' => true,
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
 	