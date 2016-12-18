<?php
/*
Plugin Name: Tablas Nativas 
Plugin URI: http://www.mattvanandel.com/
Description: A highly documented plugin that demonstrates how to create custom List Tables using official WordPress APIs.
Version: 1.4.1
Author: Matt van Andel
Author URI: http://www.mattvanandel.com
License: GPL2
*/

if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class tablas_nativas_test extends WP_List_Table 
{


    function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'Nativa',     //singular name of the listed records
            'plural'    => 'Nativas',    //plural name of the listed records
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
                data
    =========================================================================
    */
         function get_all_charts(){
            global $wpdb;
            $table = $wpdb->prefix.'certificados';
            $query = "SELECT * FROM $table";

            if(isset($_REQUEST['s'])){
                $query .= " WHERE dictamen LIKE '%".sanitize_text_field($_POST['s'])."%' ";
            }

            if(isset($_REQUEST['orderby'])){
                if( in_array( 
                        $_REQUEST['orderby'], 
                        array(
                            'id',
                            'dictamen'
                            )
                        )
                        ){
                    $query .= " ORDER BY ".$_GET['orderby'];
                    if($_REQUEST['order'] == 'desc'){
                        $query .= " DESC ";
                    }else{
                        $query .= " ASC ";
                    }
                }
            }else{
                $query .= " ORDER BY id ASC ";
            }

            if(isset($_REQUEST['paged'])){
                    $paged = (int) $_REQUEST['paged'];
            }else{
                    $paged = 1;
            }

            $tables_per_page = get_option('wdtTablesPerPage') ? get_option('wdtTablesPerPage') : 10;

            $query .= " LIMIT ".($paged-1)*$tables_per_page.", ".$tables_per_page;

            $all_charts = apply_filters( 'crsas_certi', $wpdb->get_results( $query, ARRAY_A ) );

            return $all_charts;
        }

    function column_default($item, $column_name)
    {
        switch($column_name)
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
            ACCIONES DE COLUMNA
=========================================================================
*/
    
    public function column_title($item){
            $actions = array(
                    'edit' => '<a href="admin.php?page=nativas_test&id='.$item['id'].'" title="'.__('Edit','wpdatatables').'">'.__('Edit','wpdatatables').'</a>',
                    'trash' => '<a class="submitdelete" title="'.__('Delete','wpdatatables').'" href="admin.php?page=nativas_test&action=delete&id='.$item['id'].'" rel="'.$item['id'].'">'.__('Delete','wpdatatables').'</a>'
            );

            return '<a href="admin.php?page=nativas_test&id='.$item['id'].'">'.$item['direccion'].'</a> '.$this->row_actions($actions);

    }
    /*
    =========================================================================
                ACCIONESEN BLOQUE
    =========================================================================
    */
        
    function get_bulk_actions() {
        $actions = array(
            'delete'    => 'Delete'
        );
        return $actions;
    }


    function column_cb($item){
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            /*$2%s*/ $item['ID']                //The value of the checkbox should be the record's id
        );
    }


    function process_bulk_action() {
        
        //Detect when a bulk action is being triggered...
        if( 'delete'===$this->current_action() ) {
            wp_die('Items deleted (or they would be if we had items to delete)!');
        }
        
    }

    public function prepare_items(){
        $current_page = $this->get_pagenum();

        $per_page = get_option('wdtTablesPerPage') ? get_option('wdtTablesPerPage') : 10;

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);

        $this->set_pagination_args(
                array(
                    'total_items' => $this->get_chart_count(),
                    'per_page' => $per_page
                )
        );

        $this->items = $this->get_all_charts();
    }


}




/** ************************ REGISTER THE TEST PAGE ****************************
 *******************************************************************************
 * Now we just need to define an admin page. For this example, we'll add a top-level
 * menu item to the bottom of the admin menus.
 */
function test_tablas_nativas(){
    add_menu_page('Example Plugin List Table', 'Test Tablas Nativas', 'activate_plugins', 'nativas_test', 'bision_tablas_nativasswp');
    add_submenu_page( 'nativas_test', 'nativas nativas', 'Agregar Certificado', 'activate_plugins', 'slug_nativas_test', 'aqui_va_formulario' );
} add_action('admin_menu', 'test_tablas_nativas');

function aqui_va_formulario()
{
   echo "formulario AQUI"; 
}





/** *************************** RENDER TEST PAGE ********************************
 *******************************************************************************
 * This function renders the admin page and the example list table. Although it's
 * possible to call prepare_items() and display() from the constructor, there
 * are often times where you may need to include logic here between those steps,
 * so we've instead called those methods explicitly. It keeps things flexible, and
 * it's the way the list tables are used in the WordPress core.
 */
function bision_tablas_nativasswp(){
    
    //Create an instance of our package class...
    $testListTable = new tablas_nativas_test();
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
class Test_test_tables extends tablas_nativas_test
{
    function single_row_columns($item) {
           list($columns, $hidden) = $this->get_column_info();
                foreach ($columns as $column_name => $column_display_name) {
                       $class = "class='$column_name column-$column_name'";

                       $style = '';
                       if (in_array($column_name, $hidden))
                             $style = ' style="display:none;"';

                       $attributes = "$class$style";

                       if ('cb' == $column_name) {
                       echo  "<td $attributes>";
                       echo '<input type="checkbox" name="id[]" value="%s" />', $item['ID'];
                       echo "</td>";
                            }
                   elseif ('galname' == $column_name) {
                   echo "<td $attributes>";
                   echo '<a href="#">', $item['galname'];
                   echo "</a>";

                       echo "<div class='row-actions'><span class='edit'>";
               echo sprintf('<a href="?page=%s&action=%s&gid=%s">Edit</a>',$_REQUEST['page'],'edit',$item['id']);
                       echo "</span> | <span class='trash'>";
               echo sprintf('<a href="?page=%s&action=%s&gid=%s">Delete</a>',$_REQUEST['page'],'delete',$item['id']);
               echo "</span></div></td>";
                                                        }
                else {
                    echo "<td $attributes>";
                    echo $this->column_default( $item, $column_name );
                    echo "</td>";
                } } }
}