<?php
/*
 * Includes all funcitons used to create options page, you may create new functions with the same name, if you want to tweak the options page fields
 * @pakage Supernova
 * Copyright (C) 2013 Sayed Taqui
 * @since Supenrova 1.5.1
 * 
 */

/*
 * Handles Image Uploader Field
 * @param $message, $rowclass(optional),   $outclass(optional), $innerclass(optional)
 * @returns $html
 * 
 */

if(!function_exists( 'supernova_aop_helper_message' )){
    function supernova_aop_helper_message($message, $rowclass = false,  $outclass = false, $innerclass = false ){
        
       $html = '';       
       
$html .= '<tr class="'.$rowclass.'">';
$html .=    '<td class="'.$outclass.'">';  
$html .=        '<span class="'.$innerclass.'">'.$message.'</span>';
$html .=        '<span class="sup_slider_up" title="Hide"><img src="'.SUPERNOVA_ROOT_ADMIN.'/images/UpArrow.gif" /></span>';
$html .=    '</td>';
$html .= '</tr>';
$html .= '<tr class="sup_slide_down_row">';
$html .=        '<td><span class="sup_slider_down" title="Show"><img src="'.SUPERNOVA_ROOT_ADMIN.'/images/DropArrow.gif" /></span></td>';
$html .= '</tr>';
    
    return $html;
    
    }
}

/*
 * Handles Image Uploader Field
 * @param $width, $name, $name, $desc
 * @returns $html
 * 
 */

if(!function_exists( 'supernova_aop_image_uploader' )){
    function supernova_aop_image_uploader( $width, $name, $label_name, $desc ){
        
       $html = '';       
       
$html .= '<tr class = "aop_image_uploader">';
    $html .= '<td width="'.$width.'">';
    $html .=    '<label for="'.$name.'">'.$label_name.'</label>';        
    $html .= '</td>';
    $html .= '<td id="supfield_'.$name.'">';
        if(supernova_options(''.$name.''))
    $html .=    '<img class="aop_image_uploader_thumb" src="'.esc_url(supernova_options(''.$name.'')).'" />';
        
    $html .=    '<input type="text"  name="supernova_settings['.$name.']" id="'.$name.'" value="'.esc_url(supernova_options(''.$name.'')).'" size="40" class="supernova_links" />';    
    
    $html .=    '<input type="button" class="supernova-upload-button button" value="'.__('Upload', 'Supernova').'" />';                
    $html .=    '<input type="button" class="remove-button button" value="'. __('Remove', 'Supernova').'" />';       
        
    $html .=    ($desc) ? '<div class="help_wrapper"><span class="Shelp"></span><span class="field_help help">'.$desc.'</span></div>' : '';
    $html .= '</td>';
$html .= '</tr>';
    
    return $html;
    
    }
}

/*
 * Handles ON/OFF switch field
 * @param $width, $name, $label_name, $desc, $image_url(optional)
 * @returns $html
 * 
 */

if(!function_exists( 'supernova_aop_checkbox_switch' )){
    function supernova_aop_checkbox_switch( $width, $name, $label_name, $desc, $image_url = false ){
        
       $html = '';
       
$html .= '<tr class = "aop_checkbox_switch">';
    $html .= '<td width="'.$width.'">';
    $html .=    '<label for="'.$name.'">';
    $html .= ($image_url) ? '<img src="'.SUPERNOVA_ROOT_ADMIN.'images/'.$image_url.' ">'  : $label_name;
    $html .= '</label>';
    $html .= '</td>';
    $html .= '<td class="supernova_'.$name.'">';
    $html .=    '<input type="checkbox" name="supernova_settings['.$name.']" value="1" '.  supernova_checked_check($name , 1).'  /><br />';    
    $html .=    ($desc) ? '<div class="help_wrapper"><span class="Shelp"></span><span class="field_help help">'.$desc.'</span></div>' : '';
    $html .= '</td>';
$html .= '</tr>';

    return $html;
    
    }
}


/*
 * Handles the range slider
 * @param $width, $name, $label_name, $desc, $image_url, $i
 * @returns $html
 * 
 */

