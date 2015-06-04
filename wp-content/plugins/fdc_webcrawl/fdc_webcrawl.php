<?php
/**
* Plugin Name: FDC Webcrawler
* Description: Plugin for crawling webs
* Version: 1.0.0
* Author:Lester Padul
* License: GPL2
*/

define('FOLDER_DIR', plugin_dir_path(__FILE__)); //set the plugin directory
define('VIEW_DIR', FOLDER_DIR."views/"); //set the view folder
define('VENDOR_DIR', FOLDER_DIR."vendors/"); //set the vendor folder


/**
 * [fdcInit description]
 * @return [type] [description]
 */
function fdcInit(){
}

/**
 * [fdcPluginMenu description]
 *
 */
function fdcPluginMenu() {
	add_menu_page(
					'FDC Plugin', //title of the plugin
					'FDC Plugin', //title of the plugin in the left sdebar
					'administrator', //access level
					'fdc-plugin-settings', //slug of the function
					'fdcPluginPage', //function that will load the view
					'dashicons-admin-generic' //icon
				);
}

/**
 * [fdcPluginPage description]
 * @return [type] [description]
 */
function fdcPluginPage() {
	include VIEW_DIR."index.php"; //load the index page
}

function fdcInitializeTable() {
	global $wpdb;
	global $tableName;

	$tableName  = "fdc_properties";

	// create the ECPT metabox database table
	if($wpdb->get_var("show tables like '{$tableName}'") != $tableName) 
	{

		$sql = "CREATE TABLE " . $tableName . " (
		`id` int(100) NOT NULL AUTO_INCREMENT primary key,
		`original_site` text,
		`original_post_link` text,
		`title` tinytext,
		`description` text,
		`price` float(9,2),
		`furnishing` text,
		`location` text,
		`posted_date` datetime default '0000-00-00 00:00:00',
		`square_area` text,
		`bedrooms` int(100),
		`bathrooms` int(100),
		`floor` int(100),
		`name_of_posted_person` varchar(100),
		`contact_number` text,
		`created` timestamp default current_timestamp,
		`modified` datetime default '0000-00-00 00:00:00',
		`status` varchar(20)
		);";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');	
		dbDelta($sql);

	}
}

register_activation_hook(__FILE__,'fdcInitializeTable'); //hook for when the plugin was activated

add_action('admin_menu', 'fdcPluginMenu'); //add the plugin to the menu
add_action('admin_init', 'fdcInit' ); //initialize the plugin