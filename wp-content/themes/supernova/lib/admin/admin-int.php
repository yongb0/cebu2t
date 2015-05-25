<?php 
/*
* The main layout of the admin options page, all the pages are called only from here
 * @pakage Supernova
 * Copyright (C) 2013 Sayed Taqui
 * @since Supenova 1.0.1
* 
*/

include SUPERNOVA_ADMIN.'page-setup.php';

global $supernova_theme_uri, $supernova_defaults, $supernova_version;

$messages = array();
//$messages[] = array(
//            'value' => __('Donate <span class="donate_heart">&#9829;</span>', 'Supernova'),
//            'link'  => 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=sayed2x2@gmail.com&item_name=Donation for Supernova',            
//        );
// $messages[] = array(
//            'value' => __('Rate Supernova 5 &#9733;', 'Supernova'),
//            'link'  => 'http://wordpress.org/support/view/theme-reviews/supernova',            
//        );
// $messages[] = array(
//             'value' => __('Get Customization Done Starting With Just $10', 'Supernova'),
//             'link'  => 'http://supernovathemes.com/hire-me/',            
//         );
$messages[] = array(
            'value' => __('Upgrade to Supernova Pro', 'Supernova'),
            'link'  => 'http://supernovathemes.com/supernova-pro/',            
        );


shuffle($messages);

/*
 * We itterate the $supernova_defaults array to find out how many pages and sub-pages have been defined.
 * 
 */

$pages_defined = array();
$sub_pages_defined = array();  
$sub_pages_tree = array(); 
$count = 0;

foreach($supernova_defaults as $supernova_default){
    $pages_defined[] = $supernova_default['tab'];
    if(isset($supernova_default['parent']) && $supernova_default['parent'] ){
        $sub_pages_defined[]   = $supernova_default['tab'];
        if($supernova_default['tab']){
            $temp_array[$count] = array($supernova_default['parent'], $supernova_default['tab']);
            if(!in_array($temp_array[$count], $sub_pages_tree)) // To filter all duplicate array
        $sub_pages_tree[] = array($supernova_default['parent'], $supernova_default['tab']);
        }
    }
    $count++;
}

$all_unique_pages_defined = array_unique($pages_defined);
$unique_sub_pages_defined = array_unique($sub_pages_defined);

$tabs_defined = array_diff($all_unique_pages_defined, $unique_sub_pages_defined); //Remove the sub menu names to get the main tabs
$sub_pages_tree = array_filter($sub_pages_tree);
 ?>

<div id="supernova_options_page">
	<?php supernova_version_notice(); ?>
    
    <header id="supernova_header">
        <div id="sup_header_left">
            <?php
                echo '<a href="'.$supernova_theme_uri.'" target="_blank">';
                echo '<span class="supernova_logo"><span></span></span>';                             
                echo '</a>';
                echo '<span class="supernova_version">'.$supernova_version.'</span>';
            ?>
        </div>
        <div id="sup_header_right">
            <?php
            foreach($messages as $message){
                $link = (isset($message['link']) && $message['link']) ? $message['link'] : '';
                $value = (isset($message['value']) && $message['value']) ? $message['value'] : '';
                echo '<a class="button sup_donate_button" href="'.$link.'" title="'.__('Thank You', 'Supernova').'" target="_blank">'.$value.'</a>';
                break;
            }
            ?>                        
        </div>
                <div class="clearfix"></div>
    </header>    
    <aside class="supernova_tabs">
            <ul>
                <?php 
                $index = 1;
                foreach($tabs_defined as $tab){
                    echo '<li id="tab_'.$index.'"><i class="sup_tab_'.$index.'"></i><span>'.$tab.'</span></li>';
                    $index++;
                }
                ?>
            </ul>
    </aside><!--supernova_tabs END -->
        
    <section id="menu_right">
        <?php
            $count = 1; $i = 1;
            
            foreach($tabs_defined as $page_name):
                echo '<div id="sup_content_'.$i.'" class="tab_content">';                    
                    
                //Inner Tabs
                    if($page_name != 'Support')
                    echo '<span class="sup_inner_tab_page border-bottom">'.$page_name.'</span>';
                    echo '<ul class="sup_inner_tab_block">';                    
                    foreach($sub_pages_tree as $tree){
                             if($tree[0] == $page_name ) {
                                   echo '<li class="sup_inner_tab sup_inner_tab_'.$tree[1].'">'.$tree[1].'</li>';
                                }
                            }
                    echo '</ul>';
                    echo '<div class="clearfix"></div>';
                
                    //Main Content
                    supernova_admin_page_setup($page_name, 200, $count );                                        
                    $count++;
                    //Sub-Menu Contents
                        echo '<div class="sup_inner_tab_contents sup_inner_tab_content_'.$i.' ">';
                                foreach($sub_pages_tree as $tree){
                                if($tree[0] == $page_name ) {
                                    supernova_admin_page_setup($tree[1], 200, $count, true );
                                    }
                                }                            
                        echo '</div>';
                        
                echo '</div>';
                
                            $count = $count*3;; $i++;
            endforeach;                        
        ?>
    </section><!--menu_right ENDS -->
            
</div><!--supernova_options_page ENDS -->


<noscript>
<style>
    /*Please turn on your javascript to make full use of the options page or refresh the page if you cannot.*/
	#supernova_options_page{                
		display:block; 
	}
</style>
</noscript>

<span class="loader"></span>
<span class="saving_settings"></span>
<?php 	if( isset($_GET['settings-updated']) ) {
            echo '<span class="supernova_saved"></span>';}