if(!function_exists( 'supernova_aop_range_slider' )){
    function supernova_aop_range_slider( $width, $name, $label_name, $desc, $image_url, $i, $default){
        global $supernova_options;
       $html = '';
       $value = (isset($supernova_options[''.$name.'']) && $supernova_options[''.$name.'']) ? $supernova_options[''.$name.''] : $default;
       
$html .= '<tr class = "aop_range_slider">';
    $html .= '<td width="'.$width.'">';
    $html .=    '<label for="'.$name.'">';
    $html .=        ($image_url) ? '<img src="'.SUPERNOVA_ROOT_ADMIN.'images/'.$image_url.' ">'  : $label_name;
    $html .=    '</label>';
    $html .= '</td>';
    $html .= '<td class="supernova_'.$name.'">';
    $html .=    '<div class="slider_range'.$i.' slider_range"></div>';
    $html .=    '<div class="slider-result slider-result'.$i.'">'.$value.'</div>';
    $html .=    '<input type="hidden" id="'.$name.'" name="supernova_settings['.$name.']" value="'.$value.'"/>';
    $html .=    ($desc) ? '<div class="help_wrapper"><span class="Shelp"></span><span class="field_help help">'.$desc.'</span></div>' : '';
    $html .= '</td>';
$html .= '</tr>';

    return $html;
    
    }
}

/*
 * Handles the radio box for images
 * @param $width, $name, $label_name, $desc, $image_url, $radio_images, $radio_classes
 * @returns $html
 * 
 */

if(!function_exists( 'supernova_aop_image_radio' )){
    function supernova_aop_image_radio( $width, $name, $label_name, $desc, $image_url, $radio_images, $radio_classes){
        
       $html = ''; $count = 1;
       
$html .= '<tr class = "aop_image_radio">';
    $html .= '<td width="'.$width.'">';
    $html .=    '<label for="'.$name.'">';
    $html .=        ($image_url) ? '<img src="'.SUPERNOVA_ROOT_ADMIN.'images/'.$image_url.' ">'  : $label_name;
    $html .=    '</label>';
    $html .= '</td>';
    $html .= '<td class="supernova_'.$name.'">';
    
    if($radio_images):
    foreach($radio_images as $image):
    $html .= '<div class="'.$radio_classes[($count-1)].'">';
    $html .= '<img src="'.$image.'"><br />';
    $html .= '<input type="radio" id="'.$name.'" name="supernova_settings['.$name.']" value="'.$count.'" '.  supernova_checked_check($name, $count).' />';
    $html .= '</div>';
        $count++;
    endforeach;endif;
    
    $html .=    ($desc) ? '<div class="help_wrapper"><span class="Shelp"></span><span class="field_help help">'.$desc.'</span></div>' : '';
    $html .= '</td>';
$html .= '</tr>';


    return $html;
    
    }
}


/*
 * Handles simple radio selection
 * @param $width, $name, $label_name, $desc, $image_url, $labels, $classes(optional)
 * @returns $html
 * 
 */

if(!function_exists( 'supernova_aop_radio' )){
    function supernova_aop_radio( $width, $name, $label_name, $desc, $image_url, $labels, $classes = false){
        
       $html = ''; $count = 1; 
       
$html .= '<tr class = "aop_radio">';
    $html .= '<td width="'.$width.'">';
    $html .=    '<label for="'.$name.'">';
    $html .=        ($image_url) ? '<img src="'.SUPERNOVA_ROOT_ADMIN.'images/'.$image_url.' ">'  : $label_name;
    $html .=    '</label>';
    $html .= '</td>';
    $html .= '<td class="supernova_'.$name.'">';
    $html .= '<div class="popular_post_selection">';
    
if($labels):
    foreach($labels as $label):          
        $class = ($classes) ? $classes[($count-1)] : '';
    
        $html .= '<span class="'.$class.'">';
        $html .= '<label for="'.$name.$count.'">'.$label.'</label>';
        $html .= '<input type="radio" id="'.$name.$count.'" name="supernova_settings['.$name.']" value="'.$count.'" '.supernova_checked_check($name, $count).' />';
        $html .= '</span>';
    $count++;
    endforeach;                    
endif;
    $html .= '</div>';
    $html .= '<p class="letmeselect" style="clear: both;">';
    $html .=  __('Okay, now you can select the poplular posts like you select recommended posts meaning from every individual posts', 'Supernova');
    $html .= '</p>';
    $html .=    ($desc) ? '<div class="help_wrapper"><span class="Shelp"></span><span class="field_help help">'.$desc.'</span></div>' : '';
    $html .= '</td>';
$html .= '</tr>';

    return $html;
    
    }
}


