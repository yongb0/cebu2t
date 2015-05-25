





<?php

$con = mysqli_connect("localhost","root","","2thinkers_cebu");
    //require_once('/wp-config.php');
    //global $wpdb;




if(isset($_POST['bbp_topic_submit'])) {
	$title = $_POST['bbp_topic_title'];
	$name  = $_POST['bbp_topic_content'];
	$price = $_POST['bbp_topic_price'];
	$choice = $_POST['bbs_choice'];
	mysqli_query($con, "INSERT INTO cebu_posts (post_title, post_status, comment_status, post_content, guid, menu_order, post_type, post_choice, post_price)
	VALUES ('$title', 'publish', 'closed', '$name', '', '0', 'topic', '$choice', '$price')");
}
?>

<?php if ( post_password_required() )return false;?>
<ul class="commentlist"><li><?php wp_list_comments(); ?>
<h1>

</h1>
</li></ul>
<div class="navigation"><?php paginate_comments_links(); ?></div>
<?php comment_form(); ?>