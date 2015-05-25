<?php 
/* 
 * Gets the list of pages in select
 * @param $supernova_page_type
 * @param $supernova_pagelist_settings
 * @param $selected_option
 * Example: supernova_page_list('page', 'supernova_settings[featured_item_page_id'.$i.']', $supernova_options['featured_item_page_id'.$i]);
*/

if(!function_exists('supernova_page_list')){
function supernova_page_list($supernova_page_type, $supernova_pagelist_settings, $selected_option){
    global $wpdb;
    $page_results= $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type='$supernova_page_type' AND post_status='publish'  ORDER BY menu_order", 'OBJECT');
    $html = '';
        
$html .= '<select name="'.$supernova_pagelist_settings.'" class="supernova_admin_select" data-placeholder="------select '.$supernova_page_type.'------">';
$html .= '<option value=""></option>';
        if ( $page_results ) : foreach ( $page_results as $pages ) :
                $selected = ($pages->ID == $selected_option) ? 'selected' : '';
                $html .= '<option '.$selected.' value="'.$pages->ID.'">';
                $html .= supernova_chopper($pages->post_title, 40);
                $html .= '</option>';
endforeach; endif;
        $html .= '</select>';
        
        return $html;
        
}
}        

/*
 *Cuts off any string 
 *@param $string
 *@return $string
*/
if(!function_exists('supernova_chopper')){
function supernova_chopper($string, $limit){
    if($limit > 0){
	$string = (strlen($string) > $limit) ? substr($string,0,$limit).'...' : $string;
    }
	return $string;
}
}        

/* 
 * Returns script for the slider bar in admin
 * @param $slider_class
 * @param $result_class
 * @param $hidden_id
 * @param $slider_bar_value
 * @param $slider_default
 * @param $min_value 
 * @param $max_value
*/

if(!function_exists('supernova_range_slider_settings')){
function supernova_range_slider_settings($slider_class, $result_class, $hidden_id, $slider_bar_value, $slider_default, $min_value, $max_value){
	?>
	<script>
        jQuery( ".<?php echo $slider_class; ?>" ).slider({
                animate: true,
                range: "min",
                value: <?php if($slider_bar_value){ echo $slider_bar_value;}else{echo $slider_default;} ?>,
                min: <?php echo $min_value; ?>,
                max: <?php echo $max_value; ?>,
                step: 1,				
                slide: function( event, ui ) {
                            jQuery( ".<?php echo $result_class; ?>" ).html( ui.value );
                        },
                change: function(event, ui) { 
                            jQuery('#<?php echo $hidden_id; ?>').attr('value', ui.value);
                        }
                });
                
	</script>
	<?php }
}        
	
//Reminds user to update their version
if(!function_exists('supernova_version_notice')){        
function supernova_version_notice(){
    global $wp_version;
    if ( $wp_version < 3.7) {
            echo '<p id="message" class="supernova_version_notice">'.__('This theme works best on the latest version of WordPress, some features might not work properly on this version', 'Supernova').'</p>';
            }
}
}        
        
/*
 * Gets thumbnail for posts and listings
 * @param $post_id 
 * @since Supernova 1.4.2
 */

if(!function_exists('supernova_thumbnail')){        
function supernova_thumbnail($post_id = false){
    global $supernova_options;
    
    $full_content = (isset($supernova_options['full-content']) && $supernova_options['full-content']) ? $supernova_options['full-content'] : '';
    
    if(is_single() && supernova_options('no-single-featured')) //No featured image on single pages
        return false;
    
    if(is_page() && supernova_options('no-page-featured')) //No featured image on pages
        return false;
    
    if( !is_single() && supernova_options('thumbin-listing') ){ //No featured image on post listing
        if(!is_page())
        return false;
    }
    
    if (has_post_thumbnail($post_id)){

            if(is_single() || is_page()){
                the_post_thumbnail();
            }else if($full_content != 2){  // **only for post listing*** // // If admin selected to show full content we wont show featured iamge                
                the_post_thumbnail('thumbnail');
            }

    }else if(!is_single() && !is_page() && !supernova_options('auto-featured') && $full_content != 2){

           echo supernova_get_attachment_image($post_id);
    }

}
}
        
/*
 * Gets first post attachment image
 * @param $post_id
 * @since Supernova 1.4.8
 */

if(!function_exists('supernova_get_attachment_image')){
function supernova_get_attachment_image($post_id = false){
    $attachments = get_posts( array('post_type' => 'attachment', 'posts_per_page' => 1, 'post_status' =>  null, 'post_parent' => $post_id, 'post_mime_type'  =>  array( 'image/jpeg' , 'image/gif' , 'image/jpg' , 'image/png' )) );
		if ( $attachments ) {
			foreach ( $attachments as $attachment ) {
                            if(function_exists('wp_get_attachment_image'))
				return wp_get_attachment_image( $attachment->ID, 'thumbnail');				
			}
		}
}
}


