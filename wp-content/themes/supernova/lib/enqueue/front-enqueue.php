<?php
/**
 * All front-end files have been loaded only from here
 */
 
class supernova_front_enqueue
{ 
	public function __construct()
    {
		add_action( 'wp_enqueue_scripts', array($this, 'supernova_front_css_enqueue') );
		add_action('wp_print_styles', array($this, 'supernova_load_fonts'));
		add_action( 'wp_enqueue_scripts', array($this, 'supernova_front_script_enqueue') );
		add_action('wp_head', array($this, 'supernova_wp_head'), 1);
	}

    //LOADING CSS
    public function supernova_front_css_enqueue()
    {	
    	global $supernova_options,$supernova_version;
            $file_stauts = get_option('supernova_file_write_status');    
            $old_user = get_option('supernova_old_user_check');
            
            wp_register_style( 'flexslider', SUPERNOVA_ROOT. '/css/flexslider.css', array(), $supernova_version , 'all' ); 
    	    wp_register_style( 'main_style', get_stylesheet_uri(), array(), $supernova_version , 'all' );        
            wp_register_style( 'pink_style', SUPERNOVA_ROOT. '/css/colors/pink.css', array(), $supernova_version , 'all' );
            wp_register_style( 'blue_style', SUPERNOVA_ROOT. '/css/colors/blue.css', array(), $supernova_version , 'all' );
            wp_register_style( 'purple_style', SUPERNOVA_ROOT. '/css/colors/purple.css', array(), $supernova_version , 'all' );
            wp_register_style( 'red_style', SUPERNOVA_ROOT. '/css/colors/red.css', array(), $supernova_version , 'all' );
            wp_register_style( 'black_style', SUPERNOVA_ROOT. '/css/colors/black.css', array(), $supernova_version , 'all' );
            wp_register_style( 'yellow_style', SUPERNOVA_ROOT. '/css/colors/yellow.css', array(), $supernova_version , 'all' );
            wp_register_style( 'brown_style', SUPERNOVA_ROOT. '/css/colors/brown.css', array(), $supernova_version , 'all' );
            wp_register_style( 'green_style', SUPERNOVA_ROOT. '/css/colors/green.css', array(), $supernova_version , 'all' );        
            wp_register_style( 'supernova_custom_styles', SUPERNOVA_DIRECTORY. 'custom-styles.css', array(), $supernova_version  );
            wp_register_style( 'supernova_mediaquery', SUPERNOVA_ROOT. '/css/mediaquery.css', array(), $supernova_version  );
            wp_register_style( 'supernova_mediaquery_mobile', SUPERNOVA_ROOT. '/css/mediaquery-mobile.css', array(), $supernova_version  );
            
            if(is_home() || is_page_template( 'page-templates/slider-temp.php' ) || is_page_template( 'page-templates/slider-nosidebar.php'))
    	       wp_enqueue_style( 'flexslider' );  //Slider flexslider load only on home page
    	
            wp_enqueue_style( 'main_style' ); //Main style should load at last and on every page

            if( isset($supernova_options['color-scheme']) )
            {
                switch ($supernova_options['color-scheme'])
                {
                    case '2':
                    wp_enqueue_style( 'pink_style' );
                    break;case '3':
                    wp_enqueue_style( 'blue_style' );
                    break;case '4':
                    wp_enqueue_style( 'purple_style' );
                    break;case '5':
                    wp_enqueue_style( 'green_style' );
                    break;case '6':
                    wp_enqueue_style( 'brown_style' );
                    break;case '7':
                    wp_enqueue_style( 'red_style' );
                    break;case '8':
                    wp_enqueue_style( 'yellow_style' );
                    break;case '9':
                    wp_enqueue_style( 'black_style' );
                    break;default:                   
                        break;
                }
            }        
            
            if(!supernova_options('no-responsive') && !supernova_options('no-responsive-tablet'))
                wp_enqueue_style( 'supernova_mediaquery' ); //Responsive CSS @since version 1.2.0
            
            if(!supernova_options('no-responsive') && supernova_options('no-responsive-tablet'))
                wp_enqueue_style( 'supernova_mediaquery_mobile' ); //Responsive CSS @since version 1.5.2
            
            if($file_stauts != 'failed' && $old_user == 'no' )
                wp_enqueue_style( 'supernova_custom_styles' ); //Custom CSS @since versoin 1.4.2                
    }

    /*
     * PT Sans Narrow Google Fonts	
     * @package Supernova
     * @since Supenova 1.0.8
    */ 
    public function supernova_load_fonts() {
            //Font doesn't load the site's url is https.
            $font_url = ( substr( site_url(), 0, 8 ) == 'https://') ? 'https://fonts.googleapis.com/css?family=PT+Sans+Narrow:700' : 'http://fonts.googleapis.com/css?family=PT+Sans+Narrow:700';
    		wp_register_style('googleFontsSans', $font_url );
    		wp_enqueue_style( 'googleFontsSans');            
    	}

    //Loading Scripts...	
    public function supernova_front_script_enqueue(){
    	global $supernova_options,$supernova_version;
            $no_responsive = 'no';
            $mobile_responsive = 'no';
            if(supernova_options('no-responsive'))
                $no_responsive = 'no_responsive';
            
            if(supernova_options('no-responsive-tablet'))
                $mobile_responsive = 'no_responsive_tablet';
                
            wp_register_script('supernova_js', SUPERNOVA_ROOT. '/js/main.min.js',array('jquery'),$supernova_version , true);	
            wp_register_script('supenrova_flexslider', SUPERNOVA_ROOT. '/js/jquery.flexslider.js',array('jquery'),$supernova_version , true);
            wp_register_script('supernova_sticky', SUPERNOVA_ROOT. '/js/jquery.sticky.js',array('jquery'),$supernova_version , true);
            
            //Ajax Object
            wp_localize_script( 'supernova_js', 'supernova_ajax_object', 
                    array( 
                        'ajaxurl' => admin_url( 'admin-ajax.php'),
                        'load_more_data' =>  __('Loading', 'Supernova').'|'.__('Sorry no more posts available, please check back later', 'Supernova').'|'
                                            .__('No more posts available', 'Supernova'),
                        'responsiveness' => $no_responsive.'|'.$mobile_responsive
                        )
                               );
            
            if ( is_singular() && get_option( 'thread_comments' ) )
                wp_enqueue_script( 'comment-reply' );//Comments

            wp_enqueue_script('supernova_js'); //Supernova js

            if(!supernova_options('disable-slider') && is_home())
                wp_enqueue_script('supenrova_flexslider'); //Flexslider for home page
            if(is_page_template( 'page-templates/slider-temp.php') || is_page_template( 'page-templates/slider-nosidebar.php'))
                wp_enqueue_script('supenrova_flexslider'); //for flexslider on templates
            if(!supernova_options('disable-nav-effect'))
                wp_enqueue_script("jquery-effects-core"); //For Navigation effect
            if(!supernova_options('sticky-nav') && !supernova_options('disable-top-nav'))
                wp_enqueue_script('supernova_sticky'); //Sticky nav

    }

    // Adding html5 & selectivizr for IE older versions
    public function supernova_wp_head(){	
    	?>
        <!--[if IE]>
        <script src="<?php echo SUPERNOVA_ROOT; ?>/js/html5.js" type="text/javascript"></script>
        <![endif]-->
    	<?php
    }
}
	
new supernova_front_enqueue();
