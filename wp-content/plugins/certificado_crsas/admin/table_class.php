<?php

// require_once(plugin_dir_path(__FILE__).'../includes/search.php');


    // if (! class_exists('WP_List_Table')) 
    // {
    //   require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php');                                                    
    // }
    // require_once(plugin_dir_path(__FILE__).'../includes/view_dashboard.php');


    // class Bision_table_admin extends WP_List_Table
    // {
    //   function __construct()
    //   {
    //     parent::__construct(
    //       array(
    //         'ajax'     => false,
    //         'plural'   => __('Certificados','udplistable'),
    //         'singular' => __('Certificado','udplistable')
    //       )
    //     );
    //   }
/*
=========================================================================
COLUMNAS POR DEFECTO DE NUESTRA TABLA, DEVUELVE EL RESULTADO A CADA UNA,
 SI NO EXISTE HACE EL DEFAULT
=========================================================================
*/
      // function column_default($item,$column_name)
      // {
      //   switch ($column_name) 
      //   {
      //     case 'dictamen':
      //       return $item[$column_name];
      //     case 'direccion':
      //       return $item[$column_name];
      //     case 'ciudad':
      //       return $item[$column_name];
      //     case 'proyecto':
      //       return $item[$column_name];
      //     case 'propietario':
      //       return $item[$column_name];
      //     case 'inspector':
      //       return $item[$column_name];
      //     case 'aprobado':
      //       return $item[$column_name];
      //     case 'url_archivo':
      //       return '<a href="'.$item[$column_name].'" target="_blank">Descargar</a>';
      //     default:
      //       return print_r($item,true);
            
      //   }
      // }
/*
=========================================================================
           LABELS DE LOS ENCABEZADOS DE NUESTRA TABLAS
=========================================================================
*/
    // function get_columns()
    // {
    //   $columns = array(
    //     'cb'            => '<input type="checkbox" />',
    //     'dictamen'      => __('Dictamen','udplistable'),
    //     'direccion'     => __('Direccion','udplistable'),
    //     'ciudad'        => __('Ciudad','udplistable'),
    //     'proyecto'      => __('Proyecto','udplistable'),
    //     'propietario'   => __('Propietario','udplistable'),
    //     'inspector'     => __('Inspector','udplistable'),
    //     'aprobado'      => __('Aprobado','udplistable'),
    //     'url_archivo'   => __('Url Archivo','udplistable'),
    //   );
    //   return $columns;
    // }

  /*
  =========================================================================
              SEARCH BOX
  =========================================================================
  */
    // function search_box( $text, $input_id ) 
    // {
    //     if ( empty( $_REQUEST['s'] ) && !$this->has_items() )
    //         return;

    //     $input_id = $input_id . '-search-input';

    //     if ( ! empty( $_REQUEST['orderby'] ) )
    //         echo '<input type="hidden" name="orderby" value="' . esc_attr( $_REQUEST['orderby'] ) . '" />';
    //     if ( ! empty( $_REQUEST['order'] ) )
    //         echo '<input type="hidden" name="order" value="' . esc_attr( $_REQUEST['order'] ) . '" />';
    //     if ( ! empty( $_REQUEST['post_mime_type'] ) )
    //         echo '<input type="hidden" name="post_mime_type" value="' . esc_attr( $_REQUEST['post_mime_type'] ) . '" />';
    //     if ( ! empty( $_REQUEST['detached'] ) )
    //         echo '<input type="hidden" name="detached" value="' . esc_attr( $_REQUEST['detached'] ) . '" />';
    ?>
    <p class="search-box">
    <label class="screen-reader-text" for="<?php echo $input_id ?>"><?php echo $text; ?>:</label>
    <input type="search" id="<?php echo $input_id ?>" name="s" value="<?php _admin_search_query(); ?>" />
    <?php //submit_button( $text, 'button', false, false, array('id' => 'search-submit') ); ?>
    </p>
    <?php
    }
