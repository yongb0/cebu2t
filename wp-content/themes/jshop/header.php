<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="stylesheet" type="text/css" href="http://2thinkerscebu.local/wp-content/themes/jshop/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="http://2thinkerscebu.local/wp-content/themes/jshop/css/bootstrap-theme.min.css">
	<?php wp_get_archives('type=monthly&format=link'); ?>

	<?php wp_head(); ?>
</head>
<body <?php //body_class(); ?> style="background-color:#eee;">




	<nav class="navbar navbar-inverse navbar-fixed-top" >
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" style="color:white" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?>
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php //Condition to view Login File ?>
										<?php if(is_user_logged_in()) { ?>
										<li class="dropdown">
					                        <a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color:white;">Welcome <i class="glyphicon glyphicon-user"></i> </a>
					                        <ul class="dropdown-menu">
					                            <li> jero</li>
					                            <li class="divider"></li>
					                            <li></li>
					                        </ul>
					                    </li>
										<li id="menu-item-169" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-169">
											<a href="http://2thinkerscebu.local/?page_id=168">Edit profile</a>
										</li>
										<li id="menu-item-169" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-169">
											<a href="http://2thinkerscebu.local/wp-login.php?action=logout&redirect_to=http%3A%2F%2F2thinkerscebu.local%2F%3Fpage_id%3D164&_wpnonce=5dc613a0d6">Logout</a>
										</li>
										
										<?php } else {?>
										<li id="menu-item-165" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-165">
											<a href="http://2thinkerscebu.local/?page_id=369">Login</a>
										</li>

										<li id="menu-item-167" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-167">
											<a href="http://2thinkerscebu.local/?page_id=140">Register</a>
										</li>
										<?php } ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>


<!--- this is start of header jumbotron -->
	<div class="jumbotron" style="height:230px;">
		<div class="container">
		<div class="row">
				<div class="col-sm-6" >

							<?php if ( function_exists( 'jetpack_the_site_logo' ) ) jetpack_the_site_logo(); ?>
							<h1 class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
							</h1>
							

							<br>
							<h4 class="site-description"><?php bloginfo( 'description' ); ?></h4>

							
								<div class="sidebar-head3 span2">
									<?php dynamic_sidebar( 'sidebar-head' ); ?>
								</div>

								<div class="sidebar-head4 span2">

									<?php if (class_exists('woocommerce')) :?>
												
											<?php global $woocommerce; ?>
							 
										<?php _e( 'Cart:', 'jshop' ); ?> <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'jshop'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'jshop'), $woocommerce->cart->cart_contents_count);?> <?php echo $woocommerce->cart->get_cart_total(); ?></a>
									<?php endif; ?>	

								</div>
				</div>
				<div class="col-sm-6">
					<img src="http://2thinkerscebu.local/wp-content/themes/jshop/img/cebu.png" class="img-responsive" width="100" height="300"/>
				</div>
			</div>
		</div>
	</div>
<!--- this is end of header jumbotron -->
	<div style="height:5px; background-color:orange;margin-top:-30px;">
	</div>

	<div class="main3">
		<div class="main4">
			<ul>
				<li>
							<?php 
								//Bellow is the original retrieving menu link
								wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); 
							?> 
				</li>
			</ul>
		</div>
	</div>	
	
				




<style>
		li {list-style-type: none;}
		.menu-item-66{
			background-color: blue;
		}
		#menu-item-66{
			color:pink;
			background-color: orange;
		}
</style>




<div class="container">
	<div >
