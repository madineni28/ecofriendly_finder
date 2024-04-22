<?php
ob_start();
	session_start();
		
	//include('connection/function.php');	
	include('db_connection/database_connection.php');
	include('class/images_products.php');
	include('class/products.php');
	include('class/businesses.php');
	include('class/customer.php');
	include('class/cart.php');

	$db = new DBConnection();
	$database = $db->getConnection();

	$product = new Product($database);
	$business = new Business($database);
	$cart = new Cart($database);
	$customer = new Customer($database);
	
	$session_id = session_id();
	
	$number_of_products = $cart->productInCart($session_id);

	$path = "";

$page = 'home';

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <!--<link rel="shortcut icon" href="favicon.png">-->

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />
		<title>Home :: Ecofriendly </title>
		<!-- Bootstrap CSS -->
		<link href="<?php echo $path; ?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo $path; ?>css/style.css" rel="stylesheet">
	</head>

	<body>

		<?php include("nav/nav.php"); ?>

		
		<!-- Start Product Section -->
		<div class="map-section" style="background:#fff;">
					
					<div id="map-canvas"></div>
				
		</div>
		<!-- Start Product Section -->
		<div class="product-section">
			<div class="container" style="margin-top:20px;">
				<div class="row">

					<!-- Start Column 1 -->
					<div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
						<h2 class="mb-4 section-title">Get the best ecofriendly products</h2>
						<p class="mb-4">Pictures for sale are landmarks within the Old Royal Naval College</p>
						<p><a href="Shop/" class="btn btn-success">Explore</a></p>
					</div> 
					<!-- End Column 1 -->
					<?php
					$products = $product->selectProducts();
	
						foreach($products as $row) {
							extract($row);
					
					?>
					<!-- Start Column 2 -->
					<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
						<div class="product-item" >
							<img src="images/<?php echo $img_url; ?>" class="img-fluid product-thumbnail">
							<h3 class="product-title"><?php echo $name; ?></h3>
							<strong class="product-price">£ <?php echo $product_price; ?></strong>
							<input type="hidden" id="product_id " value="<?php echo $product_id ; ?>" />
							<span class="icon-cross">
								 <a id="add_to_cart" onclick="add_to_cart(<?php echo $product_id ; ?>)"><img src="images/add_icon.svg" class="img-fluid" style="height:20px;width:auto;"></a>
							</span>
						</div>
					</div> 
					<?php } ?>
					
				</div>
			</div>
		</div>
		<script  src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCPBqSTfQAmJphaAuuBNFf9iNAvpEmjuOc&amp;libraries=places'></script>
		<script src="<?php echo $path; ?>js/jquery.min.js"></script>
		<script src="<?php echo $path; ?>js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo $path; ?>js/custom.js"></script>
		<script src="<?php echo $path; ?>js/map_function.js"></script>
		
	</body>
</html>
