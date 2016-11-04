<?php 
/*
 Plugin Name: Certificados New Version
 Plugin URI: https://www.bisionweb.com/
 Description:  Plugin para la creación, almacenamiento en base de datos, visualización y descarga de los certificados expedidos por la empresa.
 Version: 1.0
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */ 

require_once(plugin_dir_path(__FILE__).'/admin/table_class.php');
require_once(plugin_dir_path(__FILE__).'/includes/db_actions.php');
require_once(plugin_dir_path(__FILE__).'/includes/view_dashboard.php');
require_once(plugin_dir_path(__FILE__).'/includes/adding_scripts.php');


 /*
 =========================================================================
             AGREGAMOS ITEM DE MENU EN EL ESCRITORIO
 =========================================================================
 */


 if (!function_exists("bision_iniciar_plugin")) {
 	
 	function bision_iniciar_plugin()
  {
 
 		add_menu_page( 'cetificado_new', 'Nuevo Certificado', 'manage_options', 'new_certificado', 'bision_add_new_html', plugins_url('img/icon.png',__FILE__ ), '20' );
 
 	}
 }
  add_action('admin_menu','bision_iniciar_plugin' );
  
/*
=========================================================================
           REGISTRAMOS LOS CAMPOS
=========================================================================
*/

  if (!function_exists("bision_register_new_certificado")) {
  	
  	function bision_register_new_certificado()
    {
  
  		register_setting('certificados_crsas','dictamen' );
  
  	}
  }
   add_action('admin_init','bision_register_new_certificado' );
   /*
   =========================================================================
               AGREGAR SUBMENU OPTIONS
   =========================================================================
   */
   if (!function_exists("bision_add_submenu_certificados")) {
     
     function bision_add_submenu_certificados()
     {
   
       add_submenu_page( 'new_certificado', 'certificadoslist', 'Lista de Certificados', 'manage_options', 'submenu_certificados', 'bision_render_list_page' );
   
     }
   }
    add_action('admin_menu','bision_add_submenu_certificados' );


   
   
/*  
=========================================================================
 LLAMAMOS A LA CLASE QUE CREA EL LISTADO DE CERTIFICADOS           
=========================================================================
*/
          function bision_render_list_page()
          {
    
            //Create an instance of our package class...
            $testListTable = new Bision_table_admin();
            //Fetch, prepare, sort, and filter our data...
            $testListTable->prepare_items();
            
            ?>
            <div class="wrap">
                
                <div id="icon-users" class="icon32"><br/></div>
                <h2>Lista de Certificados</h2>
                <form id="movies-filter" method="get">
                    <!-- For plugins, we also need to ensure that the form posts back to our current page -->
                    <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
                    <!-- Now we can render the completed list table -->
                    <?php $testListTable->display() ?>
                </form>
                
            </div>
            <?php
    }