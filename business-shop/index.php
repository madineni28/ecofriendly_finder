<?php
ob_start();
	session_start();
		
	include('../class/function.php');	
	include('../db_connection/database_connection.php');
	include('../class/products.php');
	include('../class/businesses.php');
	include('../class/customer.php');
	include('../class/cart.php');

	$db = new DBConnection();
	$database = $db->getConnection();

	$product = new Product($database);
	$business = new Business($database);
	$cart = new Cart($database);
	$customer = new Customer($database);
	
	$session_id = session_id();
	
	$number_of_products = $cart->productInCart($session_id);
	
	$business_id = clean_text($_GET['id']);
	
	$businesses = $business->selectBusinessById($business_id);
	
	foreach($businesses as $row) {
			extract($row);
		//$business_name = $name;
	}

	$path = "../";

$page = 'business-shop';

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
		<title><?php echo $name; ?> :: Ecofriendly </title>
		<!-- Bootstrap CSS -->
		<link href="<?php echo $path; ?>css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
		<link href="<?php echo $path; ?>css/style.css" rel="stylesheet">
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.13/css/all.css'>
	</head>

	<body>

		<?php include("../nav/nav.php"); ?>
		

	
		<nav class="breadcrumbs">
					<ul>
					  <li><a href="../">Home</a></li>
					  <li><a href="../business-shop/?id=<?php echo $business_id; ?>"><?php echo $name; ?></a></li>
					  <li>Products</li>
					</ul>
				</nav>
		<div class="untree_co-section product-section" style="margin-top:20px;">
		    <div class="container">
				
		      	<div class="row">

		      		<?php
					$products = $product->selectProductsByBusinessID($business_id);
	
						foreach($products as $row) {
							extract($row);
					
					?>
					<!-- Start Column 2 -->
					<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
						<div class="product-item" >
							<img src="../images/<?php echo $img_url; ?>" class="img-fluid product-thumbnail">
							<h3 class="product-title"><?php echo $name; ?></h3>
							
							<?php
								$reviews = $product->getRatings($product_id);
								
								foreach ($reviews as $review){
									
									$fullStars = floor($review['rating']);
									$halfStar = ($review['rating'] - $fullStars) >= 0.5 ? 1 : 0;
									
									for ($i = 0; $i < $fullStars; $i++) {
										echo '<i class="fa fa-star" style="color: #c59b08;"></i>';
									}
									if ($halfStar) {
										echo '<i class="fa fa-star-half" style="color: #c59b08;"></i>';
									}
									
								}
									?>
							<br/>
							<strong class="product-price">£ <?php echo $product_price; ?></strong>
							<input type="hidden" id="product_id " value="<?php echo $product_id ; ?>" />
							<span class="icon-cross">
								 <a id="add_to_cart_shop" onclick="add_to_cart_shop(<?php echo $product_id ; ?>)"><img src="<?php echo $path; ?>images/add_icon.svg" class="img-fluid" style="height:20px;width:auto;"></a>
							</span>
						</div>
					</div> 
					<?php } ?>
		      	</div>
		    </div>
		</div>
		<script src="<?php echo $path; ?>js/jquery.min.js"></script>
		<script src="<?php echo $path; ?>js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo $path; ?>js/custom.js"></script>
	</body>
</html>