/*
 * Gets thumbnail in widgets
 * @since Supernova 1.4.8
 * 
 */

if(!function_exists('supernova_thumbnail_widget')){        
function supernova_thumbnail_widget($post_id){
    global $supernova_options;
  	if (has_post_thumbnail($post_id)){
            return  get_the_post_thumbnail($post_id, 'thumbnail');
            }elseif(supernova_get_attachment_image($post_id)){
                return supernova_get_attachment_image($post_id);
            }elseif($supernova_options['default-thumb']){
                return '<img src="'.$supernova_options['default-thumb'].'" alt="">';
            }else{
                return '<img src="'.SUPERNOVA_ROOT.'/images/default.png" alt="" />';
            }
}  
}
 
//Header title image
if(!function_exists('supernova_title_image')){
function supernova_title_image(){
	    $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : 
                    echo '<a href="'.esc_url( home_url() ).'">
                        <img class="site-logo" src="'.get_header_image().'" 
                        height="'.get_custom_header()->height.'" width="'.get_custom_header()->width.'" 
                        alt="'.get_bloginfo('name').'" title="'.get_bloginfo('name').'" />
                        </a>';
                endif; 
}
}        
        
/*Function for displaying Ad
* @param $id
* returns Ad Code
* @since version 1.1.0
*/

if(!function_exists('supernova_display_ad')){        
function supernova_display_ad($id){
	global $supernova_options;
         $ad = '';
if(supernova_options(''.$id.'')){   
    $ad .= '<section class="'.$id.'">';
    $ad .= '<div class="'.$id.'-inner">'.$supernova_options[''.$id.''].'</div>';
    $ad .= '</section>';
 }
        return $ad;
}
}        

/*
 * Returns button for each ajax post (because some people had trouble translating texts)
 * @since Supernova 1.4.4
 */

if(!function_exists('supernova_ajax_button')){       
function  supernova_ajax_button($class, $total_posts, $posts_per_page, $left_posts){
      global $supernova_options;
    echo '<button class="'.$class.' '.$total_posts.' button '.$posts_per_page.'" >'.$supernova_options['loader-text'].'</button><img class="main_loader" src="'.SUPERNOVA_ROOT_ADMIN.'/images/loader.gif" alt="ajax-loader">'; 
}
}
        
        
/*
 * Adds Buttons to end latest posts 
 */

if(!function_exists('supernova_ajax_main_button')){       
function supernova_ajax_main_button(){
    global $wp_query, $supernova_options;
    $total_pages = $wp_query->max_num_pages;
    $posts_per_page = get_option('posts_per_page');
    if($total_pages == 1 || supernova_options('ajax-postloader') ){return false;}else{
    echo '<button class="supernova_load_more_main '.$total_pages.' button '.$posts_per_page.'">'.$supernova_options['loader-text'].'</button><img class="main_loader" src="'.SUPERNOVA_ROOT_ADMIN.'/images/loader.gif" alt="ajax-loader"><span></span>';
        }
}
}

if(!function_exists('supernova_ajax_tabs')){
function supernova_ajax_tabs(){
    global $supernova_options;
    $tabs               = '';
    $latest_text        = (isset($supernova_options['latest-blog']) && trim($supernova_options['latest-blog'])) ? esc_attr($supernova_options['latest-blog']) : __('Latest Blogs', 'Supernova');
    $popular_text       = (isset($supernova_options['popular-text']) && trim($supernova_options['popular-text'])) ? esc_attr($supernova_options['popular-text']) : __('Popular Posts', 'Supernova');
    $recommended_text   = (isset($supernova_options['rec-text']) && trim($supernova_options['rec-text']) ) ? esc_attr($supernova_options['rec-text']): __('Recommended', 'Supernova');            

    $tabs .= '<div id="tabs">';
    $tabs .= '<div class="tab_current" id="tab_one">'.$latest_text.'</div>';
    
    if(supernova_options('popular-tab') != 1 ){
    $tabs .= '<div id="tab_two">'.$popular_text.'</div>';
    }
    
    if(supernova_options('rec-tab') != 1 ){
    $tabs .=  '<div id="tab_three">'.$recommended_text.'</div>';
    }
    
    $tabs .=  '</div>';
    
    if(supernova_options('popular-tab') == 1  &&  supernova_options('rec-tab') == 1){
        return false;        
    }else{
        echo $tabs;
    }
}
}


