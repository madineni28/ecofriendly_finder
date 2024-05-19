<?php
ob_start();
	session_start();
	
	if(empty($_COOKIE['adminLogin'])){
        
		header("location:../login/");
		
	}
		
	//include('connection/function.php');	
	include('../../db_connection/database_connection.php');
	include('../../class/admin.php');
	include('../../class/businesses.php');
	include('../../class/customer.php');
	include('../../class/products.php');

	$db = new DBConnection();
	$database = $db->getConnection();

	$admin = new Admin($database);
	$business = new Business($database);
	$product = new Product($database);
	$customer = new Customer($database);
	
	$session_id = session_id();
	


	$path = "../../";




$page = 'add-product';

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />
		<title>Add Product :: Three Star</title>
		<!-- Bootstrap CSS -->
		<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css'>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.13/css/all.css'>
		<link href="<?php echo $path; ?>css/bootstrap.min.css" rel="stylesheet">
		
		<link href="<?php echo $path; ?>css/style.css" rel="stylesheet">
	</head>

	<body>

		<?php include("../../nav/side_nav.php"); ?>

		

		<div class="untree_co-section">
		    <div class="container">
			
			  <form class="col-md-12" method="post" id="add_product" enctype="multipart/form-data">
		      <div class="row" style="margin-top:40px;">
		        <div class="col-md-12 mb-5 mb-md-0">
		          <h2 class="h3 mb-3 text-black">Add Product</h2>
		          <div class="p-3 p-lg-5 border bg-white">
					<div class="form-group row mb-3">
		              <div class="col-md-12">
		                <label for="c_fname" class="text-black">Business <span class="text-danger">*</span></label>
		               <select class="form-control" id="business_id" name="business_id" required >
							<option value="">---Please select business--</option>
							
							<?php
							
							$businesses = $business->selectBusinesses();
							
							foreach($businesses as $row) {
										extract($row);
							?>
							<option value="<?php echo $business_id; ?>"><?php echo $name; ?></option>
							<?php
							}
							?>
							
						</select>
		              </div>
		            </div>
					<div class="form-group row mb-3">
		              <div class="col-md-12">
		                <label for="c_fname" class="text-black">Category <span class="text-danger">*</span></label>
		               <select class="form-control" id="category_id" name="category_id" required >
							<option value="">---Please select category--</option>
							
							<?php
							
							$categories = $business->getCategory();
							
							foreach($categories as $row) {
										extract($row);
							?>
							<option value="<?php echo $category_id; ?>"><?php echo $name; ?></option>
							<?php
							}
							?>
							
						</select>
		              </div>
		            </div>
		            <div class="form-group row mb-3">
		              <div class="col-md-12">
		                <label for="c_fname" class="text-black">Product Image <span class="text-danger">*</span></label>
		                <input type="file" class="form-control" id="image_url" name="image_url" value="" required >
		              </div>
		            </div>
		            <div class="form-group row mb-3" >
		              <div class="col-md-6">
		                <label for="c_fname" class="text-black">Product Name <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="product_name" name="product_name" value="" required >
		              </div>
		              <div class="col-md-6">
		                <label for="trip_price" class="text-black">Product Price <span class="text-danger">*</span></label>
		                <input type="number" class="form-control" id="product_price" name="product_price" value=" " required >
		              </div>
		            </div>
					<div class="form-group row mb-3">
		              <div class="col-md-12">
		                <label for="trip_price" class="text-black">Product Description <span class="text-danger">*</span></label>
		                <textarea class="form-control" id="description" name="description"  required style="height:200px;"> </textarea>
		              </div>
					 
		            </div>
		            
					<span id="message"></span>
					<div class="form-group  mb-3" style="margin-bottom:20px;">
		                 <input type="submit" class="btn btn-success btn-sm py-3 btn-block" id="btn_add_product" value="Add product" />
		                </div>
		          </div>
		        </div>
		        </div>
		      </form>
		    </div>
		  </div>
		  </div>
    </div>

  </main>
  <!-- page-content" -->
</div>
<!-- page-wrapper -->
	<!-- partial -->
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/esm/popper.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.js'></script>
	<script  src="<?php echo $path; ?>js/script.js"></script>
	<script src="<?php echo $path; ?>js/jquery.min.js"></script>
	<script src="<?php echo $path; ?>js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo $path; ?>js/custom.js"></script>

</body>
</html>