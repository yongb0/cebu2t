<?php
/*  Date Created : June 4 , 2015
	Author 		 : John Robert Jerodiaz - Roy
*/

?>

<?php
session_start();
if(isset($_SESSION['product_save_success'])){ ?>
	<div class="alert alert-success">
	<span class="glyphicon glyphicon-ok"></span>
	<?php echo $_SESSION['product_save_success']; ?>
	</div>
<?php session_destroy();} ?>

<div class="breadcrumb">
	<div class="panel panel-default" style="margin-top:40px;">
		<div class="panel-heading">
		<h4>
			<span class="glyphicon glyphicon-pencil"></span>
		 	Add Product
		 </h4>
		</div>
		<form action="admin.php?page=add_product_exec" method="post">
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="product_original_site">Original site</label>
							<input type="text" name="product_original_site" id="product_original_site" class="form-control" placeholder="Enter product original site" />
						</div>
						<div class="form-group">
							<label for="product_original_post_link">Original post link</label>
							<input type="text" name="product_post_link" id="product_original_post_link" class="form-control" placeholder="Enter original post link" />
						</div>
						<div class="form-group">
							<label for="product_title">Title</label>
							<input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" required=""/>
						</div>
						<div class="form-group">
							<label for="product_description">Description</label>
							<textarea name="product_description" rows="9" id="product_description" class="form-control" required="">
							</textarea>
						</div>
						<div class="form-group">
							<label for="product_image_link">Add Image Link</label><br>
							<small><b>Note: </b> Add space in every image link inputed</small>
							<textarea name="product_image_link" rows="6" id="product_image_link" class="form-control" required="">
							</textarea>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="product_price">Price</label>
							<input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" required=""/>
						</div>
						<div class="form-group">
							<label for="product_furnishing">Furnishing</label>
							<input type="text" name="product_furnishing" id="product_furnishing" class="form-control" placeholder="...."/>
						</div>
						<div class="form-group">
							<label for="product_location">Location</label>
							<input type="text" name="product_location" id="product_location" class="form-control" placeholder="Enter product location" required=""/>
						</div>
						<div class="form-group">
							<label for="product_square_area">Square area</label>
							<input type="text" name="product_square_area" id="product_square_area" class="form-control" placeholder="Product square Area"/>
						</div>
						<div class="form-group">
							<label for="product_bedroom">Bedroom</label>
							<input type="text" name="product_bedroom" id="product_bedroom" class="form-control" placeholder="...."/>
						</div>
						<div class="form-group">
							<label for="product_bathroom">Bathroom</label>
							<input type="text" name="product_bathroom" id="product_bathroom" class="form-control" placeholder="...."/>
						</div>
						<div class="form-group">
							<label for="product_floor">Floor</label>
							<input type="text" name="product_floor" id="product_floor" class="form-control" placeholder="...."/>
						</div>
						<div class="form-group">
							<label for="product_contact_person">Contact Person</label>
							<input type="text" name="product_contact_person" id="product_contact_person" class="form-control" placeholder="Enter contact person" />
						</div>
						<div class="form-group">
							<label for="product_contact_number">Person Contact No.</label>
							<input type="text" name="product_contact_number" id="product_contact_number" class="form-control" placeholder="Enter contact no." />
						</div>
						<div class="form-group">
							<label for="product_person_email">Person Email</label>
							<input type="email" name="product_person_email" id="product_person_email" class="form-control" placeholder="Enter email" />
						</div>
						<input type="hidden" value="FDC-05-04-2015" name="fdci_tkf">
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<button class="btn btn-primary" type="submit" name="fdci_c_p_s"><span class="glyphicon glyphicon-pencil"></span> Add</button>
				<button class="btn btn-default" type="reset">Clear</button>
			</div>
		</form>
	</div>
	</div>

