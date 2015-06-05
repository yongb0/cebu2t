<?php
/**
 * @package Inkness
 */
?>
<?php if(isset($_GET['id'])) { $productId =  $_GET['id'];  ?>
<?php if(site_url().$_SERVER['REQUEST_URI']=='http://cebu.2thinkers.net/2015/06/05/310/?id='.$productId) { 

global $wpdb;
			$table = 'fdci_web_crawler';
			$query = "SELECT * FROM $table WHERE id=$productId";
			$results = $wpdb->get_results($query) or die(mysql_error());
			foreach($results as $row) ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('singular-item'); ?>>
		
		<header class="entry-header">
			<h1 class="entry-title">
			<?php if($row->title!=''){ ?>
			<?php echo $row->title; ?>
			<?php } else { ?>
			<?php the_title(); ?>
			<?php } ?>
			</h1>

			<div class="entry-meta">
			<?php if($row->title!=''){ ?>
			Posted by :
			<?php echo $row->name_of_posted_person; ?>
			<?php } else { ?>
			<?php inkness_posted_on(); ?>
			<?php } ?>
				
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<?php if($row->title!=''){ ?>
					<div class="entry-content text-center">
						<img src="<?php echo $row->product_image; ?>" style="width: 500px;"/>
					</div>
					<div class="entry-content">
						<p>
							<?php echo $row->description; ?>
						</p>
						<table class="table table-hoverd table-bordered">
							<tr>
								<td>Price</td>
								<td><?php echo $row->price; ?></td>
							</tr>
							<tr>
								<td>Furnishing</td>
								<td><?php echo $row->furnishing; ?></td>
							</tr>
							<tr>
								<td>Location</td>
								<td><?php echo $row->location; ?></td>
							</tr>
							<tr>
								<td>Square Area</td>
								<td><?php echo $row->square_area; ?></td>
							</tr>
							<tr>
								<td>Bedroom</td>
								<td><?php echo $row->bedrooms; ?></td>
							</tr>
							<tr>
								<td>Bathroom</td>
								<td><?php echo $row->bathrooms; ?></td>
							</tr>
							<tr>
								<td>Floor</td>
								<td><?php echo $row->floor; ?></td>
							</tr>
							<tr>
								<td>Contact</td>
								<td>
									Mobile : <?php echo $row->contact_mobile; ?><br>
									Email : <?php echo $row->contact_email; ?><br>
									Landline : <?php echo $row->contact_landline; ?>
								</td>
							</tr>
						</table>
					</div>
		<?php } ?>
	</article><!-- #post-## -->


<?php } } else { //this is the end of url condition Author : Roy John Robert Jerodiaz  ?>


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


