<?php 
/*
 Plugin Name: WP_list_table Prueba
 Plugin URI: https://www.bisionweb.com/
 Description: Test de aprendizaje de la clase WP_List_Table, para crear tablas en wordpress.
 Version: 1.0.0
 Author: Hernando J. Chaves
 Author URI: https://www.bisionweb.com/
 */ 

 
 if(!class_exists('WP_List_Table')){
     require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
 }

 class bision_test_table extends WP_List_Table 
 {

     
     function __construct()
     {
         global $status, $page;
                 
         //Set parent defaults
         parent::__construct( array(
             'singular'  => 'certificado',     //singular name of the listed records
             'plural'    => 'Certificados',    //plural name of the listed records
             'ajax'      => false        //does this table support ajax?
         ) );
         
     }

     /*
     =========================================================================
                LABELS DE LOS ENCABEZADOS DE NUESTRA TABLAS
     =========================================================================
     */

     function get_columns()
     {
       $columns = array(
         'cb'            => '<input type="checkbox" />',
         'dictamen'      => __('Dictamen'),
         'direccion'     => __('Direccion'),
         'ciudad'        => __('Ciudad'),
         'proyecto'      => __('Proyecto'),
         'propietario'   => __('Propietario'),
         'inspector'     => __('Inspector'),
         'aprobado'      => __('Aprobado'),
         'url_archivo'   => __('Url Archivo')
       );
       return $columns;
     }
     /*
     =========================================================================
     LE DECIMOS A NUESTRA TABLA POR QUE COLUMNAS QUEREMOS ORDENAR Y LAS 
     RETORNAMOS YA QUE SON NECESARIAS EN LA FUNCIÓN PREPARE_ITEMS().
     =========================================================================
     */     

     function get_sortable_columns() 
     {
         $sortable_columns = array(
             'dictamen'      => array('dictamen',false),
             'direccion'     => array('direccion',false),
             'ciudad'        => array('ciudad',false),
             'proyecto'      => array('proyecto',false),
             'propietario'   => array('propietario',false),
             'inspector'     => array('inspector',false),
             'aprobado'      => array('aprobado',false),
             'observaciones' => array('observaciones',false),
             'url_archivo'   => array('url_archivo',false)
         );
         return $sortable_columns;
     }
     /*
     =========================================================================
                 
     =========================================================================
     */
         public function get_chart_count(){
               global $wpdb;

               $query = "SELECT COUNT(*) FROM {$wpdb->prefix}certificados";

               $count = $wpdb->get_var( $query );

               return $count;
         } 

     /*
     =========================================================================
     COLUMNAS POR DEFECTO DE NUESTRA TABLA, DEVUELVE EL RESULTADO A CADA UNA,
      SI NO EXISTE HACE EL DEFAULT
     =========================================================================
     */

     function column_default($item,$column_name)
     {
       switch ($column_name) 
       {
         case 'dictamen':
           return $item[$column_name];
         case 'direccion':
           return $item[$column_name];
         case 'ciudad':
           return $item[$column_name];
         case 'proyecto':
           return $item[$column_name];
         case 'propietario':
           return $item[$column_name];
         case 'inspector':
           return $item[$column_name];
         case 'aprobado':
           return $item[$column_name];
         case 'url_archivo':
           return '<a href="'.$item[$column_name].'" target="_blank">Descargar</a>';
         default:
           return print_r($item,true);
           
       }
     }

     /*
     =========================================================================
     AÑADIMOS LOS ENLACES DE EDITAR Y ELIMINAR A CADA FILA DE NUESTRA TABLA            
     =========================================================================
     */  

     function column_title($item)
     {
         $actions = array(
            'edit'      => sprintf('<a href="?page=%s&action=%s&id=%s">%s</a>', $_REQUEST['page'], 'edit', $item['id'], __('Edit')),
            'duplicate' => sprintf('<a href="?page=%s&action=%s&id=%s">%s</a>', $_REQUEST['page'], 'duplicate', $item['id'], __('Duplicate')),
            'delete'    => sprintf('<a href="?page=%s&action=%s&id=%s">%s</a>', $_REQUEST['page'], 'delete', $item['id'], __('Delete')),
            'export'    => sprintf('<a href="?page=%s&action=%s&id=%s">%s</a>', $_REQUEST['page'], 'export', $item['id'], __('Export'))
         );
         
         //Return the title contents
         return sprintf('<a href="?page=%1$s&action=edit&id=%2$s" class="row-dictamen">%3$s</a> %4$s',
            /*$1%s*/ $_REQUEST['page'],
            /*$2%s*/ $item['id'],
            /*$3%s*/ $item['dictamen'],
            /*$4%s*/ $this->row_actions($actions)
         );
     }

     /*
     =========================================================================
     CREAMOS EL CAMPO HTML QUE MOSTRARÁ UN CHECKBOX PARA LAS ACCIONES EN MASA            
     =========================================================================
     */

     function column_cb($item)
     {
         return sprintf(
             '<input type="checkbox" name="%1$s[]" value="%2$s" />',
             /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
             /*$2%s*/ $item['id']                //The value of the checkbox should be the record's id
         );
     }

    

     

     /*
     =========================================================================
     ACCIONES EN MASA QUÉ QUEREMOS QUE EL CAMPO DE SELECCIÓN DEL HEADER Y FOOTER
     DE NUESTRA TABLA TENGAN, EN ESETE CASO SÓLO DELETE PARA ELIMINAR EN MASA.            
     =========================================================================
     */

     function get_bulk_actions() 
     {
         $actions = array(
             'delete'    => 'Delete'
         );
         return $actions;
     }

     /*
     =========================================================================
     PROCESA ACCIONES EN MASA, EN ESTE CASO ELIMINAR            
     =========================================================================
     */

     function process_bulk_action() 
     {
        if (isset($_REQUEST['certificado'])) $target = $_REQUEST['certificado'];

        if ($this->current_action() === 'delete') 
        {
            global $wpdb;

            //if (is_array($target)) { }

            $table = $wpdb->prefix . 'certificados';
            $wpdb->query("UPDATE $table 
                SET status = 0
                WHERE id = $target"
            );


            $count = sprintf(_n('1 map', '%s maps', count($target)), count($target));
            echo sprintf('<div class="updated notice is-dismissible"><p>%1$s deleted! <a href="?page=%2$s&action=%3$s&certificado=%4$s">%5$s</a></p><button type="button" class="notice-dismiss"></button></div>',
                /*$1%s*/ $count,
                /*$2%s*/ $_REQUEST['page'],
                /*$3%s*/ 'undo',
                /*$4%s*/ $target,
                /*$5%s*/ __('Undo')
            );
        }
        else if ($this->current_action() === 'duplicate') 
        {
            global $wpdb;
            /* debug */

            $table = $wpdb->prefix . 'certificados';

            $original = $wpdb->get_row("SELECT * FROM $table WHERE id = $target", 'ARRAY_A');

            $wpdb->insert(
                $table,
                array(
                    'dictamen'    => '[Duplicate] ' . $original['dictamen'],
                    'direccion'   => $original['direccion'],
                    'ciudad'      => $original['ciudad'],
                    'proyecto'    => $original['proyecto'],
                    'propietario' => $original['propietario'],
                    'inspector'   => $original['inspector'],
                    'aprobado'    => $original['aprobado'],
                    'url_archivo' => $original['url_archivo']
                )
            );
        }
        else if ($this->current_action() === 'export') {
        }
        else if ($this->current_action() === 'undo') {
            global $wpdb;

            $table = $wpdb->prefix . 'certificados';
            $wpdb->query("UPDATE $table 
                SET status = 1
                WHERE id = $target"
            );

            $count = sprintf(_n('1 Certificado', '%s Certificados', count($target)), count($target));
            echo sprintf('<div class="updated notice is-dismissible"><p>%1$s Restaurados.</p><button type="button" class="notice-dismiss"></button></div>', $count);
        }
     }
     /*
     =========================================================================
                 DATA
     =========================================================================
     */
         private function table_data()
        {
           $data = array();
           global $wpdb;
           $table_name = $wpdb->prefix.'certificados';
           
           $whereCnd = '';
           if(isset($_REQUEST['s']))
           {
              $whereCnd = ' Search query ' ;
           }

           $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
           
           // obtenemos el campo por el que se está ordenando, si no hay ninguno lo hacemos por el id
           $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? 
                       $_REQUEST['orderby'] : 'id';
           
           // orden ascendente o descendente
           $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? 
                    $_REQUEST['order'] : 'asc';


           $wpdb -> show_errors ();
           $listsData = $wpdb->get_results(
                 $wpdb->prepare(
                     "SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged), ARRAY_A );
           if($wpdb->last_error !== '') :
               $wpdb->print_error();
           endif;
           // exit();
           if(!empty($listsData)) 
           {
            
                foreach($listsData as $key => $val)
                {
                     $delNonce = wp_create_nonce( 'wp-list-'.$val->id.'-delete-nonce' );
                     $data[] = array(

                        'id'            => $val->id,
                        'dictamen'      => $val->dictamen,
                        'direccion'     => $val->direccion,
                        'ciudad'        => $val->ciudad,
                        'proyecto'      => $val->proyecto,
                        'propietario'   => $val->propietario,
                        'inspector'     => $val->inspector,
                        'aprobado'      => $val->aprobado,
                        'observaciones' => $val->observaciones,
                        'url_archivo'   => $val->url_archivo
                  
                     );
                }
           } 
                 return $data;
        }

	/*
	=========================================================================
	      PREPARAMOS LOS DATOS PARA MOSTRARLOS      
	=========================================================================
	*/
        function prepare_items() {
            global $wpdb;

            $per_page = 4;
            
            $columns = $this->get_columns();
            $hidden = array();
            $sortable = $this->get_sortable_columns();
            
            $this->_column_headers = array($columns, $hidden, $sortable);
            
            $this->process_bulk_action();
            
            // Database Query
            $table_name = $wpdb->prefix . 'certificados';

            $query = "SELECT * FROM $table_name";

            //Parameters that are going to be used to order the result
            $orderby = !empty($_GET["orderby"]) ? $_GET["orderby"] : 'ASC';
            $order = !empty($_GET["order"]) ? $_GET["order"] : '';
            if (!empty($orderby) & !empty($order)) { $query .= ' ORDER BY ' . $orderby . ' ' . $order; }

            // Number of elements
            $total_items = $wpdb->query($query);

            // Page number
            $paged = !empty($_GET["paged"]) ? $_GET["paged"] : '';

            //Page Number
            if (empty($paged) || !is_numeric($paged) || $paged <= 0) { $paged = 1; }

            //adjust the query to take pagination into account
            if (!empty($paged) && !empty($per_page)) {
                $offset = ($paged - 1) * $per_page;
                $query .= ' LIMIT ' . (int)$offset . ', ' . (int)$per_page;
            }
            
            // Register pagination
            $this->set_pagination_args( array(
                'total_items' => $total_items,
                'per_page'    => $per_page,
                'total_pages' => ceil($total_items/$per_page)
            ));

            // Add items
            $this->items = $wpdb->get_results($query, 'ARRAY_A');
        }
	
     


 }
		 /*
		 =========================================================================
		   AGREGAMOS ITEMS AL MEMU Y AL SUBMENU            
		 =========================================================================
		 */
		  add_action('admin_menu', 'tt_add_menu_items');

		 function bision_add_menu_items()
		 {
		   
		     add_menu_page( 'cetificado_new', 'Certificados TEST', 'manage_options', 'certificado', 'crsas_render_list_page', plugins_url('../img/icon.png',__FILE__ ), '20' );
		    
		     add_submenu_page( 'new_certificado', 'certificadoslist', 'Añadir Certificado', 'manage_options', 'submenu_certificados', 'bision_add_new_html' );
		  
		 }
		 add_action( 'admin_menu', 'bision_add_menu_items' );





 /** *************************** RENDER TEST PAGE ********************************
  *******************************************************************************
  * This function renders the admin page and the example list table. Although it's
  * possible to call prepare_items() and display() from the constructor, there
  * are often times where you may need to include logic here between those steps,
  * so we've instead called those methods explicitly. It keeps things flexible, and
  * it's the way the list tables are used in the WordPress core.
  */
 function crsas_render_list_page(){
     
     //Create an instance of our package class...
     $testListTable = new bision_test_table();
     //Fetch, prepare, sort, and filter our data...
     $testListTable->prepare_items();
     
     ?>
     <div class="wrap">
         
         <div id="icon-users" class="icon32"><br/></div>
         <h2>List Table Test</h2>
         
         <div style="background:#ECECEC;border:1px solid #CCC;padding:0 10px;margin-top:5px;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;">
             <p>This page demonstrates the use of the <tt><a href="http://codex.wordpress.org/Class_Reference/WP_List_Table" target="_blank" style="text-decoration:none;">WP_List_Table</a></tt> class in plugins.</p> 
             <p>For a detailed explanation of using the <tt><a href="http://codex.wordpress.org/Class_Reference/WP_List_Table" target="_blank" style="text-decoration:none;">WP_List_Table</a></tt>
             class in your own plugins, you can view this file <a href="<?php echo admin_url( 'plugin-editor.php?plugin='.plugin_basename(__FILE__) ); ?>" style="text-decoration:none;">in the Plugin Editor</a> or simply open <tt style="color:gray;"><?php echo __FILE__ ?></tt> in the PHP editor of your choice.</p>
             <p>Additional class details are available on the <a href="http://codex.wordpress.org/Class_Reference/WP_List_Table" target="_blank" style="text-decoration:none;">WordPress Codex</a>.</p>
         </div>
         
         <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
         <form id="movies-filter" method="get">
             <!-- For plugins, we also need to ensure that the form posts back to our current page -->
             <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
             <!-- Now we can render the completed list table -->
             <?php $testListTable->display() ?>
         </form>
         
     </div>
     <?php
 }