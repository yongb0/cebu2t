<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta name="viewport" content="width=device-width" />
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="stylesheet" type="text/css" href="http://2thinkerscebu.local/wp-content/themes/jshop/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="http://2thinkerscebu.local/wp-content/themes/jshop/css/bootstrap-theme.min.css">
	<?php wp_get_archives('type=monthly&format=link'); ?>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>




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
										
										<li id="menu-item-169" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-169">
											<a href="http://2thinkerscebu.local/?page_id=168">Edit profile</a>
										</li>
										<li id="menu-item-169" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-169">
											<a href="http://2thinkerscebu.local/wp-login.php?action=logout&redirect_to=http%3A%2F%2F2thinkerscebu.local%2F%3Fpage_id%3D164&_wpnonce=5dc613a0d6">Logout</a>
										</li>
										
										<?php } else {?>
										<li id="menu-item-165" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-165">
											<a href="http://2thinkerscebu.local/?page_id=164">Login</a>
										</li>

										<li id="menu-item-167" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-167">
											<a href="http://2thinkerscebu.local/?page_id=166">Register</a>
										</li>
										<?php } ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color:white;">Welcome <i class="glyphicon glyphicon-user"></i> </a>
                        <ul class="dropdown-menu">
                            <li></li>
                            <li class="divider"></li>
                            <li></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>


<!--- this is start of header jumbotron -->
	<div class="jumbotron" style="height:230px;">
		<div class="container">
		<div class="hdr1">

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
		</div>
	</div>
<!--- this is end of header jumbotron -->
	<div style="height:5px; background-color:orange;margin-top:-30px;">
	</div>

	<div class="breadcrumb">
		<ul class="nav nav-pills">
			<li role="presentation" class="active">
				<a href="http://2thinkerscebu.local/">HOME</a>
			</li>
			<li role="presentation" class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="http://2thinkerscebu.local/?page_id=61" role="button" aria-expanded="false">
					セブ情報 
					<img class="emoji" draggable="false" alt="🎵" src="http://s.w.org/images/core/emoji/72x72/1f3b5.png">
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
		      		<li >
		      			<a href="http://2thinkerscebu.local/?cat=6"> Eat-セブで食べる </a>
		      		</li>
		      		<li>
		      			<a href="http://2thinkerscebu.local/?cat=4"> Enjoy-セブで遊ぶ </a>
		      		</li>
		    	</ul>
			</li>

			<li role="presentation">
				<a href="http://2thinkerscebu.local/">サイト紹介</a>
			</li>

			<li role="presentation">
				<a href="http://2thinkerscebu.local?p=25">”売りー買い”掲示板</a>
			</li>

		  	<li role="presentation" class="dropdown">
		  		<a class="dropdown-toggle" data-toggle="dropdown"  href="http://2thinkerscebu.local/?page_id=47" role="button" aria-expanded="false">
					今日のワンフレーズ
					<span class="caret"></span>
				</a>
		    	<ul class="dropdown-menu" role="menu">
		      		<li>
		      			<a href="http://2thinkerscebu.local/?cat=21"> 英語フレーズ </a>
		      		</li>
		    	</ul>
		  	</li>
		</ul>
	</div>


		<div class="main3" style="">
			<div class="main4">
					
						<ul>
							<li>

							<!-- 	START
									Author :  John Robert Jerodiaz 
									Date Created :  May 20, 2015 
									Title :  Menu link 							-->

								<div class="menu-%e3%83%a1%e3%83%8b%e3%83%a5%e3%83%bc-1-container">
									<ul id="menu-%e3%83%a1%e3%83%8b%e3%83%a5%e3%83%bc-1" class="menu">

										<li class="my" id="menu-item-45" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-45">
											<a href="http://2thinkerscebu.local/">HOME</a>
										</li>

										<li id="menu-item-63" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-63">
											<a href="http://2thinkerscebu.local/?page_id=61">
												セブ情報
												<img class="emoji" draggable="false" alt="🎵" src="http://s.w.org/images/core/emoji/72x72/1f3b5.png">
											</a>
											<ul class="sub-menu">
												<li id="menu-item-66" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-66">
													<a href="http://2thinkerscebu.local/?cat=6"> Eat-セブで食べる </a>
												</li>
												<li id="menu-item-64" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-64">
													<a href="http://2thinkerscebu.local/?cat=4"> Enjoy-セブで遊ぶ </a>
												</li>
												
											</ul>	
										</li>

										<li id="menu-item-46" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-2 current_page_item menu-item-46">
											<a href="http://2thinkerscebu.local/">サイト紹介</a>
										</li>

										<li id="menu-item-89" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-89">
											<a href="http://2thinkerscebu.local?p=25">”売りー買い”掲示板</a>
										</li>


										<li id="menu-item-56" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-56">
											<a href="http://2thinkerscebu.local/?page_id=47">
												今日のワンフレーズ
											</a>
											<ul class="sub-menu">
												<li id="menu-item-119" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-119">
													<a href="http://2thinkerscebu.local/?cat=21"> 英語フレーズ </a>
												</li>
											</ul>
										</li>
									</ul>
								</div>
							<!-- 	END
									Author :  John Robert Jerodiaz 
									Date Created :  May 20, 2015 
									Title :  Menu link 							-->


							 <?php 
							 //Bellow is the original retrieving menu link

							 //wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); 

							 ?> 


							</li>
						</ul>
						 <a id="live-menu" class="responsive-menu" href="#">Menu</a>
					
			</div>
		</div>









<div class="main">
	<div class="content-main">