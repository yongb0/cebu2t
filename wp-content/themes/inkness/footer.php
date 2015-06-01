<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Inkness
 */
?>






  <script src="<?php echo get_site_url(); ?>/wp-content/themes/inkness/reads/readmore.js"></script>
  
  <script>

// external js: isotope.pkgd.js

jQuery(document).ready( function() {
  
  setTimeout(function(){  
    jQuery('.grid').isotope({
      itemSelector: 'article',
      masonry: {
        columnWidth: 2
      }
    });
  },500);

  jQuery('.fdc p').readmore({
      speed: 500,
      afterToggle: function(trigger, element, expanded) {
        if(! expanded) { 
          setTimeout(function(){
            var parent = jQuery('#primary-home');
            parent.find('.row').each(function(i,e){
            });
          },600);

        } else {
	        setTimeout(function(){
	       		
	        jQuery(element).parent('.fdc').parent('.article-rest').parent('.article-wrapper').parent('article').css('height','auto');
	       
	        },600);
        }

        jQuery('.grid').isotope({
          itemSelector: 'article',
          masonry: {
            columnWidth: 2
          }
        });
      }
  });
  
});

    
  </script>

	</div>
	</div><!-- #content -->

<nav  style="height: 20px;" class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	<div style="border-top: 2px solid #eee;" >
	  	<div class="container " >

	  	<div class="row" style="height: 20px; margin-top: 10px;">
	  		<div class="col-sm-8">
			  	<div>
			  	Copyright &copy 2015 -2016 All About Cebu. All Rights Reserved
			  	</div>
			</div>
			<div class="col-sm-4">
			  	<div class="pull-right" >
			  		www.cebu.2thinkers.net
			  	</div>
			</div>
	  	</div>

	  	</div>
  	</div>
</nav>

	
</div><!-- #page -->

<?php		
	if ( (function_exists( 'of_get_option' ) && (of_get_option('footercode1', true) != 1) ) ) {
			 	echo of_get_option('footercode1', true); } ?>
<?php wp_footer(); ?>
</body>
</html>