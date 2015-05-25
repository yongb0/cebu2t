<?php 

/**
 * This file contains functions which are not called directly but only through ajax
 * @package Supernova
 * @since Supenova 1.4.0
 * Copyright (C) 2014 Sayed Taqui
 */


/*
 * Calculates total number of posts which have comments
 * @since Supernova 1.4.4
 */

if(!function_exists('supernova_count_posts_with_comments')){
function supernova_count_posts_with_comments(){
        $count = 0; global $post;
        $post_contents = get_posts( array( 'posts_per_page' => -1, 'post_type'=>'post', 'post_status'=>'publish', 'ignore_sticky_posts' => true));
        
    foreach($post_contents as $post) : setup_postdata($post);
        
        if( get_comments_number(get_the_ID()) > 0 )
        $count++;
        
        endforeach;
        
    wp_reset_postdata();
    
    return $count;
}
}

/*
 * @param $meta_key, $meta_value(optional)
 * @returns number of posts $count
 * 
 */

if(!function_exists('supernova_count_posts_by_metakey')){
function supernova_count_posts_by_metakey($meta_key, $meta_value=NULL){
        $count = 0;
        $arg = array( 'posts_per_page' => -1, 'post_type'=>'post', 'post_status'=>'publish', 'ignore_sticky_posts' => true, 'meta_key' => $meta_key, 'meta_value'=>$meta_value);
	$the_query = new WP_Query( $arg);
        
    if ( $the_query->have_posts() ){
            while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $count++;
    }}
    wp_reset_postdata();
    
    return $count;
}
}


/**
 * Gets post content by post ids. If you want to change the the html of the post, you should change it here
 * @param $post_ids, $class
 * @returns html content
 * @since Supernova 1.4.0
 */

if(!function_exists('supernova_ajax_posts_content')){
function supernova_ajax_posts_content($post_ids, $outer_class, $inner_class){           
    global $post;
    echo '<div class="'.$outer_class.'">';
    
	$post_content = get_posts( array( 'posts_per_page' => count($post_ids), 'post__in'=>$post_ids, 'post_status'=>'publish', 'ignore_sticky_posts' => true, 'orderby'=>'post__in'));
        
            foreach($post_content as $post) : setup_postdata($post);
            
                echo '<article class="post '.$inner_class.'">';
                echo    '<h2 class="post_title"><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
                echo    '<div class="entry">';
                echo        '<a href="'.get_permalink().'">'.supernova_thumbnail(get_the_ID()).'</a>';            
                echo        '<p>'.the_excerpt().'</p>';
                echo    '</div>';
                        get_template_part('includes/meta');
                echo'</article>';                
            
            endforeach;
            
            echo '</div>'; 
            
	wp_reset_postdata();
            
        }    
}        

/*
 * Gets post ids by given variables
 * @param $posts_per_page, $offset, $orderby, $meta_key, $meta_value
 * @returns $post_ids
 */

if(!function_exists('supernova_get_specific_post_ids')){
function supernova_get_specific_post_ids($posts_per_page, $offset, $orderby, $meta_key, $meta_value){
       $post_ids = array();
       $arg = array( 'posts_per_page' => $posts_per_page, 'post_type'=>'post', 'post_status'=>'publish', 'ignore_sticky_posts' => true, 'meta_key' => $meta_key, 'meta_value'=>$meta_value,  'orderby'=>$orderby,  'offset'=>$offset);
	$the_query = new WP_Query( $arg);
        
if ( $the_query->have_posts() ){
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
                $post_ids[] = get_the_ID();
}
                }
	wp_reset_postdata();
                
        return $post_ids;         
}
}

/*
 * RECENT POSTS
 * Does query for more RECENT POSTS on index page
 * @returns post content
 * @since Supernova 1.4.0
 */
        
add_action('wp_ajax_supernova_load_main_posts', 'supernova_load_main_posts');       
add_action('wp_ajax_nopriv_supernova_load_main_posts', 'supernova_load_main_posts');   

