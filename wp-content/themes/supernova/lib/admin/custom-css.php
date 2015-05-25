<?php

/* 
* @pakage Supernova
* Copyright (C) 2013 Sayed Taqui 
*/


function supernova_header_logopos(){
   $value = (get_theme_mod( 'supernova_header_logopos', 'Default Value' )) ? esc_attr( get_theme_mod( 'supernova_header_logopos', 'Default Value' )) : '';   
   $css = '';

   global $wp_version;

   if( $wp_version > 4.0 ){
        $value = supernova_options('logo-position');
   }

   if( $value || $value != 1)
   {
        if($value == '3')
        {
            $css .= '.header-ad, #header_widgets {float:left}';
            $css .= '#header_title {float:right; padding: 15px 0px 15px 15px;}';
        }
        elseif($value == '2' )
        {
            $css .= '.header-ad, #header_widgets {float:none; clear:both; text-align:center;margin-bottom: 10px;}';
            $css .= '#header_title {float:none;text-align:center}';
            $css .= '#title_wrapper{text-align:center;}';
            $css .= '#title_wrapper{text-align:center;}';
        }    
   }
   return $css;
}

/*
 * Handles css when background image is set from background options page
 * @since Supernova 1.4.2
 */    
add_action('load-appearance_page_custom-background','supernova_handle_background_save');    
function supernova_handle_background_save(){
    if (isset($_GET['page']) && $_GET['page'] == 'custom-background'){
        if(isset($_POST['save-background-options'])){
         //supernova_writer();
        }
    }
}

/*
 * To hook in the header only if we are not able to write file for any reason or its an old user who didn't save settings yet.
 * @since Supernova 1.4.2
 */

//add_action('init', 'supernova_file_status_check');
function supernova_file_status_check(){
    
    $file_stauts = get_option('supernova_file_write_status');    
    $old_user = get_option('supernova_old_user_check');
    
    if($file_stauts == 'failed' || $old_user != 'no' ){
        add_action('wp_head', 'supernova_temp_user_css');
    }    
}


/*
 * Handles css when header is set from background options page
 * @since Supernova 1.4.2
 */    
add_action('load-appearance_page_custom-header','supernova_handle_header_save');    
function supernova_handle_header_save(){
    
    if (isset($_GET['page']) && $_GET['page'] == 'custom-header'){
        if(isset($_POST['save-header-options'])){
         //supernova_writer();         
        }            
    }
}

/*
 * Will hook in the header
 * @param NULL
 * @returns styles
 * 
 */
add_action('wp_head', 'supernova_temp_user_css');
function supernova_temp_user_css(){
    
    echo "<style>";
    echo supernova_user_css();
    echo "</style>";
    
}