/*
=========================================================================
            PREPARAMOS LOS DATOS PARA PAGINAR
=========================================================================
*/
    // function prepare_items() 
    // {
    //     //objecto global wp
    //     global $wpdb;
    //     $current_screen = get_current_screen();
    //     var_dump($current_screen);
    //     exit();
 
    //     //nombre de la tabla con el prefijo
    //     $table_name = $wpdb->prefix . 'certificados'; 
 
    //     // items por página
    //     $per_page   = 6;
 
    //     $columns    = $this->get_columns();
    //     $hidden     = array();
    //     $sortable   = $this->get_sortable_columns();
 
        // columnas del encabezado de nuestra tabla
    //     $this->_column_headers = array($columns, $hidden, $sortable);
 
    //     $this->process_bulk_action();
 
    //     // total de items a paginar
    //     $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name");
 
    //     // obtenemos el número de página en la que estamos, 0 es la primera
    //     $paged = isset($_GET['paged']) ? 
    //              max(0, intval($_GET['paged']) - 1) : 
    //              0;
 
    //     // obtenemos el campo por el que se está ordenando, si no hay ninguno lo hacemos por el id
    //     $orderby = (isset($_GET['orderby']) && in_array($_GET['orderby'], array_keys($this->get_sortable_columns()))) ? 
    //                 $_GET['orderby'] : 
    //                 'id';
 
    //     // orden ascendente o descendente
    //     $order = (isset($_GET['order']) && in_array($_GET['order'], array('asc', 'desc'))) ? 
    //              $_GET['order'] : 
    //              'asc';
 
 
    //     // Obtenemos los datos paginados en forma de array con el parámetro ARRAY_A
    //     $this->items = $wpdb->get_results(
    //         $wpdb->prepare(
    //             "SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, ($paged*$per_page)
    //         ), 
    //         ARRAY_A
    //     );
 
    //     // configuramos la paginación
    //     $this->set_pagination_args(array(
    //         'total_items' => $total_items, // total items
    //         'per_page'    => $per_page, // items por página
    //         'total_pages' => ceil($total_items / $per_page) // páginas en total para los enlaces de la paginación
    //     ));
    //     //Implementamos el search box 
    //     // Si el valor es diferente de nulo, hacemos la busqueda 
    //     if( $search != NULL ){
               
    //             // Trim Search Term
    //             $search = trim($search);
               
    //             /* Notice how you can search multiple columns for your search term easily, and return one data set */
    //             $data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE `dictamen` LIKE '%%%s%%' ", $search, $search), ARRAY_A);
         
    //     }
    // }



/*
=========================================================================
LE DECIMOS A NUESTRA TABLA POR QUE COLUMNAS QUEREMOS ORDENAR Y LAS 
RETORNAMOS YA QUE SON NECESARIAS EN LA FUNCIÓN PREPARE_ITEMS().
=========================================================================
*/
         // function get_sortable_columns()
         // {
         //    $get_sortable_columns = array(
         //        'id'            => array('id',true),
         //        'dictamen'      => array('dictamen',true),
         //        'direccion'     => array('direccion',true),
         //        'ciudad'        => array('ciudad',true),
         //        'proyecto'      => array('proyecto',true),
         //        'propietario'   => array('propietario',true),
         //        'inspector'     => array('inspector',true),
         //        'aprobado'      => array('aprobado',true),
         //        'observaciones' => array('observaciones',true),
         //        'url_archivo'   => array('url_archivo',true)
         //    );
         // }
/*
=========================================================================
AÑADIMOS LOS ENLACES DE EDITAR Y ELIMINAR A CADA FILA DE NUESTRA TABLA            
=========================================================================
*/  
         // function column_id($item) 
         // {
             
         //      $actions = array(
         //          'edit'   => sprintf('<a href="?page=submenu_certificados&id=%s">%s</a>', $item['id'],'Editar'),
         //          'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], 'Eliminar'),
         //      );
       
         //       return sprintf('%s %s', $item['id'], $this->row_actions($actions) );
         // }