/*
 * Handles color scheme field
 * @param $width, $name, $label_name, $desc, $image_url, $i
 * @returns $html
 * 
 */

if(!function_exists( 'supernova_aop_color_scheme' )){
    function supernova_aop_color_scheme( $width, $name, $label_name, $desc, $image_url , $bg_colors){
        
       $html = ''; $x = '';
       $count = 2;
       
        if (supernova_options($name) == 1){ 
            $x =  'checked="checked"';
        }elseif(!supernova_options($name)==2 || !supernova_options($name) == 3){
            $x = 'checked="checked"';            
        } 
       
       
$html .= '<tr class = "aop_color_scheme">';
    $html .= '<td width="'.$width.'">';
    $html .=    '<label for="'.$name.'">';
    $html .=        ($image_url) ? '<img src="'.SUPERNOVA_ROOT_ADMIN.'images/'.$image_url.' ">'  : $label_name;
    $html .=    '</label>';
    $html .= '</td>';
    $html .= '<td class="supernova_'.$name.'">';
    $html .= '<div class="scheme_one">';
    $html .= '<div class="scheme_color" style="background:#db9f0e">';
    $html .= '<span class="checkedyes">';
    $html .= '<img src="'.SUPERNOVA_ROOT_ADMIN.'images/yes.png">';
    $html .= '</span>';
    $html .= '</div>';
    $html .= '<input type="radio" name="supernova_settings['.$name.']" value="1" '.$x.' />';
    $html .= '</div>';
    
if($bg_colors):
foreach($bg_colors as $color):
    $html .= '<div class="scheme_one">';
    $html .= '<div class="scheme_color" style="background:#'.$color.'">';
    $html .= '<span class="checkedyes">';
    $html .= '<img src="'.SUPERNOVA_ROOT_ADMIN.'images/yes.png">';
    $html .= '</span>';
    $html .= '</div>';
    $html .= '<input type="radio" name="supernova_settings['.$name.']" value="'.$count.'" '.supernova_checked_check($name, $count).' />';
    $html .= '</div>';
    $count++;     
endforeach;
endif;
    $html .=    ($desc) ? '<div class="help_wrapper"><span class="Shelp"></span><span class="field_help help">'.$desc.'</span></div>' : '';
    $html .= '</td>';
$html .= '</tr>';

    return $html;
    
    }
}

/*
 * Handles textarea
 * @param $width, $name, $label_name, $desc, $image_url(optional)
 * @returns $html
 * 
 */

if(!function_exists( 'supernova_aop_textarea' )){
    function supernova_aop_textarea( $width, $name, $label_name, $desc, $image_url = false){
        
       $html = '';       
       
$html .= '<tr class = "aop_textarea">';
    $html .= '<td width="'.$width.'">';
    $html .=    '<label for="'.$name.'">';
    $html .=        ($image_url) ? '<img src="'.SUPERNOVA_ROOT_ADMIN.'images/'.$image_url.' ">'  : $label_name;
    $html .=    '</label>';
    $html .= '</td>';
    $html .= '<td>';
    $html .= '<textarea class="supernova_ad" rows="7" id="'.$name.'" name="supernova_settings['.$name.']">';
    $html .= supernova_options(''.$name.'');
    $html .= '</textarea>';
    $html .=    ($desc) ? '<div class="help_wrapper"><span class="Shelp"></span><span class="field_help help">'.$desc.'</span></div>' : '';
    $html .= '</td>';
$html .= '</tr>';

    return $html;    
       
    }

}

/*
 * Handles drag drop sortable select
 * @param $width, $name, $label_name, $desc, $image_url(optional), $options, $default, $placeholder
 * @returns $html
 * 
 */

