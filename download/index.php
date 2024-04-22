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

$page = 'cart';

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
		<title>Downloads :: Greenwich Landmark </title>
		<!-- Bootstrap CSS -->
		<link href="<?php echo $path; ?>css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo $path; ?>css/tiny-slider.css" rel="stylesheet">
		<link href="<?php echo $path; ?>css/style.css" rel="stylesheet">
		
	</head>

	<body>

		<?php include("../nav/nav.php"); ?>

		<div class="untree_co-section before-footer-section">
		
            <div class="container">
              <div class="row mb-5">
                
                  <div class="site-blocks-table">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="product-thumbnail">Product</th>
						  <th class="product-name">Order Date</th>
                          <th class="product-name">Name</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php
							
							$products = $product->getOrderedProduct($user_id);
							
							if(count($products) == 0){
								echo '<tr><div class="alert alert-danger"><strong>Error!</strong> No order   <a style="text-decoration: none;" href="../Shop/">Shop</a></div></tr>';
							}
							$i = 0;
							foreach($products as $row) {
										extract($row);
										$i++;
						?>
                        <tr id="img_id<?php echo $product_id; ?>">
                          <td class="product-thumbnail">
                            <img src="<?php echo $path; ?>images/<?php echo $img_url; ?>" alt="Image" class="img-fluid">
                          </td>
						  <td class="product-name">
                            <?php echo $order_date; ?>
                          </td>
                          <td class="product-name">
                            <a href="#" download style="text-decoration:none;"><?php echo $name; ?></a>
                          </td>
                          
                        </tr>
							<?php 
							
							} ?>
                       </tbody>
                    </table>
                  </div>
                
              </div>
        
            </div>
          </div>
		<script src="<?php echo $path; ?>js/jquery.min.js"></script>
		<script src="<?php echo $path; ?>js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo $path; ?>js/custom.js"></script>
	</body>
</html>