if(!function_exists('supernova_footer_text')){
function supernova_footer_text(){
    global $supernova_options;
    if(trim($supernova_options['footer-text'])==''){        
        return '&nbsp;'.supernova_copyright_custom_date().bloginfo('name');
            }else{
                return '&nbsp;'.esc_html($supernova_options['footer-text']);                
            }
}
}

/*
 * Gets the content or content depending on what user has selected.
 */
if(!function_exists('supernova_content')){
function supernova_content(){
    global $supernova_options;
    if(isset($supernova_options['full-content']) && $supernova_options['full-content'] == 2){
        the_content();        
    }else{
        the_excerpt();
    }
}
}

/*
 * Creates Navigation for Category
 * @since Supernova 1.4.2
 */
if(!function_exists('supernova_category_navigation')){
function supernova_category_navigation(){
    global $sup_header_catname;
    if(!supernova_options('disable-categories')){
        echo '<div class="header_catnav">';        
        echo        '<div class="header_cat_title"><span class="cat_icon"></span><span class="first_cat">'.$sup_header_catname.'</span><div class="clearfix"></div></div>';
        echo '<div class="catnav">';
                        if(has_nav_menu('Header_Cat')){ wp_nav_menu( array('theme_location'=>'Header_Cat', 'menu'=>'Header Categories'));}else{
        echo                "<ul>";
                                wp_list_categories(array('title_li' => NULL, 'number' => 6));//Only if user has not selected menu
        echo                "</ul>";
                            }                
        echo  '</div></div>';
    }
}
}

/*
 * Gives Update to the user 
 * @since Supernova 1.4.2
 * 
 */

if(!function_exists('supernova_update_massage')){
function supernova_update_massage(){
    return true;
}
}

/*
 * Returns Excerpt outside of loop with id
 * @param $id, $excerpt_length
 * @since Supernova 1.4.8
 */

if(!function_exists('supernova_get_excerpt_by_id')){
function supernova_get_excerpt_by_id($post_id, $excerpt_length){
    $the_post       = get_post($post_id); 
    $the_excerpt    = $the_post->post_content;  
    $the_excerpt    = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
    
    $words = explode(' ', $the_excerpt, $excerpt_length + 1);

    if(count($words) > $excerpt_length) :
        array_pop($words);
        array_push($words, '…');
        $the_excerpt = implode(' ', $words);
    endif;

    $the_excerpt = '<p>' . $the_excerpt . '</p>';

    return $the_excerpt;
}
}

/*
 * Returns Posts for supernova tabber widget
 * @param $type, $posts_per_page, $show_thumb, $comment_date
 * @return content
 * @since Supernova 1.4.8
 */

if(!function_exists('supernova_tabber_posts')){
function supernova_tabber_posts($type, $posts_per_page, $show_thumb, $comment_date){
    global $supernova_options, $post;    
    $post_ids = array();
        
    if( trim($type) == 1 ){
        $post_ids   = supernova_get_specific_post_ids($posts_per_page, 0, 'date', NULL, NULL);        
    }
    
    if($type == 2 ){
        //If Actual Count selected
        $post_ids   = supernova_get_specific_post_ids($posts_per_page, 0 , 'meta_value_num', 'supernova_post_views_count', NULL);
        
        //Count on Comment
        if(empty($post_ids) || $supernova_options['poplular-pos-dep'] == '2'){
        $post_ids   = supernova_get_specific_post_ids($posts_per_page, 0, 'comment_count' , NULL, NULL );
        }

        //If user selected to choose himself
        if($supernova_options['poplular-pos-dep'] == '3'){
        $post_ids   = supernova_get_specific_post_ids($posts_per_page, 0, NULL , 'supernova-popular-post', 1 );
        }
    }

    if($type == 3 ){
        $post_ids  = supernova_get_specific_post_ids( $posts_per_page, 0 , NULL , 'supernova-recommended-post', 1 );
    }
    
    if($type == 4 ){
        $post_ids   = supernova_get_specific_post_ids($posts_per_page, 0, 'rand', NULL, NULL);
    }    
    
    $post_content = get_posts( array( 'post__in'=>$post_ids, 'post_status'=>'publish', 'ignore_sticky_posts' => true, 'orderby'=>'post__in'));
    
    if($post_content){
        echo '<ul class="supernova_tabber_widget_'.$type.'">';
    	foreach($post_content as $post): setup_postdata($post);
            $id = get_the_ID();
            
            echo '<li>';            
            if(supernova_thumbnail_widget($id) && $show_thumb == 1)
            echo  '<span class="supernova_tabber_thumbnail">'.supernova_thumbnail_widget($id).'</span>';
            echo    '<h4>'.get_the_title($id).'</h4>';
            echo '<a class="tabber_link" href="'.get_permalink($id).'">';            
            echo '</a>';
            
            if($comment_date != 3){                
                echo '<span class="tabber_comment">';                
                    if($comment_date == 2)
                     echo    '<span>'.get_the_time(get_option('date_format'), $id).'</span>';
                    if($comment_date == 1)
                     comments_popup_link(__('Leave A Comment', 'Supernova'), __('1 comment', 'Supernova'), ' % Comments');
                echo '</span>';                    
            }
            
            echo'</li>';
        endforeach;
        echo "</ul>";
    }
}
}

