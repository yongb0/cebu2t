<?php
/**
* Plugin Name: FDCI Web Crawler
* Description: FDCI customed Plugin for crawling webs
* Version: 1.0.0
* Author: ROY - John Robert Jerodiaz 
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
    add_submenu_page(
    	"",
    	"Edit Field",
    	"Edit Field",
    	"manage_options",
    	"delete_product",
    	"delete_product");
    add_submenu_page(
    	"",
    	"Edit Field",
    	"Edit Field",
    	"manage_options",
    	"update_product",
    	"update_product");
    
    add_submenu_page(
    	"",
    	"Edit Field",
    	"Edit Field",
    	"manage_options",
    	"dis_in_product",
    	"dis_in_product");

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
function delete_product(){
	global $wpdb;
	$url = site_url().'/wp-admin/admin.php?page=';
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$wpdb->query($wpdb->prepare("DELETE FROM fdci_web_crawler WHERE id='%d'",$id));
		session_start();
		$_SESSION['product_delete_success']	= 'One Product successfuly deleted.';
		header("location:".$url.'fdci_view_product');
		exit();
	}else{
		header("location:".$url.'fdci_view_product');
		exit();
	}
	
}

function dis_in_product(){
	global $wpdb;
	$url = site_url().'/wp-admin/admin.php?page=';
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$status = $_POST['status'];
		session_start();
		if($status==1){ 
			$wpdb->query($wpdb->prepare("UPDATE fdci_web_crawler SET status=0 WHERE id=$id"));
			$_SESSION['product_delete_success']	= 'One Product successfuly disable.';
		}else{
			$wpdb->query($wpdb->prepare("UPDATE fdci_web_crawler SET status=1 WHERE id=$id"));
			$_SESSION['product_delete_success']	= 'One Product successfuly inable.';
		}
		header("location:".$url.'fdci_view_product');
		exit();
	}else{
		header("location:".$url.'fdci_view_product');
		exit();
	}
	
}

function update_product(){
	global $wpdb;
	$url = site_url().'/wp-admin/admin.php?page=';
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$des = $_POST['description'];
		$price = $_POST['price'];
		$title = $_POST['title'];

		$wpdb->query($wpdb->prepare("UPDATE fdci_web_crawler SET description='$des', price='$price', title='$title'  WHERE id=$id"));

		session_start();
		$_SESSION['product_delete_success']	= 'One Product successfuly updated.';
		header("location:".$url.'fdci_view_product');
		exit();
	}else{
		header("location:".$url.'fdci_view_product');
		exit();
	}
	
}

function about_fdci_plugin(){
	wp_enqueue_style( 'premium.css', plugin_dir_url(__FILE__) . 'webroot/css/bootstrap.min.css');
	wp_enqueue_style( 'premium.css', plugin_dir_url(__FILE__) . 'webroot/css/bootstrap-theme.min.css');
	include VIEW_DIR."about_fdci_plugin.php";
}

function fdci_select_exec($selectTable){
	global $wpdb;
	$sql = "SELECT * FROM $selectTable";
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
function generateRandomString($length = 10) {
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
			date_default_timezone_set("Asia/Manila");
			$date = date('d.m.Y');
			$mydate = strtoTime($date);

			$getImage = preg_split("/[\s,]+/",$_POST['product_image_link']);
			$jsonImage	=	json_encode($getImage);

			$productData	=	array(
				'reference_no' => 'FDCI-'.generateRandomString(),
				'original_site'	=>	clean($_POST['product_original_site']),
				'site_link_id'	=>	0,
				'original_post_link'	=>	clean($_POST['product_post_link']),
				'title'	=>	clean($_POST['product_title']),
				'description'	=>	clean($_POST['product_description']),
				'price'	=>	clean($_POST['product_price']),
				'product_image' => $jsonImage,
				'furnishing'	=>	clean($_POST['product_furnishing']),
				'location'	=>	clean($_POST['product_location']),
				'posted_date'	=>	date('F d, Y', $mydate),
				'name_of_posted_person'	=>	clean($_POST['product_contact_person']),
				'square_area'	=>	clean($_POST['product_square_area']),
				'bedrooms'	=>	clean($_POST['product_bedroom']),
				'bathrooms'	=>	clean($_POST['product_bathroom']),
				'floor'	=>	clean($_POST['product_floor']),
				'contact_mobile'	=>	clean($_POST['product_contact_number']),
				'contact_email'		=>	clean($_POST['product_person_email']),
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
	global $tableName1;
	global $tableName2;

	$tableName1  = "fdci_web_crawler";
	$tableName2  = "fdci_site_crawl";

	// create the ECPT metabox database table
	if($wpdb->get_var("show tables like '{$tableName1}'") != $tableName1) 
	{

		$table1 = "CREATE TABLE " . $tableName1 . " (
		  `id` int(100) NOT NULL AUTO_INCREMENT primary key,
		  `reference_no` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
		  `original_site` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
		  `site_link_id` tinyint(4) DEFAULT NULL,
		  `original_post_link` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
		  `title` tinytext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
		  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
		  `price` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
		  `product_image` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
		  `furnishing` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
		  `location` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
		  `posted_date` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
		  `square_area` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
		  `bedrooms` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
		  `bathrooms` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
		  `floor` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
		  `name_of_posted_person` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
		  `contact_mobile` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
		  `contact_email` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
		  `contact_landline` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
		  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  `modified` datetime DEFAULT '0000-00-00 00:00:00',
		  `status` tinyint(4) DEFAULT NULL
		) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');	
		dbDelta($table1);
	}

    //create table for site_crawler
	if($wpdb->get_var("show tables like '{$tableName2}'") != $tableName2) 
	{
	    $table2 = "CREATE TABLE " . $tableName2 . " (
		  `id` int(4) NOT NULL AUTO_INCREMENT primary key,
		  `url` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
		  `flag` int(4) NOT NULL,
		  `class` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
		) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1; ";	

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($table2);
	}
	
}




register_activation_hook(__FILE__,'fdci_Initialize_Table'); //hook for when the plugin was activated

add_action('admin_menu', 'fdci_Plugin_Menu'); //add the plugin to the menu
add_action('admin_init', 'fdci_Init' ); //initialize the plugin