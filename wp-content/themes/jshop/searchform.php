	
<!-- Author : roy -->
<div class="panel panel-default">	
	<div class="panel-heading">
	Search 
	</div>
	<div class="panel-body">
		<form class="search-main" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<div class="input-group">

		      <input class="form-control" value="<?php _e( 'Search', 'jshop' ); ?>" onfocus="this.value=''" type="text" name="s" id="s" value="<?php the_search_query(); ?>" />
		      <span class="input-group-btn">
		        <button class="btn btn-default" type="submit" style="margin-top: 0px;" type="button">Go!</button>
		      </span>

		</div>	
		</form>
	</div>
</div>
<!-- end -->



<!-- original file
		<form class="search-main" action="<?php //echo esc_url( home_url( '/' ) ); ?>" method="get">

			<input class="form-control" value="<?php //_e( 'Search', 'jshop' ); ?>" onfocus="this.value=''" type="text" name="s" id="s" value="<?php //the_search_query(); ?>" />
			<input class="btn btn-success" type="image"  />
		</form>

		-->