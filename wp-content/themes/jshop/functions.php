<?php
add_action( 'after_setup_theme', 'jshop_setup' );
function jshop_setup() {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(166, 124, TRUE); 
	global $content_width;
	if ( ! isset( $content_width ) )
	$content_width = 960;
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );						// background
	$defaults = array(												// background
		'default-color'          => '',
		'default-image'          => '',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''	);
	add_action( 'wp_enqueue_scripts', 'jshop_frontend' );
	add_editor_style( 'editor-style.css' );
	add_theme_support( 'woocommerce' );
	add_image_size( 'jshop-logo-size', 330, 100, true );
    add_theme_support( 'site-logo', array( 'size' => 'jshop-logo-size' ) );
    load_theme_textdomain( 'jshop', get_template_directory() . '/languages' );}
add_action('wp_enqueue_scripts' , 'jshop_enqueue_resources');function jshop_enqueue_resources() { if ( is_singular() ) wp_enqueue_script( "comment-reply" );}
function register_my_menu() {
  		register_nav_menu('header-menu', __( 'Header Menu', 'jshop' ));
	}
add_action( 'init', 'register_my_menu' );
function jshop_widgets() {
		register_sidebar(		array(
			'id' => 'sidebar-left',
			 	'name' => __( 'sidebar-left', 'jshop' ),
			)		);
		register_sidebar(		array(
			'id' => 'sidebar-head', 
				'name' => __( 'sidebar-head', 'jshop' ),
			)		);
		register_sidebar(		array(
			'id' => 'sidebar-footer1',			
				'name' => __( 'sidebar-footer1', 'jshop' ),
			)		);
		register_sidebar(		array(
			'id' => 'sidebar-footer2',			'name' => __( 'sidebar-footer2', 'jshop' ),
			)		);
		register_sidebar(		array(
			'id' => 'sidebar-footer3',			'name' => __( 'sidebar-footer3', 'jshop' ),
			)		);
		register_sidebar(		array(
			'id' => 'sidebar-footer4',			'name' => __( 'sidebar-footer4', 'jshop' ),
			)		);
		register_sidebar(		array(
			'id' => 'sidebar-footer5',			'name' => __( 'sidebar-footer5', 'jshop' ),
			)		);
}
add_action( 'widgets_init', 'jshop_widgets' );
add_filter('loop_shop_per_page', create_function('$cols', 'return 12;'));
add_filter('loop_shop_columns', 'jshop_loop_columns');
if (!function_exists('jshop_loop_columns')) {
	function jshop_loop_columns() {
		return 3;
	}
}
function woocommerce_output_related_products() {
    $args = array('posts_per_page' => 3, 'columns' => 3,'orderby' => 'rand' );
    woocommerce_related_products( apply_filters( 'woocommerce_output_related_products_args', $args ) );}
function jshop_frontend() {
 	wp_enqueue_style( 'jshop-style', get_stylesheet_uri() );
 }
