

<div class="breadcrumb">
	<div class="panel panel-default" style="margin-top:60px;">
		<div class="panel-heading"> 
		All Product List
    </div>
    <div class="panel-body">

    <table class="table table-bordered table-hover">
    	<tr>
    		<th>No.</th>
    		<th>Reference No.</th>
    		<th>Product Title</th>
    		<th>Description</th>
    		<th>Price</th>
    		<th>Original Post Link</th>
    		<th>Furnishing</th>
    		<th>Location</th>
    		<th>Square Area</th>
    		<th>Bedroom</th>
    		<th>Bathroom</th>
    		<th>Floor</th>
    		<th>Name of Person posted</th>
    		<th>Contact Nuber</th>
    		<th>Action</th>
    	</tr>
    	<?php $numberOfProducts = 1; ?>
    	<?php foreach( $results as $result ){ ?>
    	<tr>
    		<td><?php echo $numberOfProducts; ?></td>
    		<td><?php echo $result->reference_no; ?></td>
    		<td><?php echo $result->title; ?></td>
    		<td><?php echo $result->description; ?></td>
    		<td><?php echo $result->price; ?></td>
    		<td><?php echo $result->original_post_link; ?></td>
    		<td><?php echo $result->furnishing; ?></td>
    		<td><?php echo $result->location; ?></td>
    		<td><?php echo $result->square_area; ?></td>
    		<td><?php echo $result->bedrooms; ?></td>
    		<td><?php echo $result->bathrooms; ?></td>
    		<td><?php echo $result->floor; ?></td>
    		<td><?php echo $result->name_of_posted_person; ?></td>
    		<td><?php echo $result->contact_number; ?></td>
    		<td>
    			<a href="" class=""><span class="glyphicon glyphicon-info-sign"></span>Disable</a> 
    			<a href="" class=""><span class="glyphicon glyphicon-pencil"></span>Update</a> 
    			<a href="" class=""><span class="glyphicon glyphicon-trash"></span>Delete</a> 
    	</tr>
    	<?php $numberOfProducts++; ?>
    	<?php } ?>
    </table>

    </div>
    <div class="panel-footer">
    </div>
    </div>
    </div>