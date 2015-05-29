<?php
/*
Plugin Name: Read more without refresh for Wordpress
Version: 0.1
Plugin URI: http://plugins.wordpress.org/read-more-without-refresh/
Description: A simple plugin that will use Javascript to show or hide your extra text, included in the shortcode.
Author: George Gkouvousis
Author URI: http://www.8web.gr/
*/

/*
 * Usage: [read more="Read more" less="Read less"]hidden paragraph[/read]
 */

define('READ_PLUGIN_URL', WP_PLUGIN_URL . '/' . dirname(plugin_basename(__FILE__)));
define('READ_PLUGIN_PATH', WP_PLUGIN_DIR . '/' . dirname(plugin_basename(__FILE__)));
define('READ_VERSION', '0.1');

function read_register_shortcodes() {
   add_shortcode('read', 'read_main');
}

function read_main($atts, $content = null) {
	extract(shortcode_atts(array(
		'more' => 'READ MORE',
		'less' => 'READ LESS'
	), $atts));

	mt_srand((double)microtime() * 1000000);
	$rnum = mt_rand();

	$new_string = '<span style="background-color: #fff;"><a onclick="read_toggle(' . $rnum . ', \'' . addslashes($more) . '\', \'' . addslashes($less) . '\'); return false;" class="read-link" id="readlink' . $rnum . '" style="color: #FF8500;font-weight: 800;font-family: Arial, Helvetica, sans-serif;font-size: 12px;padding: 12px 12px 12px 12px;" href="#">' . addslashes($more) . '</a></span>' . "\n";
	$new_string .= '<div class="read_div" id="read' . $rnum . '" style="display: none;">' . do_shortcode($content) . '</div>';

	return $new_string;
}

function read_javascript() {
	echo '<script>
	function expand(param) {
		param.style.display = (param.style.display == "none") ? "block" : "none";
	}
	function read_toggle(id, more, less) {
		el = document.getElementById("readlink" + id);
		el.innerHTML = (el.innerHTML == more) ? less : more;
		expand(document.getElementById("read" + id));
	}
	</script>';
}

add_action('wp_head', 'read_javascript');
add_action('init', 'read_register_shortcodes');
?>