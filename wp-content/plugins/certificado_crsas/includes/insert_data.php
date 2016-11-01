<?php 
/*
 =========================================================================
             INSERTAMOS LOS DATOS EN LA BASE DE DATOS
 =========================================================================
 */
				global $wpdb;  

		     	$dictamen      = $_POST['dictamen'] ;  
				$direccion     = $_POST['direccion'] ;
		     	$ciudad        = $_POST['ciudad'] ;  
		     	$proyecto      = $_POST['proyecto'] ;  
		     	$propietario   = $_POST['propietario'] ;  
		     	$inspector     = $_POST['inspector'] ;  
		     	$aprobado      = $_POST['aprobado'] ;  
		     	$observaciones = $_POST['observaciones'] ;  
		     	$url_archivo   = $_POST['url_archivo'] ;  
				
				$data   = array(
					'dictamen'      => $dictamen,
					'direccion'     => $direccion,
					'ciudad'        => $ciudad,
					'proyecto'      => $proyecto,
					'propietario'   => $propietario,
					'inspector'     => $inspector,
					'aprobado'      => $aprobado,
					'observaciones' => $observaciones,
					'url_archivo'   => $url_archivo
				);
		$wpdb->insert('plugins_certificados',$data);




	