/*
 * Is used only in the tabber widget
 * @since Supenrova 1.4.8
 * 
 */
if(!function_exists('supernova_get_selected_tabber')){
function supernova_get_selected_tabber($id){
    if($id == 0 || $id == '')
        return 'None';
    if($id == 1)
        return 'Recent';
    if($id == 2)
        return "Popular";
    if($id == 3)
        return "Recommended";
    if($id == 4)
        return "Random";
}
}

/*
 * Is used in the checkbox input field to make the code look clean
 * @param $id, $value
 * @retuns "checked" = "checked"
 * @since Supernova 1.4.8
 */

if(!function_exists('supernova_checked')){
function supernova_checked($id, $value ){
    if($id == $value ){
      return  'checked="checked"';
    }else{
        return false;
    }
}
}

if(!function_exists('supernova_ifnotset')){
function supernova_ifnotset($variable, $else){
    if(!isset($variable) || $variable == ''){
        $variable = $else;
    }    
}
}



/**
 * Modifies WordPress's built-in comments_popup_link() function to return a string instead of echo comment results
 * @param $zero, $one, $more, $css_class, $none
 * @since Supernova 1.5.1
 * 
 */
if(!function_exists('supernova_get_comments_popup_link')){
function supernova_get_comments_popup_link( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
    global $wpcommentspopupfile, $wpcommentsjavascript;
 
    $id = get_the_ID();
 
    if ( false === $zero ) $zero = __( 'No Comments', 'Supernova' );
    if ( false === $one ) $one = __( '1 Comment', 'Supernova' );
    if ( false === $more ) $more = __( '% Comments', 'Supernova' );
    if ( false === $none ) $none = __( 'Comments Off', 'Supernova' );
 
    $number = get_comments_number( $id );
 
    $str = '';
 
    if ( 0 == $number && !comments_open() && !pings_open() ) {
        $str = '<span' . ((!empty($css_class)) ? ' class="' . esc_attr( $css_class ) . '"' : '') . '>' . $none . '</span>';
        return $str;
    }
 
    if ( post_password_required() ) {
        $str = __('Enter your password to view comments.', 'Supernova');
        return $str;
    }
 
    $str = '<a href="';
    if ( $wpcommentsjavascript ) {
        if ( empty( $wpcommentspopupfile ) )
            $home = home_url();
        else
            $home = get_option('siteurl');
        $str .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
        $str .= '" onclick="wpopen(this.href); return false"';
    } else { // if comments_popup_script() is not in the template, display simple comment link
        if ( 0 == $number )
            $str .= get_permalink() . '#respond';
        else
            $str .= get_comments_link();
        $str .= '"';
    }
 
    if ( !empty( $css_class ) ) {
        $str .= ' class="'.$css_class.'" ';
    }
    $title = the_title_attribute( array('echo' => 0 ) );
 
    $str .= apply_filters( 'comments_popup_link_attributes', '' );
 
    $str .= ' title="' . esc_attr( sprintf( __('Comment on %s', 'Supernova'), $title ) ) . '">';
    $str .= supernova_get_comments_number_str( $zero, $one, $more );
    $str .= '</a>';
     
    return $str;
}
}
 
/**
 * Modifies WordPress's built-in comments_number() function to return string instead of echo. To be used in supernova_get_comments_popup_link function
 * @param $zero, $more, $deprecated 
 * 
 */
if(!function_exists('supernova_get_comments_number_str')){
function supernova_get_comments_number_str( $zero = false, $one = false, $more = false, $deprecated = '' ) {
    if ( !empty( $deprecated ) )
        _deprecated_argument( __FUNCTION__, '1.3' );
 
    $number = get_comments_number();
 
    if ( $number > 1 )
        $output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __('% Comments', 'Supernova') : $more);
    elseif ( $number == 0 )
        $output = ( false === $zero ) ? __('No Comments', 'Supernova') : $zero;
    else // must be one
        $output = ( false === $one ) ? __('1 Comment', 'Supernova') : $one;
 
    return apply_filters('comments_number', $output, $number);
}
}