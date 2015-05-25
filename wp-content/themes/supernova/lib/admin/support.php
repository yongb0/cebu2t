<?php
/*
* Page for Help tab in options page
* @package Supernova
* @since Supenova 1.1
*/
global $supernova_theme_uri;  ?>
<div class="sayed">

<div class="documentation">
<div id="sup_support">	
    <div id="sup_info">
        <p class="sup_wp_url"><?php _e('If you have any suggestion, question or issues, no matter how big or small it is, feel free to ask on WordPress', 'Supernova'); ?> <a href="http://wordpress.org/support/theme/supernova" target="_blank"><?php _e('support', 'Supernova'); ?></a> <?php _e('forum, or ', 'Supernova'); ?><a href="<?php echo $supernova_theme_uri; ?>/contact-me/" target="_blank"><?php _e('contact me directly', 'Supernova') ?></a><?php _e(' I will try to reply as quickly as possible.', 'Supernova') ?></p>
        <p class="sup_wp_url"><?php _e('If you like this theme please rate it on WordPress', 'Supernova'); ?> <a href="http://wordpress.org/support/theme/supernova" target="_blank"><?php _e('theme reviews', 'Supernova'); ?></a> <?php _e('page', 'Supernova'); ?></p>
        <p class="sup_wp_url"><?php _e('To know how the final theme looks, view the theme ', 'Supernova'); ?><a href='http://supernovathemes.com/supernova/' target="_blank"><?php _e('Demo', 'Supernova'); ?></a></p>  
</div><!--sup_info -->
</div>

<div class="clearfix"></div>

	<h3><?php _e('Getting Started:', 'Supernova'); ?></h3>
    <p><?php _e(' All features of this theme have been kept on, so you dont have hard time understanding them and you can remove the ones you dont want, however there are couple of things you would want to know on the first use of this theme. ', 'Supernova'); ?></p>    
	<p><strong><?php _e('Sidebar:', 'Supernova'); ?></strong><?php _e(' Supernova has two sidebars, "Sidebar Home" would only show on the home page and "Sidebar Page" would show on all pages except home." ', 'Supernova'); ?></p>
        <p><strong><?php _e('Recommended Posts:', 'Supernova'); ?></strong><?php _e(' Recommended posts can be chosen from where you create or edit posts, at the bottom right of the sidebar." ', 'Supernova'); ?></p>	
	<p><strong><?php _e('Author Info Box:', 'Supernova'); ?></strong><?php _e(' Author info box information can be filled from user profile.', 'Supernova'); ?></p>	
        <p><strong><?php _e('Navigation:', 'Supernova'); ?></strong><?php _e(' Your theme supports four navigations, Header Navigation, Header Categories, Main Navigation and Footer Navigation, when you activate this theme, the menu items may not appear correctly since they are not saved, so please go to Appearance>Menus and save each navigation menu', 'Supernova'); ?></p>        
	<p><strong><?php _e('Plugins:', 'Supernova'); ?></strong><?php _e(' Though the theme loads fast however its highly recommended to use \'WP TOTAL CACHE\' plugin to decrease the page load time even more.', 'Supernova'); ?></p>        

        
    <h3><?php _e('What\'s new in this version(1.5.8)?', 'Supernova'); ?><sup>new</sup></h3>    
    <p><?php _e('Fixed bugs and resolved compatibility issues.' , 'Supernova'); ?></p>
    
    
    	<h3><?php _e('Having Problem?:', 'Supernova'); ?></h3>
	<p><?php _e('If something goes wrong or stops working all of a sudden, follow these steps before putting the blame on your theme', 'Supernova'); ?></p>
   	<p><?php _e('a) Switch to Wordpress default Twenty Twelve theme to see if its a theme related issue or a plugin which is causing problem, dont worry, the theme settings would not be lost', 'Supernova'); ?></p>
	<p><?php _e('b) Deactivate all plugins and see if that solves the problem.', 'Supernova'); ?></p> 
    <p><?php _e('c) Please reset settings of Supernova theme', 'Supernova'); ?></p>  
	<p><?php _e('If the problem could not be solved even after following these three steps check worpdress support forum for Supernova and see if there is already a solution to it or start a new discussion', 'Supernova'); ?></p>
    <p><?php _e('Supernova doesn\'t alter your existing database, so you can always switch back to your old theme and all your previous settings would be intact.', 'Supernova'); ?></p>
    
    <h3><?php _e('Get customization done starting with only $10', 'Supernova'); ?></h3>
    <p><?php _e('Now you can contact me to get any customization done to your theme starting with as low as $10. ', 'Supernova'); ?><a href="<?php echo $supernova_theme_uri; ?>/hire-me/" target="_blank" /> HIRE ME</a></p>
    
    <br><br>
            

    <h2 class="pstdoyt"><strong><?php _e('Please support the development of your theme', 'Supernova'); ?></strong></h2>    
    <table class="sup_support_donation">
    <tr>
    	<td class="cofee"><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/cofee_big.gif"><i><?php _e('Buy me a cup of coffee', 'Supernova'); ?></i></td>
    	<td class="paypal"><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=sayed2x2@gmail.com&item_name=Donation for Supernova" title="Thank You" target="_blank"><img src="<?php echo SUPERNOVA_ROOT_ADMIN; ?>images/donate.gif" ></a></td>
    </tr>     
    </table>
</div>
<!--    <p style="float: right;"><i><?php _e('Designed & Developed By: ', 'Supernova'); ?><a style="text-decoration:none; font-size:14px;" href="<?php echo $supernova_theme_uri; ?>" target="_blank"> Sayed Taqui</a></i></p>-->
</div> <?php 