function supernova_user_css(){
    
global $supernova_options;
$background_color = get_background_color(); 
$background_image = get_background_image();
$styles = '';

/******************************/
        /*GENERAL*/
/******************************/

if(supernova_options('no-responsive') || supernova_options('no-responsive-tablet'))
$styles .=  "body{min-width:".$supernova_options['layout-width']."px;}";

/******************************/
        /*BACKGROUND*/
/******************************/
if($background_color=='ffffff' || !$background_color  && !$background_image)
$styles .=  ".main_content{border:none;}"; //box shadow fix for main content

if(isset($supernova_options['sup_css']))
$styles .= $supernova_options['sup_css'];

/******************************/
        /*MEDIA QUERY*/
/******************************/

$styles .= '@media only screen and (min-width: 920px) {body{min-width:'.$supernova_options['layout-width'].'px;} }';

/******************************/
        /*LAYOUT*/
/******************************/

if($supernova_options['layout-width'])
$styles .=  "#wrapper, #footer, #top_most, .wrapper{width:". esc_html(intval($supernova_options['layout-width'])) ."px;}";

if($supernova_options['sidebar-width'])
$styles .= "#sidebar{width:". intval($supernova_options['sidebar-width']-2) ."%!Important;}";

if($supernova_options['content-width'])
$styles .= "#content{width:".intval($supernova_options['content-width']-3)."%;}";

//Sidebar
if($supernova_options['sidebar-pos'] == 1){
    
    $styles .= "#sidebar{float:right !important; margin-right:5% !important;}";
    $styles .= "#content{float:right !important; margin-right:0% !important;}";

}elseif($supernova_options['sidebar-pos'] == 3){
    
    $styles .= "#content{float:none; width:100%; margin-right:0%;}";
    
}


/******************************/
    /*LOGO POSITION*/
/******************************/

$styles .= supernova_header_logopos();


/******************************/
        /*NAVIGATION*/
/******************************/

if(supernova_options('disable-search')==1)
$styles .=  "#nav {max-width:100% !important;}";

if(supernova_options('disable-categories')==1)
$styles .= ".header_nav{max-width:90%;padding-bottom: 5px;} 
            .top_search_box {left: -187px;}";


/******************************/
        /*FONT FAMILY*/
/******************************/

if($supernova_options['font-style'] != '' && $supernova_options['font-style'] != 'Georgia, serif'){
$styles .= "#content .entry p, #sidebar a, #sidebar p, #sidebar, #sidebar lable,#sidebar .supernova_tabber_contents h4, #footer .supernova_tabber_contents h4, body{font-family:".$supernova_options['font-style']."!Important;}";
}


/******************************/
        /*FONT SIZES*/
/******************************/

if($supernova_options['post-para-size']!=='14')
$styles .= "#content .entry p{font-size:". intval($supernova_options['post-para-size'])/10 ."em !important ;}";

if($supernova_options['post-heading-size']!=='25')
$styles .= ".post_title{font-size:".intval($supernova_options['post-heading-size'])/10 ."em !important ;}";

if($supernova_options['site-heading-size']!=='30')
$styles .= "#header_title h1{font-size:". intval($supernova_options['site-heading-size'])/10 ."em !important ;}";

if($supernova_options['site-desc-size'] !=='14')
$styles .= "#header_title p{font-size:". intval($supernova_options['site-desc-size'])/10 ."em !important ;}";

if($supernova_options['sidebar-heading-size']!=='23')
$styles .= "#sidebar .widget h3{font-size:". intval($supernova_options['sidebar-heading-size'])/10 ."em;}";


/******************************/
        /*FONT COLORS*/
/******************************/

if($supernova_options['post-para-color'] != '000000')
$styles .= "#content .entry p{color: #".esc_html($supernova_options['post-para-color']) ."!Important;}";

if($supernova_options['post-heading-color'] != '525252')
$styles .= ".post_title a, .single_heading{color: #".esc_html($supernova_options['post-heading-color']) ."!Important;}";


/******************************/
        /*FOOTER*/
/******************************/

$styles .= "#footer_wrapper{background:#".esc_html(supernova_options('footer-color')).";}";

if(trim(supernova_options('footer-bg'))!=='')
$styles .= "#footer_wrapper{background:url('".esc_url(supernova_options('footer-bg'))."');}";

$styles .= "#footer #footer_left_part span, #footer #footer_left_part a, #footer .widget, #footer a, #footer p, #footer pre, #footer span, #footer i, #footer a.rsswidget{color:#".esc_html(supernova_options('footertext-color')) ." !important;}";

$styles .= "#footer .widget h3{color:#".esc_html(supernova_options('footerheading-color')).";}";

$styles .= "#sidebar .widget h3{color:#".esc_html(supernova_options('sidebar-heading-color')).";}";

if(supernova_options('nosidebar-home')){
$styles .= ".home #wrapper #content{width:100%!important; margin-right:0;}
            .home #supernova_slider img {height: 350px;}
            .home #supernova_slider_wrapper {margin-bottom:50px;}";
}

if(supernova_options('icon-color')=='2'){
$styles .= "#footer .facebook_b{background-position:0 0}#footer .twitter_b{background-position:-32px 0}#footer .google_b{background-position:-64px 0} #footer .stumble_b{background-position:-96px 0}#footer .rss_b{background-position:-128px 0}#footer .youtube_b{background-position:-160px 0}#footer .linkedin_b{background-position:-192px -96px}";
} 


/******************************/
        /*COLORS*/
/******************************/

/*NOTE : ~ NOT IN USE*/
$color = false;

if($color){
$styles .= '#header_navigation .category ul li a, 
            .header_catnav .catnav ul a,
            #top_nav li a:hover, 
            #nav li a:hover, 
            #nav li.current_page_item a, 
            #top_nav li.current_page_item a, 
            .page_links a, 
            .next_prev_post a, 
            .entry a, 
            .main_content .meta_author a, 
            #footer .current_page_item a, 
            #footer a:hover, 
            .leave_comment a:hover, 
            .single_content .meta_author, 
            .pagination a:hover, 
            .pagination .current, 
            .replyback a, 
            .supernova_related_posts a, 
            #supernova_breadcrumbs a{color:'.$color.'}';

$styles .= '.post_title a:hover, .entry .moretag:hover, .footer_nav li a:hover,#footer .footer_nav li a:hover, .rsswidget:hover {color:'.$color.'!Important;}';

$styles .= '#content .tags a, .widget_pages a:hover, .widget_meta a:hover, .widget_archive a:hover, .widget_recent_comments a:hover, .widget_nav_menu a:hover, .widget_recent_entries a:hover, .widget_tag_cloud a:hover, #wp-calendar tbody td:hover, #wp-calendar #today, .supernova a:hover, .widget_categories li a:hover, .supernova_related_posts a:hover, .flex-control-paging li a.flex-active {background: '.$color.'}';

$styles .= '.article_wrapper{border-left:1px solid '.$color.'}';
$styles .= '#nav .current_page_item .hasChildren, #top_nav .current_page_item .hasChildren{border-top:8px solid '.$color.';}';

//SELECTION
$styles .= '::selection,::-moz-selection, p.red::selection, p.red::-moz-selection {background: '.$color.';}';
$styles .= '::selection{background: '.$color.'; /* Safari */}';
$styles .= '::-moz-selection{background: '.$color.'; /* Firefox */}';
$styles .= 'p.red::selection{background: '.$color.';}';
$styles .= 'p.red::-moz-selection{background: '.$color.';}';

    }
    
/******************************/
        /*Extras*/
/******************************/    

if(supernova_options('nav-capt')  ==  1 ){
$styles .= "#nav li a {text-transform: none;font-size: 2em;}";
$styles .= "#top_nav li a  {text-transform: none; font-size: 1.2em;}";
$styles .= ".header_catnav .catnav ul a{text-transform: none; font-size: 1.7em;}";
}

if(supernova_options('sidebar-capt')  == 1 ){
$styles .= ".widget h3 {text-transform: none;}";
$styles .= ".sidebar-posts h4 {text-transform: none;}";
$styles .= ".widget .supernova_tabber .supernova_tabber_top li span {text-transform: none; font-size: 1.1em;}";
}

if(supernova_options('heading-capt')  ==  1 )
$styles .= ".post_title a, .single_heading, .featured_content h3 {text-transform: none;}";


if(supernova_options('vborder-nav')  ==  1 )
$styles .= "#nav_wrapper {background:none; padding-bottom: 0;}";

if(supernova_options('vborder-sidebar')  ==  1 )
$styles .= ".widget h3 {background:none;padding-bottom:0.5em ; line-height: inherit; margin-bottom:0}";

if(supernova_options('list-thumbnail-width') && supernova_options('list-thumbnail-width') != 20 )
$styles .= ".post img.attachment-thumbnail, .type-post img.attachment-thumbnail{width:". esc_html(intval($supernova_options['list-thumbnail-width'] - 1.43)) ."%;}";

if(supernova_options('list-thumbnail-height') && supernova_options('list-thumbnail-height') != 120 )
$styles .= ".post img.attachment-thumbnail, .type-post img.attachment-thumbnail{height:". esc_html(intval($supernova_options['list-thumbnail-height'])) ."px;}";

return $styles;

}//function Ends