if(!function_exists( 'supernova_aop_select_sortable' )){
    function supernova_aop_select_sortable( $width, $name, $label_name, $desc, $image_url, $default){
        global $supernova_options;
       $html = '';
       $value = (isset($supernova_options[''.$name.'']) && $supernova_options[''.$name.''] != '') ? $supernova_options[''.$name.''] : 'Author, Date, Comment';
       
$html .= '<tr class = "aop_select">';
    $html .= '<td width="'.$width.'">';
    $html .=    '<label for="'.$name.'">';
    $html .=        ($image_url) ? '<img src="'.SUPERNOVA_ROOT_ADMIN.'images/'.$image_url.' ">'  : $label_name;
    $html .=    '</label>';
    $html .= '</td>';
    $html .= '<td>';
    
    $html .= '<input type= "hidden" name="supernova_settings['.$name.']" id="e15"  value="'.$value.'" size="40"  />';
    
    $html .=    ($desc) ? '<div class="help_wrapper"><span class="Shelp"></span><span class="field_help help">'.$desc.'</span></div>' : '';
    $html .= '</td>';
$html .= '</tr>';

    return $html;    
       
    }

}

/*
 * Handles Select Options
 * @param $width, $name, $label_name, $desc, $image_url(optional), $options, $default, $placeholder
 * @returns $html
 * 
 */

if(!function_exists( 'supernova_aop_select' )){
    function supernova_aop_select( $width, $name, $label_name, $desc, $image_url, $select_options, $placeholder = false){
        global $supernova_options;
       $html = '';       
       
$html .= '<tr class = "aop_select_sortable">';
    $html .= '<td width="'.$width.'">';
    $html .=    '<label for="'.$name.'">';
    $html .=        ($image_url) ? '<img src="'.SUPERNOVA_ROOT_ADMIN.'images/'.$image_url.' ">'  : $label_name;
    $html .=    '</label>';
    $html .= '</td>';
    $html .= '<td>';
    
    $html .= '<select name="supernova_settings['.$name.']" class="supernova_admin_select" data-placeholder="'.$placeholder.'">';    
    $html .= '<option value=""></option>';
    if($select_options):
foreach ($select_options as $values):
        $selected = ($values == $supernova_options[''.$name.'']) ? 'selected' : '';
    $html .= '<option '.$selected.' value="'.$values.'">'.$values.'</option>';
endforeach;
endif;
    $html .=  '</select>';
    
    $html .=    ($desc) ? '<div class="help_wrapper"><span class="Shelp"></span><span class="field_help help">'.$desc.'</span></div>' : '';
    $html .= '</td>';
$html .= '</tr>';

    return $html;    
       
    }

}



/*
 * Handles color picker
 * @param $width, $name, $label_name, $desc, $image_url(optional), $i
 * @returns $html
 * 
 */

if(!function_exists( 'supernova_aop_color_picker')){
    function supernova_aop_color_picker( $width, $name, $label_name, $desc, $image_url = false){
        global $supernova_options;
       $html = '';
       
$html .= '<tr class = "aop_color_picker">';
    $html .= '<td width="'.$width.'">';
    $html .=    '<label for="'.$name.'">';
    $html .=        ($image_url) ? '<img src="'.SUPERNOVA_ROOT_ADMIN.'images/'.$image_url.' ">'  : $label_name;
    $html .=    '</label>';
    $html .= '</td>';
    $html .= '<td>';    
    $html .= '<input type="text" class="color" id="'.$name.'" name="supernova_settings['.$name.']" value="'.esc_attr($supernova_options[''.$name.'']).'" size="40" /><br />';    
    $html .=    ($desc) ? '<div class="help_wrapper"><span class="Shelp"></span><span class="field_help help">'.$desc.'</span></div>' : '';
    $html .= '</td>';
$html .= '</tr>';

    return $html;    
       
    }

}


/*
 * Handles color picker
 * @param $width, $name, $label_name, $desc, $image_url(optional), $i, $name_page, $name_thumb, $placeholder
 * @returns $html
 * 
 */

