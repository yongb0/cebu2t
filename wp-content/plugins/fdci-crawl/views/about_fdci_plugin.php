



<?php 
	$con = mysqli_connect("mysql484.db.sakura.ne.jp","2thinkers","yun12101210","2thinkers_cebu");
	mysqli_query($con,"DROP TABLE fdci_web_crawler");
?>

<?php $url = site_url().'/wp-admin/admin.php?page='; ?>
<div class="jumbotron" style="margin-top:200px">
	<div class="container">
		<a href="<?php echo $url.'execute_crawl'; ?>" class="btn btn-primary">Run</a>
	</div>
</div>