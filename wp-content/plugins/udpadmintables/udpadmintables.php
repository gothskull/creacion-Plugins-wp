<?php
/*
Plugin Name: Tabla de pruerba BisionWeb
Description: Crea una tabla de administración para nuestro plugin en wordpress
Plugin URI: http://#
Author: Author
Author URI: http://#
Version: 1.0
License: GPL2
*/

//si no ha sido cargada la clase WP_List_Table la requerimos
if( ! class_exists( 'WP_List_Table' ) ) 
{
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Udp_List_Table extends WP_List_Table 
{

	public function getPosts()
	{

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$loop = new WP_Query( 
			array(
				'post_type' => 'post',
				'orderby'=> 'dictamen',
				'paged'=>$paged
			) 
		);
		$posts = $loop->get_posts();
		$data = array();

		foreach($posts as $post) 
		{
		    $data[] = array(
		    	"dictamen"	  => $post->dictamen,
		    	"direccion"   => $post->direccion,
                "ciudad"      => $post->ciudad,
                "proyecto"    => $post->proyecto,
                "propietario" => $post->propietario,
                "inspector"   => $post->inspector,
                "aprobado"    => $post->aprobado,
		    	"url_archivo" => $post->url_archivo,	    	
		    );
		}
		return $data;
	}

    /**
	* constructor
	*/
    function __construct()
    {
	    //global $status, $page;
        parent::__construct( 
        	array(
	            'singular'  => __( 'Búsqueda', 'retie_sas' ),     //singular
	            'plural'    => __( 'Búsquedas', 'retie_sas' ),   //plural
	            'ajax'      => false        //soporte ajax
    		) 
       	);
    }

    /**
	* columnas por defecto de nuestra tabla, devuleve el resultado a cada una, si no existe hace el default
	*/
  	function column_default( $item, $column_name ) 
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

  	/**
	* Labels de los encabezados de nuestra tablas
	*/
	function get_columns()
	{
        $columns = array(
          'cb'            => '<input type="checkbox" />',
          'dictamen'      => __('Dictamen','retie_sas'),
          'direccion'     => __('Direccion','retie_sas'),
          'ciudad'        => __('Ciudad','retie_sas'),
          'proyecto'      => __('Proyecto','retie_sas'),
          'propietario'   => __('Propietario','retie_sas'),
          'inspector'     => __('Inspector','retie_sas'),
          'aprobado'      => __('Aprobado','retie_sas'),
          'url_archivo'   => __('Url Archivo','retie_sas'),
        );
        return $columns;
    }

	/**
	* Prepara los datos a paginar
	*/
	function prepare_items() 
	{
		//objecto global wp
	  	global $wpdb;

	  	//nombre de la tabla con el prefijo
        $table_name = $wpdb->prefix . 'certificados'; 

        // items por página
        $per_page = 4;

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        // columnas del encabezado de nuestra tabla
        $this->_column_headers = array($columns, $hidden, $sortable);

        $this->process_bulk_action();

        // total de items a paginar
        $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name");

        // obtenemos el número de página en la que estamos, 0 es la primera
        $paged = isset($_GET['paged']) ? 
        		 max(0, intval($_GET['paged']) - 1) : 
        		 0;

       	// obtenemos el campo por el que se está ordenando, si no hay ninguno lo hacemos por el id
        $orderby = (isset($_GET['orderby']) && in_array($_GET['orderby'], array_keys($this->get_sortable_columns()))) ? 
        			$_GET['orderby'] : 
        			'id';

        // orden ascendente o descendente
        $order = (isset($_GET['order']) && in_array($_GET['order'], array('asc', 'desc'))) ? 
        		 $_GET['order'] : 
        		 'asc';


        // Obtenemos los datos paginados en forma de array con el parámetro ARRAY_A
        $this->items = $wpdb->get_results(
        	$wpdb->prepare(
        		"SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, ($paged*$per_page)
        	), 
        	ARRAY_A
        );

        // configuramos la paginación
        $this->set_pagination_args(array(
            'total_items' => $total_items, // total items
            'per_page' => $per_page, // items por página
            'total_pages' => ceil($total_items / $per_page) // páginas en total para los enlaces de la paginación
        ));
	}

	/**
	* columnas por las que ordenar, false descendente, true ascendente
	*/
	function get_sortable_columns() 
	{
	  	$get_sortable_columns = array(
            'id'            => array('id',true),
            'dictamen'      => array('dictamen',true),
            'direccion'     => array('direccion',true),
            'ciudad'        => array('ciudad',true),
            'proyecto'      => array('proyecto',true),
            'propietario'   => array('propietario',true),
            'inspector'     => array('inspector',true),
            'aprobado'      => array('aprobado',true),
            'observaciones' => array('observaciones',true),
            'url_archivo'   => array('url_archivo',true)
        );
	  	return $sortable_columns;
	}

	/**
	* links de edición y delete para el campo id
	*/
	function column_id($item) 
	{
	  	// botones para edición y eliminar items en cada row de la tabla
        $actions = array(
            'edit' => sprintf('<a href="?page=udp_list_custom_form&id=%s">%s</a>', $item['id'],'Editar'),
            'delete' => sprintf('<a href="?page=%s&action=delete&id=%s">%s</a>', $_REQUEST['page'], $item['id'], 'Eliminar'),
        );

        return sprintf('%s %s',
            $item['id'],
            $this->row_actions($actions)
        );
	}

	/**
	* desplegable para acción en masa del encabezado
	*/
	function get_bulk_actions() 
	{
	  	$actions = array(
	    	'delete'    => 'Eliminar'
	  	);
	  	return $actions;
	}

	/**
     * Procesa acciones en masa
     */
    function process_bulk_action()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'certificados'; 

        //si la acción actual es delete significa que estamos eliminando
        if ('delete' === $this->current_action()) 
        {
            $ids = isset($_GET['id']) ? $_GET['id'] : array();
            //si es un array de ids
            if (is_array($ids)) 
            {
            	$ids = implode(',', $ids);
            }

            //si hay ids eliminamos
            if (!empty($ids)) 
            {
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
    }

	/**
	* checkbox, el campo name debe ser por el que vamos a realizar acciones en masa
	*/
	function column_cb($item) 
	{
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />', $item['id']
        );    
    }

    /**
	* función que se ejecutará cuando no existan items
	*/
    function no_items() 
    {
	  	_e( 'No se encontrarón búsquedas.' );
	}

} //class


/**
* acción para añadir la opción de nuestro plugin
*/
add_action( 'admin_menu', 'udp_add_menu_items' );


/**
* añade la opción al menú de administración con sus hijos
*/
function udp_add_menu_items()
{
	//elemento principal
    add_menu_page(
    	__('Búsqueda', 'Certificados Retie SAS'), //singular
    	__('Búsquedas', 'retie_sas'), //plural
    	'activate_plugins', //capability
    	'udp_list', //slug
    	'udp_render_list_page', //handler
    	'dashicons-search' //icon
    );

    // elemento para ver la tabla con las búsquedas
    add_submenu_page(
    	'udp_list', //slug padre
    	__('Búsqueda', 'retie_sas'), //singular
    	__('Búsquedas', 'retie_sas'), //plural
    	'activate_plugins', //capability
    	'udp_list', //slug
    	'udp_render_list_page' //handler
    );

    // elemento para añadir una nueva búsqueda
    add_submenu_page(
    	'udp_list', //slug padre
     	__('Añadir', 'retie_sas'), //singular
     	__('Añadir', 'retie_sas'), //plural
     	'activate_plugins', //capability
     	'udp_list_custom_form', //slug
     	'udp_searchs_form_page' //handler
     );
}

/**
* muestra el formulario para crear y editar nuevos elementos
*/
function udp_searchs_form_page()
{
	echo "Aquí puedes pintar tu form";
}

/**
* pinta la tabla final
*/
function udp_render_list_page()
{
	$retie_sas = new Udp_List_Table();
	$retie_sas->prepare_items();

	//si se ha eliminado algo creamos el mensaje con las clases de wordpress
	$message = '';
    if ('delete' === $retie_sas->current_action()) 
    {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items eliminados: %d', 'retie_sas'), 
        	count($_GET['id'])) . '</p></div>';
    }
	?>
	<div class="wrap">

	    <h2><?php _e('Búsquedas', 'retie_sas')?> 
	    <a class="add-new-h2" href="<?php echo get_admin_url(get_current_blog_id(), 'admin.php?page=udp_list_custom_form');?>">
	    	<?php _e('Añadir búsqueda', 'retie_sas')?>
	    </a>
	    </h2>
	    <?php echo $message; ?>

	    <form id="search-table" method="GET">
	        <input type="hidden" name="page" value="<?php echo $_GET['page'] ?>"/>
	        <?php $retie_sas->display() ?>
	    </form>
	</div>
	<?php
}