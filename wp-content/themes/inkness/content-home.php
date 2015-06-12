<?php
/**
 * @package Inkness
 */
					//global $wpdb;
/*	$sql = "SELECT * FROM fdci_web_crawler";
	$results = $wpdb->get_results($sql) or die(mysql_error());
	var_dump($results);
	print_r($results);
	print_r($sql);*/
?>
<?php if(site_url().$_SERVER['REQUEST_URI']=='http://cebu.2thinkers.net/category/cebu-listing/') { ?>

	<?php
	global $wpdb;
	$sql = "SELECT * FROM fdci_web_crawler ";
	$results = $wpdb->get_results($sql) or die(mysql_error());
	foreach( $results as $result ){ ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class("homa archive col-md-4"); ?>>
					<div class="article-wrapper">	
						<?php if (has_post_thumbnail()) : ?>
						<div class="featured-thumb col-md-12 col-xs-12">
						<a href="<?php the_permalink(); ?>">
						<?php
							the_post_thumbnail('homepage-banner');	
						?>
						</a>
						</div>
						<?php endif; ?>
						<div class="article-rest col-md-12">
							<header class="entry-header">
								<h1 class="entry-title">
									<a href="<?php the_permalink(); ?>?id=<?php echo $result->id; ?>" rel="bookmark">
									<?php $json 	=	json_decode($result->product_image); ?>
									<img src="<?php echo $json['1']; ?>" style="width:100%;height: 200px;"/>
										<?php echo $result->title; ?>
									</a>
								</h1>

								<div class="entry-meta">
								 <?php if($result->posted_date!='') { ?>
								   <b>Posted date : </b> <?php echo $result->posted_date; ?>
								 <?php } ?>
								</div><!-- .entry-meta -->
							</header><!-- .entry-header -->
							<b style="font-size:15px; color: orange ">Description : </b>
							<div class="entry-content" style="margin-top:0px;">
								 <?php echo $result->description; ?>
							</div><!-- .entry-content -->

						</div>
					</div>	
		</article><!-- #post-## -->
	<?php } ?>

<?php } else { ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class("homa archive col-md-4"); ?>>
					<div class="article-wrapper">	
						<?php if (has_post_thumbnail()) : ?>
						<div class="featured-thumb col-md-12 col-xs-12">
						<a href="<?php the_permalink(); ?>">
						<?php
							the_post_thumbnail('homepage-banner');	
						?>
						</a>
						</div>
						<?php endif; ?>
						<div class="article-rest col-md-12">
						<header class="entry-header">
							<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

							<?php if ( 'post' == get_post_type() ) : ?>
							<div class="entry-meta">
								<?php inkness_posted_on(); ?>
							</div><!-- .entry-meta -->
							<?php endif; ?>
						</header><!-- .entry-header -->

						<?php if ( is_search() ) : // Only display Excerpts for Search ?>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
						<?php else : ?>
						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div><!-- .entry-content -->
						<?php endif; ?>
						</div>
					</div>	
					</article><!-- #post-## -->
<?php } ?>