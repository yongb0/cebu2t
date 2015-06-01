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
    
  // set timeout before executing masonry
  setTimeout(function(){  
    jQuery('.grid').isotope({
      itemSelector: 'article',
      masonry: {
        columnWidth: 2
      }
    });
  },300);
  
  
  /*jQuery('.fdc p').readmore({
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
  });*/
    
  //count the number of archives in the post
  var countChecker = jQuery('#main').find('article.archive').length;
  
  //check if counter is greater than 0
  if(countChecker>0){
    jQuery('#main').find('article.archive').each(function(i,e){
      var content = jQuery(e).find('.entry-content').html();

      var contentCheck = stripHTML(jQuery(e).find('div.entry-content').html());
      var contentLink  = jQuery(e).find('h1.entry-title a').attr("href");

      if(contentCheck.length>200){
        contentCheck   = contentCheck.substr(0,200)+"...";
        contentCheck += "<div style='padding:10px; padding-left:0px;'><a href='"+contentLink+"'>Continue Reading...</a></div>";
      }

      jQuery(e).find('.entry-content').html(contentCheck);
      
    });
  } 

  //get the page's class
  var checkIfSingle = jQuery('#main').find('article.singular-item');

  var fancyBox = false;

  //check if the page is a single content
  if(checkIfSingle.length!==0) {
    var images = checkIfSingle.find(".entry-content img");//get all the images inside the content area

    //check if the images is not 0
    if(images.length!==0){
      checkIfSingle.find('.entry-content img').each(function(i,e){
        //get the non-emoji images
        if(!jQuery(e).hasClass('emoji')){
          var imageParent = jQuery(e).parent();
          var parentTagName = jQuery.trim(imageParent.prop("tagName").toLowerCase());
          if(parentTagName!="a"){
            var imageSrc = jQuery(e).attr("src"); //get the image src
            jQuery(e).wrap("<a href='"+imageSrc+"' class='fancybox'></a>"); //wrap image around anchor tag
            fancyBox = true; //set the fancybox
          }
        }
      });
    }
  }
  
  //check if fancybox was applied
  if(fancyBox) {
   jQuery("a.fancybox").fancybox();//reinitialize fancybox
  }

});

/**
 * [stripHTML description]
 * @param  {[type]} dirtyString [description]
 * @return {[type]}             [description]
 */
function stripHTML(dirtyString) {
    var container = document.createElement('div');
    container.innerHTML = dirtyString;
    return container.textContent || container.innerText;
}

    
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