if(!function_exists('supernova_load_main_posts')){
function supernova_load_main_posts(){
    $paged           = intval($_POST['paged']);
    $posts_per_page  = get_option('posts_per_page');
    $offset = ($posts_per_page)* $paged;
    $post_ids = supernova_get_specific_post_ids($posts_per_page, $offset, 'date', NULL, NULL);
     supernova_ajax_posts_content($post_ids, 'ajax_recent_posts_wrapper', 'ajax_recent_posts');
     
    die();
}
}


/*
 * POPULAR POSTS
* Does query for the POPULAR POSTS based on key
* @param NULL
* @returns post final content
* @since Supernova 1.4.0
*/

add_action('wp_ajax_supernova_get_popular_posts', 'supernova_get_popular_posts');
add_action('wp_ajax_nopriv_supernova_get_popular_posts', 'supernova_get_popular_posts');

if(!function_exists('supernova_get_popular_posts')){
function supernova_get_popular_posts(){
        global $supernova_options;
        $posts_per_page = get_option('posts_per_page');
        $offset         = (isset($_POST['offset'])) ?  intval($_POST['offset']): 0; 
        $offset         = ($offset == 0) ? 0 : ($offset*$posts_per_page)+1;
        
        //If Actual Count selected
        $post_ids       = supernova_get_specific_post_ids($posts_per_page, $offset, 'meta_value_num', 'supernova_post_views_count', NULL);               
        $total_posts    = supernova_count_posts_by_metakey('supernova_post_views_count');        
        
        //Count on Comment
        if(empty($post_ids) || $supernova_options['poplular-pos-dep'] == '2'){
        $total_posts    = supernova_count_posts_with_comments();
        $post_ids       = supernova_get_specific_post_ids($posts_per_page, $offset, 'comment_count' , NULL, NULL );        
        }
                                
        //If user selected to choose himself
        if($supernova_options['poplular-pos-dep'] == '3'){ 
        $total_posts    = supernova_count_posts_by_metakey('supernova-popular-post', 1);
        $post_ids       = supernova_get_specific_post_ids($posts_per_page, $offset, NULL , 'supernova-popular-post', 1 );        
        }
       
        //if nothing found
        if(empty($post_ids)){
        $post_ids       = supernova_get_specific_post_ids($posts_per_page, $offset, 'date', NULL, NULL);        
            }   
        
        if($offset != 0){
        $left_posts     = (intval($total_posts) - intval($offset)) - intval($posts_per_page);        
        }else{            
        $left_posts     = $total_posts - $posts_per_page;                     
        }        
                
        $left_posts     = ($left_posts > 0) ? $left_posts.__(' more', 'Supernova') : __('Sorry no more posts available, please check back later', 'Supernova');
        
        supernova_ajax_posts_content($post_ids, 'ajax_popular_posts_wrapper', 'ajax_popular_posts');
                
        supernova_ajax_button('popular_load_more', $total_posts, $posts_per_page, $left_posts);
        die();
    }
}    

/*
 * RECOMMENDED POSTS
* Does query for the RECOMMENDED POSTS
* @param NULL
* @returns post final content
* @since Supernova 1.4.0
*/

add_action('wp_ajax_supernova_get_recommended_posts', 'supernova_get_recommended_posts');
add_action('wp_ajax_nopriv_supernova_get_recommended_posts', 'supernova_get_recommended_posts');

