<?php 
		global $wpdb;      
     	$dictamen      = $_POST['dictamen'] ;  
		$direccion     = $_POST['direccion'] ;
     	$ciudad        = $_POST['ciudad'] ;  
     	$proyecto      = $_POST['proyecto'] ;  
     	$propietario   = $_POST['propietario'] ;  
     	$inspector     = $_POST['inspector'] ;  
     	$aprobado      = $_POST['aprobado'] ;  
     	$observaciones = $_POST['observaciones'] ;  
		// $tabla  = $wpdb->prefix . 'prueba'; 
		$data   = array(
			'dictamen'      => $dictamen,
			'direccion'     => $direccion,
			'ciudad'        => $ciudad,
			'proyecto'      => $proyecto,
			'propietario'   => $propietario,
			'inspector'     => $inspector,
			'aprobado'      => $aprobado,
			'observaciones' => $observaciones
		);
		$wpdb->insert("plugins_prueba",$data) ;

?>