/*
=========================================================================
ACCIONES EN MASA QUÉ QUEREMOS QUE EL CAMPO DE SELECCIÓN DEL HEADER Y FOOTER
DE NUESTRA TABLA TENGAN, EN ESETE CASO SÓLO DELETE PARA ELIMINAR EN MASA.            
=========================================================================
*/
         // function get_bulk_actions() 
         // {
         //     $actions = array(
         //         'delete' => 'Eliminar',
         //         'edit'   => 'Editar'   
         //     );
         //     return $actions;
         // }
/*
=========================================================================
PROCESA ACCIONES EN MASA, EN ESTE CASO ELIMINAR            
=========================================================================
*/
          // function process_bulk_action()
          // {
          //     global $wpdb;
          //     $table_name = $wpdb->prefix . 'certificados'; 
       
          //           //si la acción actual es delete significa que estamos eliminando
          //           if ('delete' === $this->current_action()) 
          //           {
          //               $ids = isset($_GET['id']) ? $_GET['id'] : array();
          //               //si es un array de ids
          //               if (is_array($ids)) 
          //               {
          //                   $ids = implode(',', $ids);
          //               }
       
          //               //si hay ids eliminamos
          //               if (!empty($ids)) 
          //               {
          //                   $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
          //               }
          //           }
          // }
/*
=========================================================================
CREAMOS EL CAMPO HTML QUE MOSTRARÁ UN CHECKBOX PARA LAS ACCIONES EN MASA            
=========================================================================
*/
          // function column_cb($item) 
          // {
          //     return sprintf(
          //         '<input type="checkbox" name="id[]" value="%s" />', $item['id']
          //     );    
          // }
/*
=========================================================================
FUNCIÓN QUE SE EJECUTARÁ CUANDO NO EXISTAN ITEMS            
=========================================================================
*/
          // function no_items() 
          // {
          //     _e( 'No se encontrarón resultados.' );
          
          // }

}
/*
=========================================================================
  AGREGAMOS ITEMS AL MEMU Y AL SUBMENU            
=========================================================================
*/
          // add_action( 'admin_menu', 'udp_add_menu_items' );
           
           
          /**
          * añade la opción al menú de administración con sus hijos
          */
          // function udp_add_menu_items()
          // {
            
          //     add_menu_page( 'cetificado_new', 'Certificados CRSAS', 'manage_options', 'new_certificado', 'udp_render_list_page', plugins_url('../img/icon.png',__FILE__ ), '20' );
             
          //     add_submenu_page( 'new_certificado', 'certificadoslist', 'Añadir Certificado', 'manage_options', 'submenu_certificados', 'bision_add_new_html' );
           
          // }
           
          /**
          * muestra el formulario para crear y editar nuevos elementos
          */
          
           
          /**
          * pinta la tabla final
          */
          // function udp_render_list_page()
          // {
          //   $udpListTable = new Bision_table_admin();
            // $udpListTable->prepare_items();
            // if(isset($_POST['s']))
            // {
            //         $udpListTable->prepare_items($_POST['s']);
            // } else {
            //         $udpListTable->prepare_items();
            // }
           
            //si se ha eliminado algo creamos el mensaje con las clases de wordpress
            // $message = '';
            //   if ('delete' === $udpListTable->current_action()) 
            //   {
            //       $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items eliminados: %d', 'udplisttable'), 
            //         count($_GET['id'])) . '</p></div>';
            //   }
            ?>
            <!-- <div class="wrap">
           
                <h2><?php _e('Certificados CRSAS', 'udplisttable')?> 
                <a class="add-new-h2" href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=submenu_certificados');?>">
                  <?php _e('Nuevo Certificado', 'udplisttable')?>
                </a>
                </h2>
                <?php echo $message; ?>
                <form method="post" action="<?php  plugin_dir_path(__FILE__).'../includes/search.php' ?>">
                    <input type="hidden" name="page" id="s_dictamen" value="<?php echo $_REQUEST['page'] ?>" />
                  <?php $udpListTable->search_box('Buscar Certificado', 's_dictamen'  ); ?>
                </form> <br><br><br>
                      
                <form id="search-table" method="GET">
                    <input type="hidden" name="page" value="<?php echo $_GET['page'] ?>"/>
                    <?php $udpListTable->display() ?>
                </form>
            </div> -->
            <?php
          }


    
