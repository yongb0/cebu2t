<?php
/*
Template Name: Full Width(No Sidebar, No Title)
*/

get_header(); 

if (isset($_GET["pages"])) { $page  = $_GET["pages"]; } else { $page=1; }; ?>
		<?php if((site_url().$_SERVER['REQUEST_URI']=='http://2thinkerscebu.local/testing-page/')||(site_url().$_SERVER['REQUEST_URI']=='http://2thinkerscebu.local/testing-page/?pages='.$page)) { ?>
			<div class="grid">
			<style>
				.title-format{
					font-size: 15px;
					margin: 0;
				}
				.orange {color:orange;}
				.wrappers{
					border: 1px solid #eee;
				}
			</style>

	<?php
	// global $wpdb;
	// $sql = "SELECT * FROM fdci_web_crawler ";
	// $results = $wpdb->get_results($sql) or die(mysql_error());

$num_rec_per_page=3;
mysql_connect('localhost','root','');
mysql_select_db('hello');


$start_from = ($page-1) * $num_rec_per_page; 
$sql = "SELECT * FROM fdci_web_crawler LIMIT $start_from, $num_rec_per_page"; 
$rs_result = mysql_query ($sql); //run the query


		while ($result = mysql_fetch_assoc($rs_result)) {
	// foreach( $results as $result ) ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class("homa archive col-md-4"); ?> >
					<div class="article-wrapper wrappers">	
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

							<header>
									<a href="http://2thinkerscebu.local/testing-single/?id=<?php echo $result->id; ?>" rel="bookmark">
									<?php $json 	=	json_decode($result['product_image']); ?>

									<img src="<?php echo $json['1']; ?>" style="width:100%;height: 200px;"/>

									<div class="title-format">
										<?php echo $result['title']; ?>
									</div>
									</a>
								

								<div class="entry-meta">
								 <?php if($result['posted_date']!='') { ?>
								   <b>Posted date : </b> <?php echo $result['posted_date']; ?>
								 <?php } ?>
								</div><!-- .entry-meta -->


							</header><!-- .entry-header -->

							<b class="orange">Description : </b>
							<div class="entry-content" style="margin-top:0px;">
								 <?php echo $result['description']; ?>
							</div><!-- .entry-content -->

						</div>
					</div>	
		</article><!-- #post-## -->
	<?php } ?>
	<?php 

$sql = "SELECT count(*) as rows FROM fdci_web_crawler"; 
$rs_result = mysql_query($sql); //run the query
$total_records = mysql_result($rs_result,0,'rows');  //count number of records
$total_pages = ceil($total_records / $num_rec_per_page); 
?>
</div>

<nav style="padding-bottom: 50px;">
  <ul class="pagination">
  <?php
for ($i=$page-2; $i<$page+2; $i++) {
	if($i >= 1 && $total_pages >= $i) {
		?>
	<li <?php if($page==$i){echo "class='active'";} ?> ><a href="<?php echo 'http://2thinkerscebu.local/testing-page/?pages='.$i; ?>"><?php echo $i; ?> </a></li>     
<?php
	}
}; 
if($page < 5 && $total_pages >= 4) {
	for($i = $page + 2 ; $i < $page + 5; $i++) {
		echo $i;
		if($i < $page + 3 && $total_pages >= $i) {
		?>
		<li><a href="<?php echo 'http://2thinkerscebu.local/testing-page/?pages='.$i; ?>"><?php echo $i; ?> </a></li>
		<?php
		}
	}
}
?>
  </ul>
</nav>

    

<?php } else { ?>
	<div id="primary" class="full-width content-area col-md-12" style="background-color:#eee;">
		<main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page-no-title' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>
			</main><!-- #main -->
	</div><!-- #primary -->
<?php } ?>

		

<?php get_footer(); ?>
