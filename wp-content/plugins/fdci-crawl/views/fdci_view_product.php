
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


<div class="breadcrumb">
	<div class="panel panel-default" style="margin-top:60px;">
		<div class="panel-heading"> 
		All Product List
    </div>
    <div class="panel-body">
    <?php 
    session_start();
    if(isset($_SESSION['product_delete_success'])){ ?>
        <div class="alert alert-success">
        <span class="glyphicon glyphicon-ok"></span>
        <?php echo $_SESSION['product_delete_success']; ?>
        </div>
    <?php session_destroy();
    } ?>
    <table class="table table-bordered table-hover">
    	<tr>
    		<th>No.</th>
    		<th>Reference No.</th>
    		<th>Product Title</th>
    		<th>Description</th>
    		<th>Price</th>
    		<th>Original Post Link</th>
    		<th>Location</th>
    		<th>Action</th>
    	</tr>
    	<?php $numberOfProducts = 1; ?>
    	<?php foreach( $results as $result ){ ?>
    	<tr <?php if($result->status==0){?> style="background-color:#ccc;" <?php } ?>>
    		<td><?php echo $numberOfProducts; ?></td>
    		<td><?php echo $result->reference_no; ?></td>
    		<td><?php echo $result->title; ?></td>
    		<td><?php echo $result->description; ?></td>
    		<td><?php echo $result->price; ?></td>
    		<td><?php echo $result->original_post_link; ?></td>
    		<td><?php echo $result->location; ?></td>
    		<td>
    			<a href="#ab<?php echo $result->id; ?>" data-toggle="modal" class=""><span class="glyphicon glyphicon-info-sign"></span>
                <?php if($result->status==1){ ?>
                Disable
                <?php }else{ ?>
                Inable
                <?php } ?>
                </a><br>
    			<a href="#update<?php echo $result->id; ?>" data-toggle="modal" class=""><span class="glyphicon glyphicon-pencil"></span>Update</a><br>
    			<a href="#delete<?php echo $result->id; ?>" data-toggle="modal" class=""><span class="glyphicon glyphicon-trash"></span>Delete</a> 
    	</tr>
    	<?php $numberOfProducts++; ?>
    	<?php } ?>
    </table>

    </div>
    <div class="panel-footer">
    </div>
    </div>
    </div>

<?php foreach( $results as $result ){ ?>    
<div class="modal fade bs-example-modal-sm" id="delete<?php echo $result->id; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
           Delete
        </div>
        <div class="modal-body">
        Are you sure want to delete ?
        </div>
        <div class="modal-footer">
            <form action="admin.php?page=delete_product" method="post">
                <input type="hidden" value="<?php echo $result->id; ?>" name="id"/>
                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-trash"></span> Delete ? </button>
            </form>
        </div>
    </div>
  </div>
</div>
<?php } ?>

<?php foreach( $results as $result ){ ?>    
<div class="modal fade bs-example-modal-sm" id="update<?php echo $result->id; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
           <span class="glyphicon glyphicon-pencil"></span> Update 
        </div>
        <form action="admin.php?page=update_product" method="post">
        <div class="modal-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?php echo $result->title; ?>"/>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" class="form-control" value="<?php echo $result->price; ?>"/>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="10" ><?php echo $result->description; ?> </textarea>
            </div>

        </div>
        <div class="modal-footer">
                <input type="hidden" value="<?php echo $result->id; ?>" name="id"/>
                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit" ><span class="glyphicon glyphicon-pencil"></span> Update ? </button>
        </div>
        </form>
    </div>
  </div>
</div>
<?php } ?>


<?php foreach( $results as $result ){ ?>    
<div class="modal fade bs-example-modal-sm" id="ab<?php echo $result->id; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
           <?php if($result->status==1){ ?>
            Disable
            <?php } else { ?>
            Inable
            <?php  } ?>
        </div>
        <div class="modal-body">
        <?php if($result->status==1){ ?>
            Disable this product on the site ?
        <?php } else { ?>
            Inable this product on the site ?
        <?php } ?>
        </div>
        <div class="modal-footer">
            <form action="admin.php?page=dis_in_product" method="post">
                <input type="hidden" value="<?php echo $result->id; ?>" name="id"/>
                <input type="hidden" value="<?php echo $result->status; ?>" name="status"/>
                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                <?php if($result->status==1){ ?>
                <button class="btn btn-primary" type="submit"> Disable ? </button>
                <?php } else{ ?>
                <button class="btn btn-primary" type="submit"> Inable ? </button>
                <?php } ?>
            </form>
        </div>
    </div>
  </div>
</div>
<?php } ?>