function jshop_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	if ( $paged >= 3 || $page >= 3 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'jshop' ), max( $paged, $page ) );
	return $title;
}
add_filter( 'wp_title', 'jshop_wp_title', 10, 3 );
add_filter( 'wp_tag_cloud', 'jshop_tag_cloud' );
function jshop_tag_cloud( $tags ){
    return preg_replace(
        "~ style='font-size: (\d+)pt;'~",
        ' class="tag-cloud-size-\10"',
        $tags
    );
}
add_filter('add_to_cart_fragments', 'jshop_fragment');
function jshop_fragment( $fragments ) 
{
    global $woocommerce;
    ob_start(); ?>
    <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'jshop'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'jshop'), $woocommerce->cart->cart_contents_count);?> <?php echo $woocommerce->cart->get_cart_total(); ?></a>
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}
function jshop_menu() {
	add_theme_page('JShop Setup', 'Theme Help', 'edit_theme_options', 'jshop', 'jshop_menu_page');
}
add_action('admin_menu', 'jshop_menu');
function jshop_menu_page() {
echo '
<br>
<center><h1 style="font-size:79px;">' . __( 'Theme JShop free', 'jshop' ) . '</h1></ceter>
<br><br><br>
	<center><h1>' . __( '7 Sidebar for theme JShop', 'jshop' ) . '</h1></ceter>
<br>
<center><img src="' . get_template_directory_uri() . '/images/jshop-sidebar.jpg"></center>
<br><br><br>
<h1><center>' . __( 'Site ', 'jshop' ) . '<a href="http://justpx.com/jshop-free-documentation/">' . __( 'JShop free ', 'jshop' ) . '</a>' . __( ' -  documentation (Logo, favicon, font, ...).', 'jshop' ) . '</center></h1><br><br>
<br><br>
<center><img src="' . get_template_directory_uri() . '/images/pro-vs-free.png"></center><br><br>
<center><b>' . __( 'Localization Ready:', 'jshop' ) . '</b> ' . __( 'Chinese, Czech, Dutch, English, French, German, Greek, Hungarian, Indonesian, Italian, Japanese, Polish, Romana, Russian, Spanish. Add ', 'jshop' ) . '<a href="http://justpx.com/your-language">' . __( 'Your language', 'jshop' ) . '</a>. </center><br/><br/>
<br><br>
<center><h1 style="font-size:79px;">' . __( 'Theme JShop PRO', 'JustCleanShop' ) . '</h1></ceter><br><br>
<h1><center>' . __( ' Page ', 'JustCleanShop' ) . ' <a href="http://justpx.com/product/jshop-pro" target="_blank">' . __( ' JShop PRO ', 'jshop' ) . '</a>' . __( ' - theme, demo, documentation.', 'jshop' ) . '</center></h1><br><br>
<h1><center>' . __( 'JShop PRO width: 1680px - ', 'jshop' ) . '<a href="http://jshop-pro-1680.justpx.com/" target="_blank">' . __( 'Demo', 'jshop' ) . '</a></center></h1><br>
<h1><center>' . __( 'JShop PRO width: 1280px - ', 'jshop' ) . '<a href="http://jshop-pro.justpx.com/" target="_blank">' . __( ' Demo', 'jshop' ) . '</a></center></h1><br>
<h1><center>' . __( 'JShop Bonus width: 980px - ', 'jshop' ) . '<a href="http://jshop-bonus.justpx.com/" target="_blank">' . __( ' Demo ', 'jshop' ) . '</a></center></h1><br><br><br><br>
<center><h1><font color="#dd3f56">10%</font>' . __( ' Discount - Code: ', 'jshop' ) . '<font color="#dd3f56">justpx10</font></h1></ceter>
<br/><br/><br/><br/>
<center><h1>' . __( 'JShop PRO 32 Sidebar Home page 1', 'jshop' ) . '</h1></ceter>
<br/><br/>
<center><img src="' . get_template_directory_uri() . '/images/jshop-sidebar-home-page-1.jpg"></center>
<br/><br/>
	<center><h1>' . __( 'JShop PRO 27 Sidebar Home page 2', 'jshop' ) . '</h1></ceter>
<br/>
<center><img src="' . get_template_directory_uri() . '/images/jshop-sidebar-home-page-2.jpg"></center>
<br/><br/>
	<center><h1>' . __( 'JShop PRO 20 Sidebar page', 'jshop' ) . '</h1></ceter>
<br/>
<center><img src="' . get_template_directory_uri() . '/images/jshop-pro-sidebar.jpg"></center>
<br/><br/>
	<center><h1>' . __( 'Theme JShop Bonus (8 sidebar)', 'jshop' ) . '</h1></ceter>
<br/>
<center><img src="' . get_template_directory_uri() . '/images/jshop-sidebar-bonus.jpg"></center>
<br/><br/>
	<center><h1>' . __( '7 colors for JShop PRO and JShop Bonus', 'jshop' ) . '</h1></ceter>
<br/>
<center><img src="' . get_template_directory_uri() . '/images/color.jpg"></center>
<h1><center>' . __( '7 colors - ', 'jshop' ) . '<a href="http://justpx.com/jshop-pro-color/">' . __( 'Screenshot', 'jshop' ) . '</a></center></h1><br><br><br><br><br><br>
<center><img src="' . get_template_directory_uri() . '/images/jshoppro7.png"></center><br>
<h1><center>' . __( 'Buy theme', 'jshop' ) . '  <a href="http://justpx.com/product/jshop-pro/">' . __( 'JShop PRO', 'jshop' ) . '</a></center></h1><br><br>
';
}
?>