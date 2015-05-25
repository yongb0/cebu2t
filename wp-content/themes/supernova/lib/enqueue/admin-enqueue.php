<?php
/*
* All the admin CSS and Scripts are loaded only from this file and most of the files are loaded 
* only of the theme's  options page
*/

class supernova_admin_enqueue {
    	public function __construct(){
		add_action( 'admin_enqueue_scripts', array($this, 'supernova_admin_styles') );
		add_action('admin_enqueue_scripts', array($this, 'supernova_admin_scripts'));
		}
    		
public function supernova_admin_styles() {
        global $wp_version, $supernova_version;
                    wp_register_style( 'custom_wp_admin_css', SUPERNOVA_ROOT_ADMIN.'css/admin-css.css', array(), $supernova_version, 'all' );
                    wp_register_style( 'supernova_all_css', SUPERNOVA_ROOT_ADMIN.'css/all.css', array(), $supernova_version, 'all' );
                    wp_register_style( 'supernova_older_css', SUPERNOVA_ROOT_ADMIN.'css/old/older.css', array(), $supernova_version, 'all' );
                    wp_register_style( 'supernova_select2', SUPERNOVA_ROOT_ADMIN.'css/select2.css', array(), $supernova_version, 'all' );
        if (isset($_GET['page']) && $_GET['page'] == 'theme-options'){
                    wp_enqueue_style( 'custom_wp_admin_css' );                    
                    wp_enqueue_style('thickbox');
                    wp_enqueue_style('supernova_select2');
                    if ( $wp_version < 3.5 )
                    wp_enqueue_style( 'supernova_older_css' ); //For Older Versions  
                }
            wp_enqueue_style( 'supernova_all_css' );  //Just a bit of css which loads eveywhere on dashboard                    
            }

public function supernova_admin_scripts() {
        global $supernova_version;
         if (isset($_GET['page']) && $_GET['page'] == 'theme-options'){
            wp_enqueue_script('jQuery');            
            wp_register_script( 'my_jscolor_script', SUPERNOVA_ROOT_ADMIN.'assets/jscolor/jscolor.js' );
            wp_register_script( 'select2_script', SUPERNOVA_ROOT_ADMIN.'js/select2.js', array('jquery'),$supernova_version, false );
            wp_register_script( 'my_custom_script', SUPERNOVA_ROOT_ADMIN.'js/adminjs.js', array('jquery'),$supernova_version, false );
            wp_register_script( 'jquery_ui_plugin', SUPERNOVA_ROOT_ADMIN.'js/jquery-ui-slider.js', array('jquery'),$supernova_version, false );
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');            
            wp_enqueue_script( 'my_jscolor_script');
            wp_enqueue_script( 'jquery_ui_plugin');
            wp_enqueue_script( 'select2_script');  
            wp_enqueue_script( 'my_custom_script');
            }
    }
}

new supernova_admin_enqueue();