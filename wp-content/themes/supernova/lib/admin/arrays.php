<?php
/*
* This files contains all the default values, and the arrays created for option's pages.
* If you wish to add more fields to the options page you can just add additional arrays here, and it will be added to the options page
* You can add more options from the child theme as well by taking the variable $supernova_options as global and hooking the function in 'supernova_after_theme_setup'
* Make sure that no page name have the same name.
* @pakage Supernova
* Copyright (C) 2013 Sayed Taqui
* 
*/


$supernova_defaults = array();

global $wp_version;

/********************/
    /* GENRAL */
/********************/
$supernova_defaults[] = array(
		'label'		=>	__('Upload Favicon', 'Supernova'),
		'type'		=>	'image-uploader',
		'desc'		=>	__('Favicon is the tiny icon that you see on your browser\'s tab. Either create a 16x16px image or create it online and upload it here.', 'Supernova'),
        'name'		=>	 'favicon',
        'default' 	=>	 '',
		'tab'		=>	__('General', 'Supernova'),
		);

if( $wp_version > 4.0 ){
$supernova_defaults[] = array(
		'label'		=>	__('Logo Position', 'Supernova'),
		'type'		=>	'radio',
		'desc'		=>	__('Decide logo and the header title position', 'Supernova'),
        'labels' 	=>	 array(__('Left', 'Supernova'), __('Center', 'Supernova'), __('Right', 'Supernova')),
        'classes' 	=>	 array('', '', ''),
		'name'		=>	 'logo-position',
        'default' 	=>	 1,
		'tab'		=>	__('General', 'Supernova'),
		);
}

