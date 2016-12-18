<?php 

	global $_REQUEST;
	global $wpdb;

	$search     = $_REQUEST['page'];
	echo $search;

	$table_name = $wpdb->prefix."certificados";

	$query = $wpdb->get_results("SELECT * FROM $table_name WHERE dictamen LIKE '%'");