if(!function_exists('supernova_get_recommended_posts')):
function supernova_get_recommended_posts(){
        $posts_per_page = get_option('posts_per_page');
        $offset         = (isset($_POST['offset'])) ?  intval($_POST['offset']): 0;        
        $offset         = ($offset == 0) ? 0 : ($offset*$posts_per_page);
        
        $total_posts    = supernova_count_posts_by_metakey('supernova-recommended-post', 1 );
        
        //If nothing Found
        if(empty($post_ids)) 
        $post_ids       = supernova_get_specific_post_ids($posts_per_page, $offset, 'date', NULL, NULL);
                        
        if($offset != 0){
        $left_posts     = (intval($total_posts) - intval($offset)) - intval($posts_per_page);
        }else{            
        $left_posts     = $total_posts - $posts_per_page;
        }                        
                
        $post_ids       = supernova_get_specific_post_ids( $posts_per_page, $offset, NULL , 'supernova-recommended-post', 1 );

        $left_posts     = ($left_posts > 0) ? $left_posts.__(' more', 'Supernova') : __('Sorry no more posts available, please check back later', 'Supernova');
        
        supernova_ajax_posts_content($post_ids, 'ajax_rec_posts_wrapper', 'ajax_rec_posts');

        supernova_ajax_button('rec_load_more', $total_posts, $posts_per_page, $left_posts);
        
        die();
    }
    
endif;    
    
    
/*************************/
    /* Slider POSTS*/
/*************************/
    
/*Has been defined here because the above functions are not available in custom-functions.php , will move it later.
 */    
    
/*
 * Gets sticky post ids
 * @since Supernova 1.5.1
 * 
 */
    
    
if(!function_exists('supernova_get_sticky_postsids')):
    
function supernova_get_sticky_postsids($posts_per_page, $offset, $orderby){
    $post_ids = array();
    $arg = array( 'posts_per_page' => $posts_per_page, 'post__in'  => get_option( 'sticky_posts' ), 'post_status'=>'publish', 'ignore_sticky_posts' => 1, 'orderby'=> $orderby,  'offset'=>$offset);
	$the_query = new WP_Query( $arg);
        
    if ( $the_query->have_posts() ){
            while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $post_ids[] = get_the_ID();
    }
                }
                
	wp_reset_postdata();
                
        return $post_ids;      
    
}
endif;


/*
 * Handles post ids for slider
 * @since Supernova 1.5.1
 * 
 */

if(!function_exists('supernova_slider_postids')):
    
function supernova_slider_postids(){
    global $supernova_options;
    $automate_slide = $supernova_options['automate-slides'];
    $post_ids = $automate_slide;
    $posts_per_page = 8;
    $offset = 0;
    
    /**STICKY POSTS**/
    if($automate_slide == 1)
        $post_ids = supernova_get_sticky_postsids($posts_per_page, $offset, 'date');
            
    /**RECENT POSTS**/
    if($automate_slide == 2)
    $post_ids = supernova_get_specific_post_ids($posts_per_page, $offset, 'date', NULL, NULL);
    
    /**POPULAR POSTS**/
    if($automate_slide == 3){
        
        //If Actual Count selected
        $post_ids       = supernova_get_specific_post_ids($posts_per_page, $offset, 'meta_value_num', 'supernova_post_views_count', NULL);               
        $total_posts    = supernova_count_posts_by_metakey('supernova_post_views_count');        
        
        //Count on Comment
        if(empty($post_ids) || $supernova_options['poplular-pos-dep'] == '2'){
        $total_posts    = supernova_count_posts_with_comments();
        $post_ids       = supernova_get_specific_post_ids($posts_per_page, $offset, 'comment_count' , NULL, NULL );        
        }
                                
        //If user selected to choose himself
        if($supernova_options['poplular-pos-dep'] == '3'){ 
        $total_posts    = supernova_count_posts_by_metakey('supernova-popular-post', 1);
        $post_ids       = supernova_get_specific_post_ids($posts_per_page, $offset, NULL , 'supernova-popular-post', 1 );        
        }
       
        //if nothing found
        if(empty($post_ids))
        $post_ids       = supernova_get_specific_post_ids($posts_per_page, $offset, 'date', NULL, NULL);                    
            
         }
    
    /*RECOMMENDED POSTS*/
         if($automate_slide == 4)
             $post_ids  = supernova_get_specific_post_ids( $posts_per_page, $offset, NULL , 'supernova-recommended-post', 1 );         
    
    
    return $post_ids;    
    
}

endif;