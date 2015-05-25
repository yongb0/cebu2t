<?php
/**
 * Template for displaying newer and older entries at different locations like archive
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */
?>

<div class="cat_post_nav">
    <?php do_action('supernova_breadcrumb'); ?>
    <div class="next_prev_posts">
        <div class="next-posts"><?php next_posts_link(__('&laquo; Older Entries', 'Supernova')) ?></div>
        <div class="prev-posts"><?php previous_posts_link(__('Newer Entries &raquo;', 'Supernova')) ?></div>
    </div>
</div>
