<?php
/**
 * @package Inkness
 */
?>
<?php if(isset($_GET['id'])) { $productId =  $_GET['id']; } else { $productId='00'; } ?>
<?php if(site_url().$_SERVER['REQUEST_URI']=='http://cebu.2thinkers.net/2015/06/05/310/?id='.$productId) { ?>
  
<div class="breadcrumb">
		<div class="row">
			<div class="col-sm-12">
			 	
			    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  			    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
				<?php
					global $wpdb;
					$sql	 = "SELECT * FROM fdci_web_crawler WHERE id=$productId";
					$results = $wpdb->get_results($sql) or die(mysql_error());
					foreach($results as $row){ 
				?>
				<b><?php echo $row->title; ?></b>
				<b class="pull-right">Posted: <?php echo $row->posted_date;?></b>

				<br>
				<?php echo $row->location; ?>				
				<div style="padding: 5px;">  
					<?php $json = (json_decode($row->product_image, true)); ?>
					<?php $numberOfImage = count($json)-1;?>
					
					<?php $data = array();?>
					<?php $b = 0; ?>
					<?php for($a=0;$a<=$numberOfImage;$a++){
						if($json[$a]!=''){
							$data[$b] = $json[$a]; 
							$b++;
						}
					} ?>
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
					    <!-- Indicators -->
					    <ol class="carousel-indicators">
							<?php for($i=0;$i<$numberOfImage;$i++){ ?>
								<li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0){ echo 'active'; } ?>"></li>
				    		<?php } 	?>
    					</ol>
    					<div class="carousel-inner" role="listbox">
    						<?php for($i=0;$i<$numberOfImage;$i++){ ?>
							<div class="item <?php if($i==0){ echo 'active'; } ?>">
						        <img src="<?php echo $data[$i]; ?>" alt="Chania" class="img-responsive" style="width:700px; height:400px;" >
						    </div>
				    		<?php } ?>
				    	</div>
					    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					      <span class="sr-only">Previous</span>
					    </a>
					    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					      <span class="sr-only">Next</span>
					    </a>
					</div>
				</div>
				<table class="table table-hovered table-bordered">
				<?php if($row->description!='') { ?>
					<tr>
						<td><b>Description : </b></td>
					</tr>
					<tr>
						<td><?php for($space=0;$space<=10;$space++){ ?>&nbsp;<?php } ?><?php echo $row->description;?></td>
					</tr>
				<?php } ?>
					<tr>
						<td>
							<table class="table table-bordered">
								<tr style="background-color: #ddd;">

								    <?php if($row->price!='') { ?>
										<th>Price</th>
									<?php } ?>

									<?php if($row->square_area!=''&&$row->square_area!=0) { ?>
										<th>Square Area</th>
									<?php } ?>

									<?php if($row->bedrooms!='') { ?>
										<th>Bedroom</th>
									<?php } ?>

									<?php if($row->bathrooms!='') { ?>
										<th>Bathroom</th>
									<?php } ?>

									<?php if($row->floor!='') { ?>
										<th>Floor</th>
									<?php } ?>

									<?php if($row->furnishing!='') { ?>
										<th>Furnishing</th>
									<?php } ?>

								</tr>
								<tr>
								    <?php if($row->price!='') { ?>
										<td> ₱ 
										<?php if($row->site_link_id==1) { ?>
										<?php echo number_format($row->price); ?>
										<?php }else { ?>
										<?php echo $row->price; } ?>
										.00
										</td>
									<?php } ?>

									<?php if($row->square_area!=''&&$row->square_area!=0) { ?>
										<td><?php echo $row->square_area; ?> sqm</td>
									<?php } ?>


									<?php if($row->bedrooms!='') { ?>
										<td><?php echo $row->bedrooms; ?></td>
									<?php } ?>


									<?php if($row->bathrooms!='') { ?>
										<td><?php echo $row->bathrooms;?></td>
									<?php } ?>

									<?php if($row->floor!='') { ?>
										<td><?php echo $row->floor; ?></td>
									<?php } ?>

									<?php if($row->furnishing!='') { ?>
										<td><?php echo $row->furnishing; ?></td>
									<?php } ?>

								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table class="table table-bordered">
								<tr style="background-color: #ddd;">

									<?php if($row->name_of_posted_person!='') { ?>
										<th>Contact Person :</th>
									<?php } ?>

									<?php if($row->contact_mobile!='') { ?>
										<th>Contact No.</th>
									<?php } ?>

									<?php if($row->contact_email!='') {  ?>
										<th>Email</th>
									<?php } ?>

									<?php if($row->contact_landline) { ?>
										<th>Landline</th>
									<?php } ?>

								</tr>
								<tr>

									<?php if($row->name_of_posted_person!='') { ?>
										<td><?php echo ucwords(strtolower($row->name_of_posted_person)); ?></td>
									<?php } ?>

									<?php if($row->contact_mobile!='') { ?>
										<td><?php echo $row->contact_mobile; ?></td>
									<?php } ?>

									<?php if($row->contact_email!='') {  ?>
										<td><?php echo $row->contact_email; ?></td>
									<?php } ?>

									<?php if($row->contact_landline!='') { ?>
										<td><?php echo $row->contact_landline; ?></td>
									<?php } ?>

								</tr>
							</table>
						</td>
					</tr>
				</table>
				<a href="<?php echo $row->original_post_link; ?>" target="_blank" class="btn btn-primary">Click here for more info</a>
				<?php 
					}
				 ?>
			</div>
		</div>
	</div>

<?php  } else { //this is the end of url condition Author : Roy John Robert Jerodiaz  ?>


	<article id="post-<?php the_ID(); ?>" <?php post_class('singular-item'); ?>>
		
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?>

			</h1>

			<div class="entry-meta">
				<?php inkness_posted_on(); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php if (has_post_thumbnail() ) : ?>
			<div class="featured-image-single">
				<?php
					the_post_thumbnail();
					?>
			</div>
			<?php endif; ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'inkness' ),
					'after'  => '</div>',
				) );
			?>
		<?php the_content(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<?php
				/* translators: used between list items, there is a space after the comma */
				$category_list = get_the_category_list( __( ', ', 'inkness' ) );
				/* translators: used between list items, there is a space after the comma */
				$tag_list = get_the_tag_list( '', __( ', ', 'inkness' ) );
				if ( ! inkness_categorized_blog() ) {
					// This blog only has 1 category so we just need to worry about tags in the meta text
					if ( '' != $tag_list ) {
						$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'inkness' );
					} else {
						$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'inkness' );
					}
				} else {
					// But this blog has loads of categories so we should probably display them here
					if ( '' != $tag_list ) {
						$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'inkness' );
					} else {
						$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'inkness' );
					}
				} // end check for categories on this blog
				printf(
					$meta_text,
					$category_list,
					$tag_list,
					get_permalink()
				);
			?>

			<?php edit_post_link( __( 'Edit', 'inkness' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post-## -->


<?php } ?>


