<?php
/**
 * Template for displaying content that comes before the post
 *
 * @package Supernova
 * @since Supenova 1.0.1
 * @license GPL 2.0
 */
?>


<?php  
do_action('supernova_breadcrumb');?>
<div class="clearfix"></div>
<?php do_action('above_single_posts'); ?>
<?php if(!supernova_options('disable-resizer')) { ?>
<div class="font_resizer">
<a href="javascript:void(0);" id="minustext" title="<?php _e('Decrease font-size', 'Supernova') ?>">[A-]</a> | <a href="javascript:void(0);" id="plustext" title="<?php _e('Increase font size', 'Supernova') ?>">[A+]</a>
</div>
<?php } ?>