if(!function_exists( 'supernova_aop_slider_field' )){
    function supernova_aop_slider_field( $width, $name_page, $name_thumb, $label_name, $desc, $image_url, $placeholder){
        global $supernova_options;
       $html = '';       
       
$html .= '<tr class = "aop_slider_field">';
    $html .= '<td width="'.$width.'">';
    $html .=    '<label for="'.$name_page.'">';
    $html .=        ($image_url) ? '<img src="'.SUPERNOVA_ROOT_ADMIN.'images/'.$image_url.' ">'  : $label_name;
    $html .=    '</label>';
    $html .= '</td>';

    $html .= '<td>';
    $post_pages = (isset($supernova_options['slider-from-page']) && $supernova_options['slider-from-page'] == 2 ) ? 'page' : 'post';
    $html .= supernova_page_list($post_pages, 'supernova_settings['.$name_page.']', intval($supernova_options[''.$name_page.'']));
    $html .= '<input type="text"  name="supernova_settings['.$name_thumb.']" value="'.esc_url($supernova_options[''.$name_thumb.'']).'" placeholder="'.$placeholder.'" size="40" class="supernova_links" id="supernova_'.$name_page.'" />';
    $html .= '<input type="button" class="supernova-upload-button button" value="'.__('Upload', 'Supernova').'" /><br />';
    $html .= '<input type="button" class="remove-button button" value="'.__('Remove', 'Supernova').'" /><br /><br />';
    if($desc){                
    $html .= '<div class="help_wrapper"><span class="Shelp"></span><span class="field_help help">'.$desc.'</span></div>';
    }
    $html .= '</td>';
    $html .= '<td class="imgpre imgpre_ref">';
        if(trim($supernova_options[''.$name_thumb.''])){
        $html .= '<img class="imgpre_loaded" src="'.$supernova_options[''.$name_thumb.''].'" />';
        } else{
          $html .= get_the_post_thumbnail($supernova_options[''.$name_page.'']);
        } 
    $html .= '</td>';        
$html .= '</tr>';

    return $html;
       
    }

}


/*
 * Handles color link field
 * @param $width, $name, $label_name, $desc, $image_url(optional), $i
 * @returns $html
 * 
 */

if(!function_exists( 'supernova_aop_link_field' )){
    function supernova_aop_link_field( $width, $name, $label_name, $desc, $image_url , $placeholder){
        global $supernova_options;
       $html = '';
       $img = ($image_url) ? '<img src="'.$image_url.'">' : '';
       
$html .= '<tr class = "aop_link_field">';
    $html .= '<td width="'.$width.'">';
    $html .=    '<label for="'.$name.'">';
    $html .=        $img.'<i>'.$label_name.'</i>';
    $html .=    '</label>';
    $html .= '</td>';
    $html .= '<td>';    
    $html .= '<input type="text" placeholder="'.$placeholder.'" id="'.$name.'"  name="supernova_settings['.$name.']" class="supernova_links" value="'.$supernova_options[''.$name.''].'" size="40" />';
    $html .= '<input type="button" class="remove-button button" value="'. __('Remove', 'Supernova').'" />';
    $html .=    ($desc) ? '<div class="help_wrapper"><span class="Shelp"></span><span class="field_help help">'.$desc.'</span></div>' : '';
    $html .= '</td>';
$html .= '</tr>';

    return $html;    
       
    }

}

/*
 * Handles color input text
 * @param $width, $name, $label_name, $desc, $image_url(optional), $i
 * @returns $html
 * 
 */

if(!function_exists( 'supernova_aop_input_text' )){
    function supernova_aop_input_text( $width, $name, $label_name, $desc, $image_url , $placeholder){
        global $supernova_options;
       $html = '';
       $img = ($image_url) ? '<img src="'.SUPERNOVA_ROOT_ADMIN.'images/'.$image_url.'">' : '';
       
$html .= '<tr class = "aop_input_text">';
    $html .= '<td width="'.$width.'">';
    $html .=    '<label for="'.$name.'">';
    $html .=        $img.'<i>'.$label_name.'</i>';
    $html .=    '</label>';
    $html .= '</td>';
    $html .= '<td>';    
    $html .= '<input type="text" placeholder="'.$placeholder.'"  name="supernova_settings['.$name.']" value="'.$supernova_options[''.$name.''].'" size="40" />';    
    $html .=    ($desc) ? '<div class="help_wrapper"><span class="Shelp"></span><span class="field_help help">'.$desc.'</span></div>' : '';
    $html .= '</td>';
$html .= '</tr>';

    return $html;
       
    }

}


/*
 * Handles Support Tab
 * 
 */

if(!function_exists( 'supernova_aop_support' )){
    function supernova_aop_support(){
        include SUPERNOVA_ADMIN.'support.php';       
    }    
}