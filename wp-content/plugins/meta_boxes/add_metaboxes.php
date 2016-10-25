<?php 
/*
 Plugin Name: Agregando Metaboxes
 Plugin URI: https://www.bisionweb.com/
 Description: lorem30
 Version: 1.0
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */ 	


 if (!function_exists("bision_add_metaboxes")) {
 	
 	function bision_add_metaboxes()
  {
 
 		add_meta_box('bision_field', 'Metabox de Prueba','bision_add_metabox_field','post','normal','high' );
 
 	}
 }
  add_action('add_meta_boxes','bision_add_metaboxes' );

  if (!function_exists("bision_add_metabox_field")) {
  	
  	function bision_add_metabox_field()
    {

  		  wp_nonce_field( basename( __FILE__ ),'bision_jobs_nonce' );
        $bision_stored_meta = get_post_meta( $post->ID );

  		?>
		 <div class="meta-row">
       <div class="meta-th">
         <label for="">Campo de Prueba</label>
       </div>
       <div class="meta-td">
          <input type="text" class="datepicker" name="metabox_prueba" id="metabox_prueba" value="<?php if(! empty ( $bision_stored_meta['metabox_prueba'] ) ) echo esc_attr( $bision_stored_meta['metabox_prueba'][0] ); ?>">
       </div>
     </div>
     <div class="meta-row">
       <div class="meta-th">
         <label for="">Segundo Campo</label>
       </div>
       <div class="meta-td">
          <input type="text" class="datepicker" name="segundo_campo" id="segundo_campo" value="<?php if(! empty ( $bision_stored_meta['segundo_campo'] ) ) echo esc_attr( $bision_stored_meta['metabox_prueba'][0] ); ?>">
       </div>
     </div>
     <div class="meta">
       <div class="meta-th">
          <span>Titulo del Editor</span>
        </div>
     </div>
     <div class="meta-editor">
  		<?php
/*
=========================================================================
            RECOGE LOS DATOS DEL EDITOR PARA ALMACENARLOS
=========================================================================
*/
        
  		    $content  = get_post_meta($post->ID,'editor_goth',true );
          $editor   = "editor_goth";
          $settings = array(
              'textarea_rows' => 8,
              'media_buttons' => false
          );
          wp_editor( $content, $editor, $settings );
      ?>
      </div>

      <?php
  
  	}
  }
/*
=========================================================================
            FUNCION PARA GUARDAR DE MANERA SEGURA LOS DATOS DEL METABOX
=========================================================================
*/
  
  if (!function_exists("bision_meta_save")) {
    
    function bision_meta_save( $post_id )
    {
  
      $is_autosave    = wp_is_post_autosave( $post_id );
      $is_revision    = wp_is_post_revision( $post_id );
      $is_valid_nonce = ( isset( $_POST[ 'bision_jobs_nonce' ] )  && wp_verify_nonce( $_POST['bision_jobs_nonce'], basename( __FILE__) ) ) ? 'true' : 'false';
      
      if ( $is_autosave || $is_revision || !$is_valid_nonce) {
        return;
      }

      if ( isset( $_POST[ 'metabox_prueba' ] ) ) {
        
        update_post_meta( $post_id, 'metabox_prueba', sanitize_text_field( $_POST[ 'metabox_prueba'] ) );

      }

      if ( isset( $_POST[ 'segundo_campo' ] ) ) {
        
        update_post_meta( $post_id, 'segundo_campo', sanitize_text_field( $_POST[ 'segundo_campo'] ) );

      }
      if ( isset( $_POST[ 'editor_goth' ] ) ) {
        
        update_post_meta( $post_id, 'editor_goth', sanitize_text_field( $_POST[ 'editor_goth'] ) );

      }
    }
  }
  add_action( 'save_post', 'bision_meta_save'  );
/*
=========================================================================
            FUNCION PARA AGREGAR SCRIPTS JS Y ESTILOS CS
=========================================================================
*/
  if (!function_exists("bision_add_scripts_metabox")) {
       
       function bision_add_scripts_metabox(){
     
        global $pagenow,$typenow;
        $screen = get_current_screen();

        if (($pagenow == 'post.php'  ||  $pagenow == 'post-new.php') && $typenow == 'post') {
          wp_enqueue_script( 'java_metabox',plugins_url('js/myjava_metabox.js',__FILE__),array('jquery','jquery-ui-datepicker'), '1.001', true );
          wp_enqueue_script('metabox_quick_tag',plugins_url('js/quick_tag.js',__FILE__ ),array('jquery'),'1.002',true );
          wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );

        }
     
       }
     }
      add_action('admin_enqueue_scripts','bision_add_scripts_metabox' );



  
  
 