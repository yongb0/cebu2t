<?php
/**
 * The loop that displays posts for all post listings and can also be used in child themes.
 * @package Supernova
 * @since Supernova 1.4.0
 */


if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article <?php post_class('listing_post_article') ?> id="post-<?php the_ID(); ?>" >
        <h2 class="post_title entry-title" ><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        <div class="entry listing_post_div">
            <a class="listing_thumb_link" href="<?php the_permalink(); ?>"><?php supernova_thumbnail(get_the_ID()); ?></a>
                <div class="entry-summary">
                    <?php supernova_content(); ?>
                </div>                
            <div class="clearfix"></div>
        </div><!--entry -->
        <?php do_action('supernova_meta'); ?>
    </article>
    <?php endwhile; else :
        if(!is_search()){
       echo "<h2>".__('Sorry Nothing Found', 'Supernova')."</h2>";
        }else{
            echo "<h3>".__('Sorry, we did not find any match for the searched term', 'Supernova')."</h3>";
        }
endif; ?>

<div class="clearfix"></div>