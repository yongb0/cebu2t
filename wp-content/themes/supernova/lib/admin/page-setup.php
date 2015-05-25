<?php
/*
* For creating pages for admin
* @param $pagename, $width, $i, $options_array
* Returns pages
 * @pakage Supernova
 * Copyright (C) 2013 Sayed Taqui
*/

if(!function_exists('supernova_admin_page_setup')){
function supernova_admin_page_setup($pagename, $width = false , $i = false, $is_submenu = false){
	global $supernova_defaults; 

echo (!$is_submenu && $pagename != 'Support') ? '<table class="supernova_table">' :  '<table class="sup_inner_tab sup_inner_tab_'.$pagename.'">';

    foreach($supernova_defaults as $value):
        
        $tab_name       = (isset($value['tab']) && $value['tab']) ? $value['tab'] : '';
        $lable_name     = (isset($value['label']) && $value['label'] ) ? $value['label'] : '';
        $name           = (isset($value['name']) && $value['name']) ? $value['name'] : '';
        $name2          = (isset($value['name2']) && $value['name']) ? $value['name2'] : '';
        $desc           = (isset($value['desc']) && $value['desc']) ? $value['desc'] : '';
        $image_url      = (isset($value['image']) && $value['image']) ? $value['image'] : '';        
        $type           = (isset($value['type']) && $value['type']) ? $value['type'] : '';
        $default        = (isset($value['default']) && $value['default']) ? $value['default'] : '';
        $message        = (isset($value['message']) && $value['message']) ? $value['message'] : '';
        $min_value      = (isset($value['min']) && $value['min'] ) ? $value['min'] : '';
        $max_value      = (isset($value['max']) && $value['max']) ? $value['max'] : '';
        $classes        = (isset($value['classes']) && $value['classes']) ? $value['classes'] : '';
        $class          = (isset($value['class']) && $value['class']) ? $value['class'] : '';
        $radio_classes  = (isset($value['radio-classes']) && $value['radio-classes']) ? $value['radio-classes'] : '';
        $radio_images   = (isset($value['radio-images']) && $value['radio-images']) ? $value['radio-images'] : '';
        $bg_color       = (isset($value['bg-color']) && $value['bg-color']) ? $value['bg-color'] : '';        
        $placeholder    = (isset($value['placeholder']) && $value['placeholder']) ? $value['placeholder'] : '';  
        $radio_labels   = (isset($value['labels']) && $value['labels']) ? $value['labels'] : '';  
        $select_options = (isset($value['options']) && $value['options']) ? $value['options'] : '';        
        
switch($tab_name):
    case $pagename;
        switch($type):
                    
            case 'message';
                echo supernova_aop_helper_message( $message, $class  );

            break; case 'image-uploader';
                echo supernova_aop_image_uploader( $width, $name , $lable_name, $desc );

            break; case 'checkbox';
                echo supernova_aop_checkbox_switch($width, $name , $lable_name, $desc , $image_url);
                    
            break; case 'radio';
                echo supernova_aop_radio( $width, $name , $lable_name, $desc , false, $radio_labels , $classes);
                    
            break; case 'radio-image';
                 echo supernova_aop_image_radio( $width, $name , $lable_name, $desc , false, $radio_images , $radio_classes);

            break; case 'color-scheme';
                echo supernova_aop_color_scheme( $width, $name , $lable_name, $desc , false, $bg_color);

            break; case 'textarea';
                 echo supernova_aop_textarea( $width, $name , $lable_name, $desc , false);

            break; case 'select';
                echo supernova_aop_select( $width, $name , $lable_name, $desc , false, $select_options, $placeholder );

            break; case 'color';
                echo supernova_aop_color_picker( $width, $name , $lable_name, $desc , false);

            break; case 'slider';
                echo supernova_aop_slider_field( $width, $name ,$name2 , $lable_name , $desc , false, $placeholder);

            break; case 'links';
                echo supernova_aop_link_field( $width, $name , $lable_name, $desc , $image_url, $placeholder);

            break; case 'text';
                echo supernova_aop_input_text( $width, $name , $lable_name, $desc , $image_url, $placeholder);
                
            break; case 'select-sortable';
                echo supernova_aop_select_sortable( $width, $name , $lable_name, $desc , $image_url, $default);
                
            break; case 'range-slider';
                echo supernova_aop_range_slider( $width, $name , $lable_name , $desc, false, $i, $default, $min_value, $max_value, $default );
                supernova_range_slider_settings('slider_range'.$i, 'slider-result'.$i, $name , supernova_options(''.$name.''), $default, $min_value, $max_value);
                $i++;

            break; case 'support';
                supernova_aop_support();
                
            break;  

endswitch;endswitch;endforeach;
    
    echo '</table>';
        
}
}