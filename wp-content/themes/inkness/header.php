<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Inkness
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> style="margin:0px !important;">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.0/isotope.pkgd.min.js"></script>
<style>
	.grid {
  max-width: 1200px;
}

/* clear fix */
.grid:after {
  content: '';
  display: block;
  clear: both;
}

/* ---- .grid-item ---- */

.grid-item {
  float: left;
}	
</style>
</head>

<body <?php body_class(); ?>>
<div id="parallax-bg"></div>
<div id="page" class="hfeed site">
	<?php do_action( 'inkness_before' ); ?>
	<div id="header-top">
		<header id="masthead" class="site-header row container" role="banner">
			<div class="site-branding col-md-6 col-xs-12">
			<?php if((of_get_option('logo', true) != "") && (of_get_option('logo', true) != 1) ) { ?>
				<h1 class="site-title logo-container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php
				echo "<img class='main_logo' src='".of_get_option('logo', true)."' title='".esc_attr(get_bloginfo( 'name','display' ) )."'></a></h1>";	
				}
			else { ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1> 
			<?php	
			}
			?>
			</div>	
			
			<div id="social-icons" class="col-md-5 col-xs-12">


<div style="color:white">
<?php  if (is_user_logged_in()){
		global $current_user; get_currentuserinfo();
		echo('Welcome, ' . $current_user->user_login . ' | ');
	} else {
		echo "Welcome, Visitor | ";
	};
?>
</div>

