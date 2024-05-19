<?php
ob_start();
	session_start();
	
	if(empty($_COOKIE['rahukLogin'])){
        
		header("location:../login/");
		
	}
		
	//include('connection/function.php');	
	include('../db_connection/database_connection.php');
	include('../class/products.php');
	include('../class/customer.php');
	include('../class/cart.php');

	$db = new DBConnection();
	$database = $db->getConnection();

	$product = new Product($database);
	$cart = new Cart($database);
	$customer = new Customer($database);
	
	
	$session_id = session_id();
	
	$number_of_products = $cart->productInCart($session_id);
	
	

	$path = "../";

$page = 'review';

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
		<title>Review :: Ecofriendly</title>
		<!-- Bootstrap CSS -->
		<link href="<?php echo $path; ?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo $path; ?>css/tiny-slider.css" rel="stylesheet">
		<link href="<?php echo $path; ?>css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.13/css/all.css'>	
		
	</head>

	<body>

		<?php include("../nav/nav.php"); ?>
		<nav class="breadcrumbs">
			<ul>
			  <li><a href="../orders">My Orders</a></li>
			  <li>Review</li>
			</ul>
		</nav>

		<div class="untree_co-section before-footer-section">
		
            <div class="container">
              <div class="row mb-5" style="margin-top:40px;">
			  <form class="col-md-12" method="post" id="review_product" enctype="multipart/form-data">
                <div class="form-group row mb-3" >
				<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>" />
				<input type="hidden" name="product_id" id="product_id" value="<?php echo $_GET['product']; ?>" />
				<label for="trip_price" class="text-black">Rating <span class="text-danger">*</span></label>
		              <div class="rate">
						<input type="radio" id="star5" name="rate" value="5" />
						<label for="star5" title="text">5 stars</label>
						<input type="radio" id="star4" name="rate" value="4" />
						<label for="star4" title="text">4 stars</label>
						<input type="radio" id="star3" name="rate" value="3" />
						<label for="star3" title="text">3 stars</label>
						<input type="radio" id="star2" name="rate" value="2" />
						<label for="star2" title="text">2 stars</label>
						<input type="radio" id="star1" name="rate" value="1" />
						<label for="star1" title="text">1 star</label>
					  </div>
		            </div>
					<div class="form-group row mb-3">
		              <div class="col-md-12">
		                <label for="trip_price" class="text-black">Comment <span class="text-danger">*</span></label>
		                <textarea class="form-control" id="comment" name="comment"  required style="height:200px;"></textarea>
		              </div>
					 
		            </div>
		            
					<span id="message"></span>
				<div class="form-group mb-3" >
		                 <input type="submit" class="btn btn-success btn-sm py-3 btn-block" id="btn_review_product" value="Review" />
		                </div>
                  </form>
              </div>
        
            </div>
          </div>
		<script src="<?php echo $path; ?>js/jquery.min.js"></script>
		<script src="<?php echo $path; ?>js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo $path; ?>js/custom.js"></script>
	</body>
</html>
