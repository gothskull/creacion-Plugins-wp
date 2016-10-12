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
 	
 	function bision_add_metaboxes(){
 
 		add_meta_box('bision_field', 'Metabox de Prueba','bision_add_metabox_field','post','normal','high' );
 
 	}
 }
  add_action('add_meta_boxes','bision_add_metaboxes' );

  if (!function_exists("bision_add_metabox_field")) {
  	
  	function bision_add_metabox_field(){

  		  wp_nonce_field( basename( __FILE__ ),'bision_jobs_nonce' );
        $bision_stored_meta = get_post_meta( $post->ID );

  		?>
		 <div class="meta-row">
       <div class="meta-th">
         <label for="">Campo de Prueba</label>
       </div>
       <div class="meta-td">
          <input type="text" name="metabox_prueba" id="metabox_prueba" value="<?php if(! empty ( $bision_stored_meta['metabox_prueba'] ) ) echo esc_attr( $bision_stored_meta['metabox_prueba'][0] ); ?>">
       </div>
     </div>
     <div class="meta-row">
       <div class="meta-th">
         <label for="">Segundo Campo</label>
       </div>
       <div class="meta-td">
          <input type="text" name="segundo_campo" id="segundo_campo" value="<?php if(! empty ( $bision_stored_meta['segundo_campo'] ) ) echo esc_attr( $bision_stored_meta['metabox_prueba'][0] ); ?>">
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
    
    function bision_meta_save( $post_id ){
  
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
   
  

  
  
 