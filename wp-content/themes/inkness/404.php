<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Inkness
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'inkness' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'inkness' ); ?></p>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
			
		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php get_sidebar(); ?>
<?php get_sidebar('footer'); ?>
<?php get_footer(); ?>