<?php if(is_user_logged_in()) { ?>
	<a href="<?php echo get_site_url(); ?>/?page_id=193">Edit Profile</a> 
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="UPB-Button" title="Logout" href="<?php echo wp_logout_url( $redirect ); ?>">Logout</a>
<?php } else { ?>
	<a href="<?php echo get_site_url(); ?>/login-3">Login</a> 
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="<?php echo get_site_url(); ?>/register">Register</a>
<?php } ?>

	

			    <?php if ( of_get_option('facebook', true) != "") { ?>
				 <a target="_blank" href="<?php echo esc_url(of_get_option('facebook', true)); ?>" title="Facebook" ><i class="social-icon fa fa-facebook-square"></i></a>
	             <?php } ?>
	            <?php if ( of_get_option('twitter', true) != "") { ?>
				 <a target="_blank" href="<?php echo esc_url("http://twitter.com/".of_get_option('twitter', true)); ?>" title="Twitter" ><i class="social-icon fa fa-twitter-square"></i></a>
	             <?php } ?>
	             <?php if ( of_get_option('google', true) != "") { ?>
				 <a target="_blank" href="<?php echo esc_url(of_get_option('google', true)); ?>" title="Google Plus" ><i class="social-icon fa fa-google-plus-square"></i></a>
	             <?php } ?>
	             <?php if ( of_get_option('feedburner', true) != "") { ?>
				 <a target="_blank" href="<?php echo esc_url(of_get_option('feedburner', true)); ?>" title="RSS Feeds" ><i class="social-icon fa fa-rss-square"></i></a>
	             <?php } ?>
	             <?php if ( of_get_option('pinterest', true) != "") { ?>
				 <a target="_blank" href="<?php echo esc_url(of_get_option('pinterest', true)); ?>" title="Pinterest" ><i class="social-icon fa fa-pinterest-square"></i></a>
	             <?php } ?>
	             <?php if ( of_get_option('instagram', true) != "") { ?>
				 <a target="_blank" href="<?php echo esc_url(of_get_option('instagram', true)); ?>" title="Instagram" ><i class="social-icon fa fa-instagram"></i></a>
	             <?php } ?>
	             <?php if ( of_get_option('linkedin', true) != "") { ?>
				 <a target="_blank" href="<?php echo esc_url(of_get_option('linkedin', true)); ?>" title="LinkedIn" ><i class="social-icon fa fa-linkedin-square"></i></a>
	             <?php } ?>
	             <?php if ( of_get_option('youtube', true) != "") { ?>
				 <a target="_blank" href="<?php echo esc_url(of_get_option('youtube', true)); ?>" title="YouTube" ><i class="social-icon fa fa-youtube-square"></i></a>
	             <?php } ?>
	             <?php if ( of_get_option('flickr', true) != "") { ?>
				 <a target="_blank" href="<?php echo esc_url(of_get_option('flickr', true)); ?>" title="Flickr" ><i class="social-icon fa fa-flickr"></i></a>
	             <?php } ?>
         
	</div>
			
		</header><!-- #masthead -->
	</div>
	
	<div id="header-2">
		<div class="container">
		<div class="default-nav-wrapper col-md-8 col-xs-12"> 	
		   <nav id="site-navigation" class="main-navigation" role="navigation">
	         <div id="nav-container">
				<h1 class="menu-toggle"></h1>
				<div class="screen-reader-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'inkness' ); ?>"><?php _e( 'Skip to content', 'inkness' ); ?></a></div>
	
				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
	          </div>  
			</nav><!-- #site-navigation -->
		  </div>
		  
		<div id="top-search" class="col-md-4 col-xs-12">
			<?php get_search_form(); ?>
		</div>
		</div>
	</div>
	
	<?php
	if ( (function_exists( 'of_get_option' )) && (of_get_option('slidetitle5',true) !=1) ) {
	if ( ( of_get_option('slider_enabled') != 0 ) && (is_home())  )  
		{ ?>
	<div class="slider-wrapper theme-default"> 
    	<div class="ribbon"></div>    
    		<div id="slider" class="nivoSlider">
    			<?php
		  		$slider_flag = false;
		  		for ($i=1;$i<6;$i++) {
		  			$caption = ((of_get_option('slidetitle'.$i, true)=="")?"":"#caption_".$i);
					if ( of_get_option('slide'.$i, true) != "" ) {
						echo "<a href='".esc_url(of_get_option('slideurl'.$i, true))."'><img src='".of_get_option('slide'.$i, true)."' title='".$caption."'></a>"; 
						$slider_flag = true;
					}
				}
				?>  
    		</div><!--#slider-->
    		<?php for ($i=1;$i<6;$i++) {
    				$caption = ((of_get_option('slidetitle'.$i, true)=="")?"":"#caption_".$i);
    				if ($caption != "")
    				{
	    				echo "<div id='caption_".$i."' class='nivo-html-caption'><div class='nivocapper'>";
	    				echo "<a href='".esc_url(of_get_option('slideurl'.$i, true))."'><div class='slide-title'>".of_get_option('slidetitle'.$i, true)."</div></a>";
	    				echo "<div class='slide-description'>".of_get_option('slidedesc'.$i, true)."</div>";
	    				echo "</div></div>";
    				}
    			}	
    	    
			?>
    </div>	
	<?php 
			}
		}
		?>



		<div id="content" class="site-content row clearfix clear">
		<div class="container col-md-12"> 




<h1>

<?php
//list each role and each user with that role (works if logged in)
//see http://wordpress.org/support/topic/256436 if not logged in:
global $wp_roles;
  $name = translate_with_context($name);
  echo '<p>List of users in the role '.$role .' ('. $name . '):</p>';
  $this_role = "'[[:<:]]".$role."[[:>:]]'";
  $query = "SELECT * FROM $wpdb->users WHERE ID = 1";
  $users_of_this_role = $wpdb->get_results($query);
  if ($users_of_this_role) {
    foreach($users_of_this_role as $user) {
      $curuser = get_userdata($user->ID);
      $author_post_url=get_author_posts_url($curuser->ID, $curuser->nicename);
      echo '<p>--User nicename: '.$curuser->user_nicename .', display Name: '. $curuser->display_name . ', link to author posts <a href="' . $author_post_url . '" title="' . sprintf( __( "Posts by %s" ), $curuser->user_nicename ) . '" ' . '>' . $curuser->user_nicename .'</a></p>';
    }
  }
?>

</h1>



		
