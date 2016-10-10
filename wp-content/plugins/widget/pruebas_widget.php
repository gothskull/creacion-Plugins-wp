<?php 
/*
 Plugin Name: Practic Octubre 3 - Widget
 Plugin URI: https://www.bisionweb.com/
 Description: lorem30
 Version: 1.0		
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */ 

class October_widget extends WP_Widget{

	function October_widget(){
		$opciones= array(
			'classname' => 'class_css',
			'description' => 'Desripcion por defecto'
		);
	$this->WP_Widget('name_page','Widget de Octubre',$opciones);
	}


	function widget($args,$instance){

		extract($args,EXTR_SKIP);
		$title = ($instance['title']) ? ($instance['title']) : 'Widget por defecto';
		$body = ($instance['body']) ? ($instance['body']) : 'Descripción por defecto';
		?>
		<?php echo $before_widget ?>
		<?php echo $before_title . $title . $after_title ?>
		<p><?php echo $body ?></p>

		<?php


	}

	function form($instance){

		$titulo = esc_attr($instance['title'] );
		$body = esc_attr($instance['body'] );
		?>
		<label for="">Titulo: </label>
		<input type="text" class="widefat" name="<?php echo $this->get_field_name('title') ?>" value="<?php echo $titulo ?>"><br><br>
		<textarea class="widefat" name="<?php echo $this->get_field_name('body') ?>"  cols="30" rows="10"><?php echo $body ?></textarea>
		<?php


	}

}
	if (!function_exists("reg_widget_october")) {
		
		function reg_widget_october(){
	
			register_widget('October_widget');
	
		}
	}
	 add_action('widgets_init','reg_widget_october' );
	



