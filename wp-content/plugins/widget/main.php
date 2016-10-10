<?php 
/*
 Plugin Name: Primer widget 
 Plugin URI: https://www.bisionweb.com/
 Description: WordPress toolkit for Envato Marketplace hosted items. Currently supports the following theme functionality: install, upgrade, & backups during upgrade.
 Version: 1.7.2
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */ 
 class SimpleWidget extends WP_Widget{

 	function SimpleWidget(){
 		
 		$options = array(
 			"classname" => "claseCss",
 			"description" => "Descripción el widget"
 		);
 		parent::WP_Widget('claseG','Titulo del Widget',$options);

 	}
/*
=========================================================================
            ESTA FUNCION VA A MOSTRAR EN LA INTERFAZ
=========================================================================
*/
	Function widget($args,$instance){

//$args =Recogemos los argumentos y los convertimos en variables locales 
// EXTR_SKIP  = Es una constante que nos garantiza que las variables se pasen correctamente
		extract($args,EXTR_SKIP);//CONVIERTE LO QUE SEA A OBJETOS
		$title = ($instance['title']) ? ($instance['title']) : "Un widget cualquiera";
		$body =  ($instance['body']) ? ($instance['body']) : "Texto de prueba";
		?>
		<?php echo $before_widget;//Muestra los argumentos, y se pueden acceder a ellos gracias a la funcion extract ?>
		<?php echo $before_title . $title. $after_title; ?>
		<p><?php echo $body ?></p>
<?php
 	}
/*
=========================================================================
            ESTA FUNCION SE PUEDE ELIMINAR PORQUE POR LA HERENCIA EL PADRE ACTUALIZA POR DEFECTO
=========================================================================
*/
	
 	// function update($old_instance,$new_instance){
 	// }

/*
=========================================================================
            MUESTRA OPCIONES DE CONFIGURACION - FORMULARIO DEL WIDGET
=========================================================================
*/
	
 	 function form($instance){

 	 	$titulo = esc_attr($instance['title'] );
 	 	$body = esc_attr($instance['body'] );
 	?>
		<p>Titulo:</p>
		<input type="text" class="widefat" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo $titulo ?>  "><br><br>
		<textarea id="<?php echo $this->get_field_id('body') ?> " class="widefat" name="<?php echo $this->get_field_name('body') ?> ">
		<?php echo $body ?> </textarea>
 	<?php
 	 } 


 }

 /*
 =========================================================================
             FUNCION PARA REGISTRAR EL WIDGET
 =========================================================================
 */
 	
 	if (!function_exists("simple_widget_init")) {
 		
 		function simple_widget_init(){
 	
 			register_widget('SimpleWidget');
 		}
 	}
 	add_action('widgets_init', 'simple_widget_init');
