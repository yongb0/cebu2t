<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Inkness
 */

get_header(); ?>

	<div id="primary" class="content-area col-md-8">
		<main id="main" class="site-main" role="main">

<?php $id = $_GET['id']; ?>

<?php if(site_url().$_SERVER['REQUEST_URI']=='http://2thinkerscebu.local/2015/06/04/cebu-listing/?id='.$id) { ?>
	<div class="breadcrumb">
		<div class="row">
			<div class="col-sm-12">
			 	
			    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  			    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
				<?php
					global $wpdb;
					$sql	 = "SELECT * FROM fdci_web_crawler WHERE id=$id";
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
						        <img src="<?php echo $data[$i]; ?>" alt="Chania" class="img-responsive" >
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
					<tr>
						<td><b>Description : </b></td>
					</tr>
					<tr>
						<td><?php for($space=0;$space<=10;$space++){ ?>&nbsp;<?php } ?><?php echo $row->description;?></td>
					</tr>
					<tr>
						<td>
							<table class="table table-bordered">
								<tr style="background-color: #ddd;">

								    <?php if($row->price!='') { ?>
										<th>Price</th>
									<?php } ?>

									<?php if($row->square_area!='') { ?>
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
										<td><?php echo $row->price; ?></td>
									<?php } ?>

									<?php if($row->square_area!='') { ?>
										<td><?php echo $row->square_area; ?></td>
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
				<?php 
					}
				 ?>
			</div>
		</div>
	</div>
<?php } else {  ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php inkness_content_nav( 'nav-below' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

<?php } //close of else?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_sidebar('footer'); ?>
<?php get_footer(); ?>