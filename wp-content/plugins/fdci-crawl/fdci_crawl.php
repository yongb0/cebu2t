<?php
/**
* Plugin Name: FDCI Web Crawler
* Description: FDCI customed Plugin for crawling webs
* Version: 1.0.0
* Author: John Robert Jerodiaz
* License: AAPPSS
*/

define('FOLDER_DIR', plugin_dir_path(__FILE__)); //set the plugin directory
define('VIEW_DIR', FOLDER_DIR."views/"); //set the view folder
define('VENDOR_DIR', FOLDER_DIR."vendors/"); //set the vendor folder


/**
 * [fdcInit description]
 * @return [type] [description]
 */
function fdci_Init(){
}

/**
 * [fdcPluginMenu description]
 *
 */
function fdci_Plugin_Menu() {
	add_menu_page(
					'FDCI Web Crawler', //title of the plugin
					'FDCI Web Crawler', //title of the plugin in the left sdebar
					'administrator', //access level
					'fdci-web-crawler-settings', //slug of the function
					'fdci_plugin_page', //function that will load the view
					'dashicons-admin-generic' //icon
				);
	add_submenu_page(
		"fdci-web-crawler-settings",  //parent slug
		"FDCI - Add Product", //page title
		"FDCI Add Product", //menu title
		"manage_options", //capability
		"fdci_add_product", //menu slug 
		"fdci_add_product"  //function
		);
    add_submenu_page(
    	"fdci-web-crawler-settings",
    	"FDCI - View Product",
    	"FDCI View Product",
    	"manage_options",
    	"fdci_view_product",
    	"fdci_view_product"
    	);
    add_submenu_page(
    	"fdci-web-crawler-settings",
    	"FDCI - About",
    	"About FDCI web crawler",
    	"manage_options",
    	"about_fdci_plugin",
    	"about_fdci_plugin"
    	);
    add_submenu_page(
    	"",
    	"Edit Field",
    	"Edit Field",
    	"manage_options",
    	"add_product_exec",
    	"add_product_exec");
    add_submenu_page(
    	"",
    	"Edit Field",
    	"Edit Field",
    	"manage_options",
    	"execute_crawl",
    	"execute_crawl");

}


/**
 * [fdcPluginPage description]
 * @return [type] [description]
 */
function fdci_plugin_page() {
	wp_enqueue_style( 'premium.css', plugin_dir_url(__FILE__) . 'webroot/css/bootstrap.min.css');
	wp_enqueue_style( 'premium.css', plugin_dir_url(__FILE__) . 'webroot/css/bootstrap-theme.min.css');
	include VIEW_DIR."fdci_index_page.php"; 
}
function fdci_add_product() {
	wp_enqueue_style( 'premium.css', plugin_dir_url(__FILE__) . 'webroot/css/bootstrap.min.css');
	wp_enqueue_style( 'premium.css', plugin_dir_url(__FILE__) . 'webroot/css/bootstrap-theme.min.css');
	include VIEW_DIR."fdci_add_product.php"; 
}
function fdci_view_product() {
	$results = fdci_select_exec('fdci_web_crawler');
	wp_enqueue_style( 'premium.css', plugin_dir_url(__FILE__) . 'webroot/css/bootstrap.min.css');
	wp_enqueue_style( 'premium.css', plugin_dir_url(__FILE__) . 'webroot/css/bootstrap-theme.min.css');
	include VIEW_DIR."fdci_view_product.php"; 
}
function execute_crawl(){
	$url = site_url().'/wp-admin/admin.php?page=';
	include VIEW_DIR."index.php";
	header("location:".$url.'about_fdci_plugin');
	exit();
}
function about_fdci_plugin(){
	wp_enqueue_style( 'premium.css', plugin_dir_url(__FILE__) . 'webroot/css/bootstrap.min.css');
	wp_enqueue_style( 'premium.css', plugin_dir_url(__FILE__) . 'webroot/css/bootstrap-theme.min.css');
	include VIEW_DIR."about_fdci_plugin.php";
}

function fdci_select_exec($selectTable){
	global $wpdb;
	$sql = "SELECT * FROM $selectTable ";
	$results = $wpdb->get_results($sql) or die(mysql_error());
	return $results;
}
// function to sanitize values received from the form. Prevent SQL injection
function clean($str) {
    $str = @trim($str);
    if(get_magic_quotes_gpc()) {
            $str = stripslashes($str);
    }
     return mysql_real_escape_string($str);
}

// function to generate random string for product reference Id
function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function add_product_exec(){
	global $wpdb;
	global $tableName;
	session_start();
    $url = site_url().'/wp-admin/admin.php?page=';
	$tableName  = "fdci_web_crawler";
	if(isset($_POST['fdci_c_p_s'])){
		if($_POST['fdci_tkf']=='FDC-05-04-2015'){
			$dataFormat	= array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s');
			$productData	=	array(
				'reference_no' => 'FDCI-'.generateRandomString(),
				'original_site'	=>	clean($_POST['product_original_site']),
				'site_link_id'	=>	0,
				'original_post_link'	=>	clean($_POST['product_post_link']),
				'title'	=>	clean($_POST['product_title']),
				'description'	=>	clean($_POST['product_description']),
				'price'	=>	clean($_POST['product_price']),
				'furnishing'	=>	clean($_POST['product_furnishing']),
				'location'	=>	clean($_POST['product_location']),
				'posted_date'	=>	'',
				'square_area'	=>	clean($_POST['product_square_area']),
				'bedrooms'	=>	clean($_POST['product_bedroom']),
				'bathrooms'	=>	clean($_POST['product_bathroom']),
				'floor'	=>	clean($_POST['product_floor']),
				'contact_mobile'	=>	clean($_POST['product_contact_number']),
				'status'	=>	1
				);
			$wpdb->insert($tableName,$productData,$dataFormat);
			$_SESSION['product_save_success']	= 'One Product saved in database.';
			header("location:".$url.'fdci_add_product');
			exit();
		}
	}else{
		
	}
	
}

function fdci_Initialize_Table() {
	global $wpdb;
	global $tableName;

	$tableName  = "fdci_web_crawler";

	// create the ECPT metabox database table
	if($wpdb->get_var("show tables like '{$tableName}'") != $tableName) 
	{

		$sql = "CREATE TABLE " . $tableName . " (
		`id` int(100) NOT NULL AUTO_INCREMENT primary key,
		`reference_no` varchar(100),
		`original_site` text,
		`site_link_id` tinyint, 
		`original_post_link` text,
		`title` tinytext,
		`description` text,
		`price` varchar(100),
		`product_image` text,
		`furnishing` text,
		`location` text,
		`posted_date` datetime default '0000-00-00 00:00:00',
		`square_area` text,
		`bedrooms` text,
		`bathrooms` text,
		`floor` text,
		`name_of_posted_person` varchar(100),
		`contact_mobile` text,
		`contact_email` text,
		`contact_landline` text,
		`created` timestamp default current_timestamp,
		`modified` datetime default '0000-00-00 00:00:00',
		`status` tinyint
		);";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');	
		dbDelta($sql);

	}
}




register_activation_hook(__FILE__,'fdci_Initialize_Table'); //hook for when the plugin was activated

add_action('admin_menu', 'fdci_Plugin_Menu'); //add the plugin to the menu
add_action('admin_init', 'fdci_Init' ); //initialize the plugin