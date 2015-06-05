<?php
/**
 * Inkness functions and definitions
 *
 * @package Inkness
 */


/**
 * Initialize Options Panel
 */
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once get_template_directory() . '/inc/options-framework.php';
}

if ( ! function_exists( 'inkness_setup' ) ) :

function inkness_setup() {

	load_theme_textdomain( 'inkness', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_image_size('homepage-banner',750,450,true);

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'inkness' ),
	) );

	add_theme_support( 'custom-background', apply_filters( 'inkness_custom_background_args', array(
		'default-color' => 'f7f7f7',
		'default-image' => '',
	) ) );
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	 global $content_width;
	 if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */
		
	add_editor_style();
}
endif; // inkness_setup
add_action( 'after_setup_theme', 'inkness_setup' );

<<<<<<< HEAD
=======
// jacob start

add_action ( 'bbp_theme_before_topic_form_content', 'bbp_extra_fields');
function bbp_extra_fields() {
   $value = get_post_meta( bbp_get_topic_id(), 'bbp_extra_field1', true);
   echo '<label for="price">Price</label><br>';
   echo "<input type='text' name='price' class='form-control' value='".$value."'>";
   $value = get_post_meta( bbp_get_topic_id(), 'bbp_extra_field2', true);
   echo '<br><label for="price">Choice</label><br>';
   echo "<input type='radio' name='choice' value='Buying'> Buying <br>";
   echo "<input type='radio' name='choice' value='Selling'> Selling";
}
>>>>>>> dace43308edafbaaefa97c5be9b9a34315020562


// // jacob start

// add_action ( 'bbp_theme_before_topic_form_content', 'bbp_extra_fields');
// function bbp_extra_fields() {
//    $value = get_post_meta( bbp_get_topic_id(), 'bbp_extra_field1', true);
//    echo '<label for="price">Price</label><br>';
//    echo "<input type='text' name='price' value='".$value."'>";
//    $value = get_post_meta( bbp_get_topic_id(), 'bbp_extra_field2', true);
//    echo '<br><label for="price">Choice</label><br>';
//    echo "<input type='radio' name='choice' value='Buying'> Buying <br>";
//    echo "<input type='radio' name='choice' value='Selling'> Selling";
// }

// // bbp_extra_fields();

// add_action ( 'bbp_new_topic', 'bbp_save_extra_fields', 10, 1 );
// add_action ( 'bbp_edit_topic', 'bbp_save_extra_fields', 10, 1 );

// function bbp_save_extra_fields($topic_id=0) {
// 	if (isset($_POST) && $_POST['price']!='')
// 	update_post_meta( $topic_id, 'price', $_POST['price'] );
// 	if (isset($_POST) && $_POST['choice']!='')
// 	update_post_meta( $topic_id, 'choice', $_POST['choice'] );

// }

// add_action('bbp_template_before_replies_loop', 'bbp_show_extra_fields');

// function bbp_show_extra_fields() {
//   $topic_id = bbp_get_topic_id();
// 	// $topic_id = get_current_user_id();
//   $value1 = get_post_meta( $topic_id, 'price', true);
//   $choice = get_post_meta($topic_id, 'choice', true);
//   echo "<h4>Price: ".$value1."</h4>";
//   echo "<h4>Type: ".$choice."</h4>";
//   // echo the_content();
//   // echo $topic_id;
//   // return $value1;
// }


// function bbp_show_extra_fields1() {
//   $topic_id = bbp_reply_id();
//   $value1 = get_post_meta( $topic_id, '_bbp_author_ip', true);
//   // echo "<h4>Price: ".$value1."</h4><br>";
//   return $value1;
// }


// jacob end





function inkness_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'inkness' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Left', 'inkness' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Center', 'inkness' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Right', 'inkness' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'inkness_widgets_init' );

add_action('optionsframework_custom_scripts', 'inkness_custom_scripts');

function inkness_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>
 
<?php
}

function inkness_scripts() {
	wp_enqueue_style( 'inkness-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,400,700,600' );
	wp_enqueue_style( 'inkness-basic-style', get_stylesheet_uri() );
	if ( (function_exists( 'of_get_option' )) && (of_get_option('sidebar-layout', true) != 1) ) {
		if (of_get_option('sidebar-layout', true) ==  'right') {
			wp_enqueue_style( 'inkness-layout', get_template_directory_uri()."/css/layouts/content-sidebar.css" );
		}
		else {
			wp_enqueue_style( 'inkness-layout', get_template_directory_uri()."/css/layouts/sidebar-content.css" );
		}	
	}
	else {
		wp_enqueue_style( 'inkness-layout', get_template_directory_uri()."/css/layouts/content-sidebar.css" );
	}
			
	wp_enqueue_style( 'inkness-bootstrap-style', get_template_directory_uri()."/css/bootstrap/bootstrap.min.css", array('inkness-layout') );
		
	wp_enqueue_style( 'inkness-main-style', get_template_directory_uri()."/css/skins/main.css", array('inkness-layout','inkness-bootstrap-style') );
	
	wp_enqueue_script( 'inkness-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'inkness-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	if ( (function_exists( 'of_get_option' )) && (of_get_option('slider_enabled') != 0) ) {
		wp_enqueue_style( 'inkness-nivo-slider-default-theme', get_template_directory_uri()."/css/nivo/slider/themes/default/default.css" );
	
		wp_enqueue_style( 'inkness-nivo-slider-style', get_template_directory_uri()."/css/nivo/slider/nivo.css" );
	}	
	
	if ( (function_exists( 'of_get_option' )) && (of_get_option('slider_enabled') != 0) ) {
		wp_enqueue_script( 'inkness-nivo-slider', get_template_directory_uri() . '/js/nivo.slider.js', array('jquery') );
	}
	wp_enqueue_script( 'inkness-superfish', get_template_directory_uri() . '/js/superfish.js', array('jquery','hoverIntent') );	
	
	wp_enqueue_script( 'inkness-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery') );	
	
	wp_enqueue_script( 'inkness-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery') );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'inkness-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'inkness_scripts' );
function inkness_custom_head_codes() {
 if ( (function_exists( 'of_get_option' )) && (of_get_option('style2', true) != 1) ) {
	echo "<style>".of_get_option('style2', true)."</style>";
 }
 if ( (function_exists( 'of_get_option' )) && (of_get_option('slider_enabled') != 0) ) {
	echo "<script>jQuery(window).load(function() { jQuery('#slider').nivoSlider({effect:'fade', pauseTime: 4500}); });</script>";
 }
}	
add_action('wp_head', 'inkness_custom_head_codes');

function inkness_nav_menu_args( $args = '' )
{
    $args['container'] = false;
    return $args;
} // function
add_filter( 'wp_page_menu_args', 'inkness_nav_menu_args' );

function inkness_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
	            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
	            echo '<div class="pagination"><div><ul>';
	            echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
	            foreach ( $page_format as $page ) {
	                    echo "<li>$page</li>";
	            }
	           echo '</ul></div></div>';
	 }
}

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates. Import Widgets
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