$supernova_defaults[] = array(
		'label'		=>	__('Top Most Navigation', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove the top most navigation', 'Supernova'),					
		'name'		=>	 'disable-top-nav',
        'default' 	=>	 '',
		'tab'		=>	__('General', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Category Navigation', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove categories from header', 'Supernova'),
		'name'		=>	 'disable-categories',
        'default' 	=>	 '',
		'tab'		=>	__('General', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Main Navigation', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove the main navigation which is below header', 'Supernova'),					
		'name'		=>	 'disable-main-nav',
        'default' 	=>	 '',
		'tab'		=>	__('General', 'Supernova'),
		);
		
/********************/
    /* LAYOUT */
/********************/
$supernova_defaults[] = array(
		'label'		=>	__('Layout Width', 'Supernova'),
		'type'		=>	'range-slider',
		'desc'		=>	__('This is the total width of your website\'s layout in pixels', 'Supernova'),
		'name'		=>	 'layout-width',
        'default' 	=>	 '',
		'tab'		=>	__('Layout', 'Supernova'),
		'max'		=>	1320,
		'min'		=>	900,
		'default'	=>	1100,
		);		
		
$supernova_defaults[] = array(
		'label'		=>	__('Content Width', 'Supernova'),
		'type'		=>	'range-slider',
		'desc'		=>	__('Decide the width of the content area (in percentage).', 'Supernova'),
		'name'		=>	 'content-width',
        'default' 	=>	 '',
		'tab'		=>	__('Layout', 'Supernova'),
		'max'		=>	100,
		'min'		=>	5,
		'default'	=>	70,
		);
				
$supernova_defaults[] = array(
		'label'		=>	__('Sidebar Width', 'Supernova'),
		'type'		=>	'range-slider',
		'desc'		=>	__('THE TOTAL OF CONTENT AND SIDEBAR WIDTH SHOULD BE 100%.', 'Supernova'),
		'name'		=>	 'sidebar-width',
        'default' 	=>	 '',
		'tab'		=>	__('Layout', 'Supernova'),
		'max'		=>	100,
		'min'		=>	5,
		'default'	=>	30,
		);
		
$supernova_defaults[] = array(
		'label'			=>	__('Sidebar Position', 'Supernova'),
		'type'			=>	'radio-image',
		'desc'			=>	'',
        'radio-classes' =>	 array('sidebar_left', 'sidebar_right', 'no-sidebar'), 
        'radio-images' 	=>	 array( //Number of images define the loop count
					            SUPERNOVA_ROOT_ADMIN.'images/sidebar-left.png',
					            SUPERNOVA_ROOT_ADMIN.'images/sidebar-right.png', 
					            SUPERNOVA_ROOT_ADMIN.'images/content.png' ),
		'name'			=>	 'sidebar-pos',
        'default' 		=>	 2,
		'tab'			=>	__('Layout', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Responsivness', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('You website would look the same in small screen', 'Supernova'),
		'name'		=>	 'no-responsive',
        'default' 	=>	 '',
		'tab'		=>	__('Layout', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Responsivness for tablet', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Site would look the same on tablets however would be responsive for small phones(less than 321px)', 'Supernova'),
		'name'		=>	 'no-responsive-tablet',
        'default' 	=>	 '',
		'tab'		=>	__('Layout', 'Supernova'),
		);

/********************/
    /* STYLING */
/********************/
$supernova_defaults[] = array(
		'label'		=>	__('Color Scheme', 'Supernova'),
		'type'		=>	'color-scheme',
		'desc'		=>	'',
        'bg-color' 	=>	 array('e64e4b','348CB3','ba89b6','9DB102','6B4A30','7d0e0a','FFDC00','4B4B4D'),
		'name'		=>	 'color-scheme',
        'default' 	=>	 '',
		'tab'		=>	__('Styling', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'			=>	 __('Font Family', 'Supernova').'<br></br>',
		'type'			=>	'select',
		'desc'			=>	__('Will affect the font family of the post content & sidebar', 'Supernova'),
        'options' 		=>	 array(
		                        'Georgia, serif', 
		                        '\'Palatino Linotype\', \'Book Antiqua\', Palatino, serif',
		                        '\'Times New Roman\', Times, serif',
		                        'Arial, Helvetica, sans-serif', 
		                        '\'Arial Black\', Gadget, sans-serif', 
		                        '\'Comic Sans MS\', cursive, sans-serif', 
		                        'Impact, Charcoal, sans-serif', 
		                        '\'Lucida Sans Unicode\', \'Lucida Grande\', sans-serif', 
		                        'Tahoma, Geneva, sans-serif', 
		                        '\'Trebuchet MS\', Helvetica, sans-serif', 
		                        'Verdana, Geneva, sans-serif', 
		                        '\'Courier New\', Courier, monospace', 
		                        '\'Lucida Console\', Monaco, monospace' 
		                    ),
        'default' 		=>	 'Georgia, serif',
        'placeholder' 	=>	 __('Select Font Style', 'Supernova'),
		'name'			=>	 'font-style',
		'tab'			=>	__('Styling', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Footer Background', 'Supernova').'<br></br>',
		'type'		=>	'image-uploader',
		'desc'		=>	__('You can use footer background image or color. Default image url is ', 'Supernova').SUPERNOVA_ROOT.'/images/black.png',
		'name'		=>	 'footer-bg',
        'default' 	=>	 SUPERNOVA_ROOT.'/images/black.png',
		'tab'		=>	__('Styling', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Footer Background Color', 'Supernova').'<br></br>',
		'type'		=>	'color',
		'desc'		=>	 __('To show the background color remove the background image first.', 'Supernova'),
		'name'		=>	 'footer-color',
        'default' 	=>	 '000000',
		'tab'		=>	__('Styling', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Write Custom CSS', 'Supernova').'<br><small>&nbsp;'.__('(No style tag)', 'Supernova').'</small>',
		'type'		=>	'textarea',
		'desc'		=>	__('CSS written here will be applied everywhere on your theme, and loads after style.css, so it will override any existing css property. Also this css will not be lost even after you update supernova theme', 'Supernova'),
		'name'		=>	 'sup_css',
        'default' 	=>	 '',
		'tab'		=>	__('Styling', 'Supernova'),
		);
		
//SUBMENU ~ FONT SIZES
$supernova_defaults[] = array(
		'label'		=>	__('Post Content', 'Supernova'),
		'type'		=>	'range-slider',
		'desc'		=>	'',	
		'name'		=>	 'post-para-size',
		'tab'		=>	__('Font Sizes', 'Supernova'),
        'parent'	=>	 __('Styling', 'Supernova'),
		'max'		=>	60,
		'min'		=>	5,
		'default'	=>	14,
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Post Heading', 'Supernova'),
		'type'		=>	'range-slider',
		'desc'		=>	'',
		'name'		=>	 'post-heading-size',
		'tab'		=>	__('Font Sizes', 'Supernova'),
        'parent'	=>	 __('Styling', 'Supernova'),
		'max'		=>	60,
		'min'		=>	5,
		'default'	=>	25,
		);	
		
$supernova_defaults[] = array(
		'label'		=>	__('Site Heading', 'Supernova'),
		'type'		=>	'range-slider',
		'desc'		=>	'',
		'name'		=>	 'site-heading-size',
		'tab'		=>	__('Font Sizes', 'Supernova'),
        'parent'	=>	 __('Styling', 'Supernova'),
		'max'		=>	80,
		'min'		=>	5,
		'default'	=>	30,
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Site Discription', 'Supernova'),
		'type'		=>	'range-slider',
		'desc'		=>	'',
		'name'		=>	 'site-desc-size',
		'tab'		=>	__('Font Sizes', 'Supernova'),
        'parent'	=>	 __('Styling', 'Supernova'),
		'max'		=>	60,
		'min'		=>	5,
		'default'	=>	14,
		);		
		
$supernova_defaults[] = array(
		'label'		=>	__('Sidebar Heading', 'Supernova'),
		'type'		=>	'range-slider',
		'desc'		=>	'',
		'name'		=>	 'sidebar-heading-size',
		'tab'		=>	__('Font Sizes', 'Supernova'),
        'parent'	=>	 __('Styling', 'Supernova'),
		'max'		=>	60,
		'min'		=>	5,
		'default'	=>	23,
		);

//SUBMENU ~ FONT COLORS
		
$supernova_defaults[] = array(
		'label'		=>	__('Footer Text Color', 'Supernova').'<br></br>',
		'type'		=>	'color',
		'desc'		=>	'',
		'name'		=>	 'footertext-color',
        'default' 	=>	 'CCCCCC',
		'tab'		=>	__('Font Colors', 'Supernova'),
        'parent'	=>	 __('Styling', 'Supernova'),
		);		

$supernova_defaults[] = array(
		'label'		=>	__('Footer Heading Color', 'Supernova').'<br></br>',
		'type'		=>	'color',
		'desc'		=>	'',
		'name'		=>	 'footerheading-color',
        'default' 	=>	 '',
		'tab'		=>	__('Font Colors', 'Supernova'),
        'parent'	=>	 __('Styling', 'Supernova'),
		);		

$supernova_defaults[] = array(
		'label'		=>	__('Post Paragraph', 'Supernova').'<br></br>',
		'type'		=>	'color',
		'desc'		=>	'',
		'name'		=>	 'post-para-color',
        'default' 	=>	 '000000',
		'tab'		=>	__('Font Colors', 'Supernova'),
        'parent'	=>	 __('Styling', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Post Heading', 'Supernova').'<br></br>',
		'type'		=>	'color',
		'desc'		=>	'',
		'name'		=>	 'post-heading-color',
        'default' 	=>	 '525252',
		'tab'		=>	__('Font Colors', 'Supernova'),
        'parent'	=>	 __('Styling', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Sidebar Heading', 'Supernova').'<br></br>',
		'type'		=>	'color',
		'desc'		=>	'',
		'name'		=>	 'sidebar-heading-color',
        'default' 	=>	 '525252',
		'tab'		=>	__('Font Colors', 'Supernova'),
        'parent'	=>	 __('Styling', 'Supernova'),
		);

//SUBMENU ~ EXTRA STYLES
$supernova_defaults[] = array(
		'label'		=>	__('Capitalization in Navigation', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	 __('Will make the main navagation lower case', 'Supernova'),
		'name'		=>	 'nav-capt',
        'default' 	=>	 '',
		'tab'		=>	__('Extra Styles', 'Supernova'),
        'parent'	=>	 __('Styling', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Capitalization in Sidebar', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	 __('Will make the main sidebar and footer heading lower case', 'Supernova'),
		'name'		=>	 'sidebar-capt',
        'default' 	=>	 '',
		'tab'		=>	__('Extra Styles', 'Supernova'),
        'parent'	=>	 __('Styling', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Capitalization in Heading', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	 __('Will make the main sidebar and footer heading lower case', 'Supernova'),
		'name'		=>	 'heading-capt',
        'default' 	=>	 '',
		'tab'		=>	__('Extra Styles', 'Supernova'),
        'parent'	=>	 __('Styling', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('V border in Navigation', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	 __('Will remove the v border from navigation.', 'Supernova'),
		'name'		=>	 'vborder-nav',
        'default' 	=>	 '',
		'tab'		=>	__('Extra Styles', 'Supernova'),
        'parent'	=>	 __('Styling', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('V border in Sidebar', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	 __('Will remove the v border from sidebar & footer.', 'Supernova'),
		'name'		=>	 'vborder-sidebar',
        'default' 	=>	 '',
		'tab'		=>	__('Extra Styles', 'Supernova'),
        'parent'	=>	 __('Styling', 'Supernova'),
		);


/********************/
    /* SLIDER */
/********************/

$supernova_defaults[] = array(		
		'type'		=>	'message',
		'message'		=>	 __('Please do not upload heavy images which increase your page load time, and use the exact size so the images do not strech nor do they affect your page load time. ', 'Supernova').'<a href="'.site_url().'/?slidesize" target="_blank"><strong>'.__('Click here', 'Supernova').'</strong></a>'.__(' to know the correct size of your slider images.<br>', 'Supernova').'<span><strong>'.__('Default : 735 X 300px','Supernova').'</strong></span><br><span><strong>'.__('Size : Around 50kb.', 'Supernova').'</strong></span><br><span>'.__('Its recommended to use online tools like ', 'Supernova').'<a href="http://jpeg-optimizer.com/" target="_blank">http://jpeg-optimizer.com/</a>'.__(' to compress jpeg and ', 'Supernova').'<a href="http://tinypng.org/" target="_blank">http://tinypng.org/</a>'. __(' for compressing png images or use WP Smush.it Plugin and make your site load faster.', 'Supernova').'</span>',
        'class' 		=>	 'sup-slider-message',
		'tab'		=>	__('Slider', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Slide One', 'Supernova'),
		'type'		=>	'slider',
		'desc'		=>	__('Choose Post + Image OR just post which already has featured image.Click', 'Supernova').'<a href="'.site_url().'?slidesize" target="_blank"> <strong>HERE</strong></a>'.__(' to know the SIZE of the slider Image', 'Supernova'),
		'name'		=>	 'fat1',
		'name2'		=>	'slider1',
		'placeholder'		=>	'leave emtpy to show featured image',
        'default' 	=>	 SUPERNOVA_ROOT.'/images/key.jpg',
		'tab'		=>	__('Slider', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Slide Two', 'Supernova'),
		'type'		=>	'slider',
		'desc'		=>	__('Choose Post + Image OR just post which already has featured image.Click', 'Supernova').'<a href="'.site_url().'?slidesize" target="_blank"> <strong>HERE</strong></a>'.__(' to know the SIZE of the slider Image', 'Supernova'),
		'name'		=>	 'fat2',
		'name2'		=>	'slider2',
		'placeholder'		=>	'leave emtpy to show featured image',
        'default' 	=>	 SUPERNOVA_ROOT.'/images/statue.jpg',
		'tab'		=>	__('Slider', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Slide Three', 'Supernova'),
		'type'		=>	'slider',
		'desc'		=>	__('Choose Post + Image OR just post which already has featured image.Click', 'Supernova').'<a href="'.site_url().'?slidesize" target="_blank"> <strong>HERE</strong></a>'.__(' to know the SIZE of the slider Image', 'Supernova'),
		'name'		=>	 'fat3',
		'name2'		=>	'slider3',
		'placeholder'		=>	'leave emtpy to show featured image',
        'default' 	=>	 '',
		'tab'		=>	__('Slider', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Slide Four', 'Supernova'),
		'type'		=>	'slider',
		'desc'		=>	__('Choose Post + Image OR just post which already has featured image.Click', 'Supernova').'<a href="'.site_url().'?slidesize" target="_blank"> <strong>HERE</strong></a>'.__(' to know the SIZE of the slider Image', 'Supernova'),
		'name'		=>	 'fat4',
		'name2'		=>	'slider4',
		'placeholder'		=>	'leave emtpy to show featured image',
        'default' 	=>	 '',
		'tab'		=>	__('Slider', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Slide Five', 'Supernova'),
		'type'		=>	'slider',
		'desc'		=>	__('Choose Post + Image OR just post which already has featured image.Click', 'Supernova').'<a href="'.site_url().'?slidesize" target="_blank"> <strong>HERE</strong></a>'.__('to know the SIZE of the slider Image', 'Supernova'),
		'name'		=>	 'fat5',
		'name2'		=>	'slider5',
		'placeholder'		=>	'leave emtpy to show featured image',
        'default' 	=>	 '',
		'tab'		=>	__('Slider', 'Supernova'),
		);	

$supernova_defaults[] = array(
		'label'		=>	__('Slide Six', 'Supernova'),
		'type'		=>	'slider',
		'desc'		=>	__('Choose Post + Image OR just post which already has featured image.Click', 'Supernova').'<a href="'.site_url().'?slidesize" target="_blank"> <strong>HERE</strong></a>'.__('to know the SIZE of the slider Image', 'Supernova'),
		'name'		=>	 'fat6',
		'name2'		=>	'slider6',
		'placeholder'		=>	'leave emtpy to show featured image',
        'default' 	=>	 '',
		'tab'		=>	__('Slider', 'Supernova'),
		);	

$supernova_defaults[] = array(
		'label'		=>	__('Slide Seven', 'Supernova'),
		'type'		=>	'slider',
		'desc'		=>	__('Choose Post + Image OR just post which already has featured image.Click', 'Supernova').'<a href="'.site_url().'?slidesize" target="_blank"> <strong>HERE</strong></a>'.__('to know the SIZE of the slider Image', 'Supernova'),
		'name'		=>	 'fat7',
		'name2'		=>	'slider7',
		'placeholder'		=>	'leave emtpy to show featured image',
        'default' 	=>	 '',
		'tab'		=>	__('Slider', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Slide Eight', 'Supernova'),
		'type'		=>	'slider',
		'desc'		=>	__('Choose Post + Image OR just post which already has featured image.Click', 'Supernova').'<a href="'.site_url().'?slidesize" target="_blank"><strong>HERE</strong></a>'.__('to know the SIZE of the slider Image', 'Supernova'),
		'name'		=>	 'fat8',
		'name2'		=>	'slider8',
		'placeholder'		=>	'leave emtpy to show featured image',
        'default' 	=>	 '',
		'tab'		=>	__('Slider', 'Supernova'),
		);	

// Slider SUBMENU ~ Settings
$supernova_defaults[] = array(
		'label'		=>	__('Show Slider', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove slider from the home page(saves 18Kb)', 'Supernova'),
		'name'		=>	 'disable-slider',								
		'tab'		=>	__('Slider Settings', 'Supernova'),
        'parent' 	=>	 __('Slider', 'Supernova'),
        'default' 	=>	 '',                
		);

$supernova_defaults[] = array(
		'label'		=>	__('Slide Effect', 'Supernova').'<br></br>',
		'type'		=>	'select',
		'desc'		=>	__('Will change slider effect', 'Supernova'),
		'name'		=>	 'fade-slider',
        'options' 	=>	 array('slide', 'fade'),
        'placeholder' 		=>	 __('select slide effect', 'Supernova'),
        'default' 	=>	 'slide',
		'tab'		=>	__('Slider Settings', 'Supernova'),
        'parent' 	=>	 __('Slider', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Slides From?', 'Supernova'),
		'type'		=>	'radio',
		'desc'		=>	__('If turned off, you will be able to select pages in place of posts', 'Supernova'),
        'labels' 	=>	 array(__('Posts', 'Supernova'), __('Pages', 'Supernova')),
        'classes' 		=>	 array('', '', ''),
		'name'		=>	 'slider-from-page',
        'default' 	=>	 1,
		'tab'		=>	__('Slider Settings', 'Supernova'),
        'parent' 	=>	 __('Slider', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Automate Slides From?', 'Supernova'),
		'type'		=>	'radio',
		'desc'		=>	__('Will pick up posts from whatever has been selected here', 'Supernova'),
        'labels' 	=>	 array(__('Sticky Posts', 'Supernova'), __('Recent Posts', 'Supernova'), __('Popular Posts', 'Supernova'), __('Recommended Posts', 'Supernova'), __('Let me Select', 'Supernova')),
		'name'		=>	 'automate-slides',
        'default' 	=>	 5,
		'tab'		=>	__('Slider Settings', 'Supernova'),
        'parent' 	=>	 __('Slider', 'Supernova'),
		);


$supernova_defaults[] = array(
		'label'		=>	__('Below Heading', 'Supernova'),
		'type'		=>	'radio',
		'desc'		=>	__('Will change Slider Post Excerpt', 'Supernova'),
		'labels' 	=>	 array(__('Show Date', 'Supernova'), __('Show Excerpt', 'Supernova'), __('Just Heading', 'Supernova')),
		'classes' 		=>	 array('actualcount', 'oncomments', ''),
		'name'		=>	 'slider-post-excerpt',
		'default' 	=>	 1,
		'tab'		=>	__('Slider Settings', 'Supernova'),
		'parent' 	=>	 __('Slider', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Excerpt Length', 'Supernova'),
		'type'		=>	'range-slider',
		'desc'		=>	 '',
		'name'		=>	 'slider-excerpt-length',
		'default' 	=>	 '',
		'tab'		=>	__('Slider Settings', 'Supernova'),
                'parent' 	=>	 __('Slider', 'Supernova'),
		'max'		=>	 150,
		'min'		=>	 5,
		'default'	=>	 32,
		);

$supernova_defaults[] = array(
		'label'		=>	__('Heading Length', 'Supernova'),
		'type'		=>	'range-slider',
		'desc'		=>	 '',
		'name'		=>	 'slider-heading-length',
		'default' 	=>	 '',
		'tab'		=>	__('Slider Settings', 'Supernova'),
		'parent' 	=>	 __('Slider', 'Supernova'),
		'max'		=>	 250,
		'min'		=>	 5,
		'default'	=>	 48,
		);


/********************/
    /* SOCIAL */
/********************/
$supernova_defaults[] = array(
		'label'		=>	'Facebook',
		'type'		=>	'links',
		'desc'		=>	__('Add Link to Show Icon', 'Supernova'),
		'name'		=>	 'facebook-link',
		'image'		=>	 SUPERNOVA_ROOT_ADMIN.'images/facebook.gif',
		'placeholder'		=>	'http://facebook.com/yourfanpage',
		'default' 	=>	 'http://facebook.com',
		'tab'		=>	__('Social', 'Supernova'),
		);	

$supernova_defaults[] = array(
		'label'		=>	'Twitter',
		'type'		=>	'links',
		'desc'		=>	__('Add Link to Show Icon', 'Supernova'),
		'name'		=>	 'twitter-link',
		'image'		=>	 SUPERNOVA_ROOT_ADMIN.'images/twitter.gif',
		'placeholder'		=>	'http://twitter.com',
		'default' 	=>	 'http://twitter.com',
		'tab'		=>	__('Social', 'Supernova'),
		);	

$supernova_defaults[] = array(
		'label'		=>	'Goolge +1',
		'type'		=>	'links',
		'desc'		=>	__('Add Link to Show Icon', 'Supernova'),
		'name'		=>	 'google-link',
		'image'		=>	 SUPERNOVA_ROOT_ADMIN.'images/google_plus.gif',
		'placeholder'		=>	'https://plus.google.com/',
		'default' 	=>	 'https://plus.google.com/',
		'tab'		=>	__('Social', 'Supernova'),
		);
					
$supernova_defaults[] = array(
		'label'		=>	'RSS',
		'type'		=>	'links',
		'desc'		=>	__('Add Link to Show Icon', 'Supernova'),
		'name'		=>	 'rss-link',
		'image'		=>	 SUPERNOVA_ROOT_ADMIN.'images/rss.gif',
		'placeholder'		=>	'http://rss.com',
		'default' 	=>	 'http://rss.com',
		'tab'		=>	__('Social', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	'You Tube',
		'type'		=>	'links',
		'desc'		=>	__('Add Link to Show Icon', 'Supernova'),
		'name'		=>	 'youtube-link',
		'image'		=>	 SUPERNOVA_ROOT_ADMIN.'images/youtube.gif',
		'placeholder'		=>	'',
		'default' 	=>	 'http://youtube.com',
		'tab'		=>	__('Social', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	'Linkedin',
		'type'		=>	'links',
		'desc'		=>	__('Add Link to Show Icon', 'Supernova'),
		'name'		=>	 'linkedin-link',
		'image'		=>	 SUPERNOVA_ROOT_ADMIN.'images/linkedin.gif',
		'placeholder'		=>	'',
		'default' 	=>	 '',
		'tab'		=>	__('Social', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Icon Color', 'Supernova').'<br></br>',
		'type'		=>	'radio-image',
		'desc'		=>	__('Will change Icon colors, you would need it if you use a light background color for footer', 'Supernova'),
		'radio-classes' 		=>	 array('scheme_two', 'scheme_two'), 
		'radio-images' 		=>	 array( //Number of images define the loop count
                    SUPERNOVA_ROOT_ADMIN.'images/facebook-icon-off.png',
                    SUPERNOVA_ROOT_ADMIN.'images/facebook-icon.png'),
		'name'		=>	 'icon-color',
		'default' 	=>	 1,
		'tab'		=>	__('Icon Colors', 'Supernova'),
                'parent'	=>	__('Social', 'Supernova'),
		);


/********************/
    /* ADVANCED */
/********************/
$supernova_defaults[] = array(
		'label'		=>	__('Footer Text', 'Supernova'),
		'type'		=>	'text',
		'desc'		=>	__('Will replace the footer text', 'Supernova'),
		'image'		=>	'arrow.png',
		'name'		=>	 'footer-text',
		'placeholder'		=>	 'Copyright text',
		'default' 	=>	 supernova_copyright_custom_date().get_bloginfo('name'),
		'tab'		=>	__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Latest Blog Text', 'Supernova'),
		'type'		=>	'text',
		'desc'		=>	__('Changes latest blog text on the home page. To Translate this text emtpy this field and then translate it from translation file.', 'Supernova'),
		'image'		=>	'arrow.png',
		'name'		=>	 'latest-blog',
		'placeholder'		=>	 'Latest Blog',
		'default' 	=>	 __('Latest Blogs','Supernova'),
		'tab'		=>	__('Popular/Recommended', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Popular Text', 'Supernova'),
		'type'		=>	'text',
		'desc'		=>	__('Changes popular text on the home page. To Translate this text emtpy this field and then translate it from translation file.', 'Supernova'),
		'image'		=>	'arrow.png',
		'name'		=>	 'popular-text',
		'placeholder'		=>	 'Will replace the popular text',
		'default' 	=>	 __('Popular Posts', 'Supernova'),
		'tab'		=>	__('Popular/Recommended', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Recommended Text', 'Supernova'),
		'type'		=>	'text',
		'desc'		=>	__('Changes recommended text on the home page. To Translate this text emtpy this field and then translate it from translation file.', 'Supernova'),
		'image'		=>	'arrow.png',
		'name'		=>	 'rec-text',
		'placeholder'		=>	 'Will replace the recommended text',
		'default' 	=>	 __('Recommended', 'Supernova'),
		'tab'		=>	__('Popular/Recommended', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Loader Text', 'Supernova'),
		'type'		=>	'text',
		'desc'		=>	__('changes loader button text', 'Supernova'),
		'image'		=>	'arrow.png',
		'name'		=>	 'loader-text',
		'placeholder'		=>	 'Will replace the loader text',
		'default' 	=>	 __('Show More', 'Supernova'),
		'tab'		=>	__('Popular/Recommended', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Popular Posts Depend on', 'Supernova'),
		'type'		=>	'radio',
		'desc'		=>	__('ACTUAL COUNT: This is default. Popular posts are shown depending on the number of visits on each posts, most popular first(i.e. in descending order). NUMBER OF COMMENTS: The popular posts would not be calculated on the actual visits, instead the posts which has the most comments would get precedence. If you use some caching plugin, its possible that the theme is not able to capture the actual counts based on visits, so you can still show popular posts depending on the number of comments. LET ME SELECT: Once this option is selected you would have the freedom to choose the popular posts by yourself. As you select this, one more option would appear right below the recommended post in each post editor. This option can be also be usefull if you want to name it something else like editor\'s pick and show what you want ', 'Supernova'),
		'labels' 	=>	 array(__('Actual Count', 'Supernova'), __('Number of Comments', 'Supernova'), __('Let me select', 'Supernova')),
		'classes' 		=>	 array('actualcount', 'oncomments', 'letmeselect_label'),
		'name'		=>	 'poplular-pos-dep',
		'default' 	=>	 1,
		'tab'		=>	__('Popular/Recommended', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Ajax Post Loader', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove ajax post loader from pagination', 'Supernova'),
		'name'		=>	 'ajax-postloader',
		'default' 	=>	 '',
		'tab'		=>	__('Popular/Recommended', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Popular Posts', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove popular posts tab from home page', 'Supernova'),
		'name'		=>	 'popular-tab',
		'default' 	=>	 '',
		'tab'		=>	__('Popular/Recommended', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Recommended Posts', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove recommended posts tab from home page', 'Supernova'),
		'name'		=>	 'rec-tab',
		'default' 	=>	 '',
		'tab'		=>	__('Popular/Recommended', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Sidebar on Home Page', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will make the home page full width and enlarge the slider', 'Supernova'),
		'name'		=>	 'nosidebar-home',
		'default' 	=>	 '',
		'tab'		=>	__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Sticky Navigation', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove stick effect(saves 3Kb)', 'Supernova'),					
		'name'		=>	 'sticky-nav',
		'default' 	=>	 '',
		'tab'		=>	__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Dropdown Effect', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Removes the navigation dropdown effect and arrows(saves 14Kb)', 'Supernova'),					
		'name'		=>	 'disable-nav-effect',
		'default' 	=>	 '',
		'tab'		=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Manage Meta', 'Supernova'),
		'type'		=>	'select-sortable',
		'desc'		=>	__('Manage meta shown below posts', 'Supernova'),
		'name'		=>	 'meta-sorting',
		'default' 	=>	 'Author, Date, Comment',
		'tab'		=>	__('Post Settings', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('All Meta', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove all meta from the post', 'Supernova'),
		'name'		=>	 'disable-meta',
		'default' 	=>	 '',
		'tab'		=>	__('Post Settings', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('In Post Listing', 'Supernova'),
		'type'		=>	'radio',
		'desc'		=>	__('Will show full content inplace of excerpt', 'Supernova'),
		'labels' 	=>	 array(__('Show Excerpt', 'Supernova'), __('Show Full Content', 'Supernova')),
		'name'		=>	 'full-content',
		'default' 	=>	 1,
		'tab'		=>	__('Post Settings', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Excerpt Length', 'Supernova'),
		'type'		=>	'range-slider',
		'desc'		=>	 '',
		'name'		=>	 'post-excerpt-length',                
		'default'	=>	 55,
		'tab'		=>	__('Post Settings', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		'max'		=>	 450,
		'min'		=>	 5,		
		);

$supernova_defaults[] = array(
		'label'		=>	__('List Thumbnail Width', 'Supernova'),
		'type'		=>	'range-slider',
		'desc'		=>	 '',
		'name'		=>	 'list-thumbnail-width',                
		'default'	=>	 20,
		'tab'		=>	__('Post Settings', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		'max'		=>	 100,
		'min'		=>	 5,		
		);

$supernova_defaults[] = array(
		'label'		=>	__('List Thumbnail Height', 'Supernova'),
		'type'		=>	'range-slider',
		'desc'		=>	 '',
		'name'		=>	 'list-thumbnail-height',                
		'default'	=>	 120,
		'tab'		=>	__('Post Settings', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		'max'		=>	 650,
		'min'		=>	 5,		
		);
	
$supernova_defaults[] = array(
		'label'		=>	__('Search In Top Navigation', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove search box from the top most navigation', 'Supernova'),
		'name'		=>	 'disable-top-search',
		'default' 	=>	 '',
		'tab'		=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Search In Main Navigation', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove search box from main navigation', 'Supernova'),
		'name'		=>	 'disable-search',
		'default' 	=>	 '',
		'tab'		=>	__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Back to Top', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove back to top from the bottom right', 'Supernova'),
		'name'		=>	 'disable-back-to-top',
		'default' 	=>	 '',
		'tab'		=>	__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Pagination', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove theme\'s default pagination so you can use some plugin you like', 'Supernova'),
		'name'		=>	 'disable-pagination',
		'default' 	=>	 '',
		'tab'		=>	__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Breadcrumb', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove breadcrumb from your theme, if you use SEO by Yoast Plugin, the yoast breadcrumb replaces it by itself.', 'Supernova'),
		'name'		=>	 'disable-breadcrumb',
		'default' 	=>	 '',
		'tab'		=>	__('Article Page', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Font Resizer', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove font resizer from each single post', 'Supernova'),
		'name'		=>	 'disable-resizer',
		'default' 	=>	 '',
		'tab'		=>	__('Article Page', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Comments In Pages', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove comments only from pages', 'Supernova'),
		'name'		=>	 'page-comment',
		'default' 	=>	 '',
		'tab'		=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Comments In Posts', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove comments only from posts', 'Supernova'),
		'name'		=>	 'post-comment',
		'default' 	=>	 '',
		'tab'		=>	__('Article Page', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Remove Author Box', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove author info box from each single post', 'Supernova'),					
		'name'		=>	 'disable-author-box',
		'default' 	=>	 '',
		'tab'		=>	__('Article Page', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);


$supernova_defaults[] = array(
		'label'		=>	__('Header Script', 'Supernova'),
		'type'		=>	'textarea',
		'desc'		=>	__('The script entered here will go to the head section of you theme, do not use script tag', 'Supernova'),
		'name'		=>	 'header-script',
		'default' 	=>	 '',
		'tab'		=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Default', 'Supernova'),
		'type'		=>	'image-uploader',
		'desc'		=>	__('If you dont have a thumbnail for any post , this thumbnail will be used.', 'Supernova'),		
		'name'		=>	 'default-thumb',
		'default' 	=>	 SUPERNOVA_ROOT.'/images/default.png',
		'tab'		=>	__('Featured Image', 'Supernova'),
        'parent'	=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Show In Post Listing', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove thumbnails from post listing including home page', 'Supernova'),
		'name'		=>	 'thumbin-listing',
        'default' 	=>	 '',
		'tab'		=>	__('Featured Image', 'Supernova'),
        'parent'	=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Show On Posts', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove featured image from single posts however featured image will show as thumbnail in post listing (if you want to remove featured image only from some pages use CSS instead, use <small> .single .supernova_thumb{display:none} </small> for each page)', 'Supernova'),
		'name'		=>	 'no-single-featured',
        'default' 	=>	 '',
        'tab'		=>	__('Featured Image', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Show On Pages', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will remove featured image from all pages . Use css <small> .page .supernova_thumb{display:none} </small> for individual pages if you want)', 'Supernova'),
		'name'		=>	 'no-page-featured',
        'default' 	=>	 '',
        'tab'		=>	__('Featured Image', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);

$supernova_defaults[] = array(
		'label'		=>	__('Automate Featured Image', 'Supernova'),
		'type'		=>	'checkbox',
		'desc'		=>	__('Will stop picking up the featured images from each post automatically', 'Supernova'),
		'name'		=>	 'auto-featured',
        'default' 	=>	 '',
        'tab'		=>	__('Featured Image', 'Supernova'),
		'parent'	=>	__('Advanced', 'Supernova'),
		);

/********************/
    /* MANAGE ADS */
/********************/
$supernova_defaults[] = array(
		'label'		=>	__('Header Ad', 'Supernova'),
		'type'		=>	'textarea',
		'desc'		=>	__('Drop your ad code here and the ad will show in the header next to logo', 'Supernova'),
		'name'		=>	 'header-ad',
        'default' 	=>	 '',
		'tab'		=>	__('Manage Ads', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Below Navigation', 'Supernova'),
		'type'		=>	'textarea',
		'desc'		=>	__('Ad will show below navigation, above slider', 'Supernova'),
		'name'		=>	 'belownav-ad',
        'default' 	=>	 '',
		'tab'		=>	__('Manage Ads', 'Supernova'),
		);		
		
$supernova_defaults[] = array(
		'label'		=>	__('Above Posts', 'Supernova'),
		'type'		=>	'textarea',
		'desc'		=>	__('Ad will show right above the posts on home page, below slider', 'Supernova'),
		'name'		=>	 'above-posts-ad',
        'default' 	=>	 '',
		'tab'		=>	__('Manage Ads', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Below Posts', 'Supernova'),
		'type'		=>	'textarea',
		'desc'		=>	__('Ad will show below the posts', 'Supernova'),
		'name'		=>	 'below-posts-ad',
        'default' 	=>	 '',
		'tab'		=>	__('Manage Ads', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Above Footer', 'Supernova'),
		'type'		=>	'textarea',
		'desc'		=>	__('Ad will show right above the footer where content ends', 'Supernova'),
		'name'		=>	 'abovefooter-ad',
        'default' 	=>	 '',
		'tab'		=>	__('Manage Ads', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Above Single Post', 'Supernova'),
		'type'		=>	'textarea',
		'desc'		=>	__('Ad will show right above the single post', 'Supernova'),
		'name'		=>	 'abovesinglepost-ad',
        'default' 	=>	 '',
		'tab'		=>	__('Manage Ads', 'Supernova'),
		);
		
$supernova_defaults[] = array(
		'label'		=>	__('Below Single Post', 'Supernova'),
		'type'		=>	'textarea',
		'desc'		=>	__('Ad will show below single post', 'Supernova'),
		'name'		=>	 'belowsinglepost-ad',
        'default' 	=>	 '',
		'tab'		=>	__('Manage Ads', 'Supernova'),
		);
		

/********************/
    /* SUPPORT */
/********************/
$supernova_defaults[] = array(
		'label'		=>	__('Support', 'Supernova'),
		'type'		=>	'support',		
        'default' 	=>	 '',
		'tab'		=>	__('Support', 'Supernova'),
		);




//Creating default array for passing through
$supernova_defaults_values = array();
if($supernova_defaults){
    foreach($supernova_defaults as $value){
        
        $value_id       = (isset($value['name']) && $value['name']) ? $value['name'] : '';
        $value_id2      = (isset($value['name2']) && $value['name2']) ? $value['name2'] : '';
        $value_default  = (isset($value['default']) && $value['default']) ? $value['default'] : '';
        
        $type = (isset($value['type']) && $value['type']) ? $value['type'] : '';
            if($type != 'slider'){ //Because we had the thumb url in id2
            $supernova_defaults_values[$value_id] = $value_default;
            }else{
            $supernova_defaults_values[$value_id2] = $value_default; //The thumbnail
            $supernova_defaults_values[$value_id] = ''; //post id
            }
    }
}

//Array for validating links
$supernova_link_array = array();
if($supernova_defaults){
    foreach($supernova_defaults as $value){
        $type = (isset($value['type']) && $value['type']) ? $value['type'] : '';
        $id = (isset($value['name']) && $value['name']) ? $value['name'] : '';
        if($type == 'links')
        $supernova_link_array[] = $id;
    }
}

//Array for validating checkboxes
$supernova_checkbox_array = array();
if($supernova_defaults){
    foreach($supernova_defaults as $value){
        $type = (isset($value['type']) && $value['type']) ? $value['type'] : '';
        $id = (isset($value['name']) && $value['name']) ? $value['name'] : '';
        if($type == 'checkbox')
        $supernova_checkbox_array[] = $id;
    }
}

//Array for validating range slider
$supernova_numbers_array = array();
if($supernova_defaults){
    foreach($supernova_defaults as $value){
        $type = (isset($value['type']) && $value['type']) ? $value['type'] : '';
        $id = (isset($value['name']) && $value['name']) ? $value['name'] : '';
        if($type == 'range-slider')
        $supernova_numbers_array[] = $id;
    }
}

//Array for validating color Values
$supernova_text_array = array();
if($supernova_defaults){
    foreach($supernova_defaults as $value){
        $type = (isset($value['type']) && $value['type']) ? $value['type'] : '';
        $id = (isset($value['name']) && $value['name']) ? $value['name'] : '';
        if($type == 'color')
        $supernova_text_array[] = $id;        
    }
}