<?php
ob_start();
	session_start();
		
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
		<title>Cart :: Ecofriendly</title>
		<!-- Bootstrap CSS -->
		<link href="<?php echo $path; ?>css/bootstrap.min.css" rel="stylesheet">
		
		<link href="<?php echo $path; ?>css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
		
	</head>

	<body>

		<?php include("../nav/nav.php"); ?>
		<nav class="breadcrumbs">
			<ul>
			  <li><a href="../">Home</a></li>
			  <li>Cart</li>
			</ul>
		</nav>
		<div class="untree_co-section">
		
            <div class="container">
			<form class="col-md-12" method="post" id="update_cart">
              <div class="row mb-5">
                
                  <div class="site-blocks-table">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="product-thumbnail">Image</th>
                          <th class="product-name">Product</th>
                          <th class="product-price">Price</th>
                          <th class="product-quantity">Quantity</th>
                          <th class="product-total">Total</th>
                          <th class="product-remove">Remove</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php
							
							$products = $cart->getProductInCart($session_id);
							
							if(count($products) == 0){
								echo '<tr><div class="alert alert-danger"><strong>Error!</strong> Cart is empty   <a style="text-decoration: none;" href="../Shop/">Shop</a></div></tr>';
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
                            <h2 class="h5 text-black"><?php echo $name; ?></h2>
                          </td>
                          <td>£<?php echo $product_price; ?></td>
                          <td>
                            <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                              <div class="input-group-prepend">
                                <button class="btn btn-outline-black decrease" type="button">&minus;</button>
                              </div>
                              <input type="text" class="form-control text-center quantity-amount" value="<?php echo $qty; ?>" name="quantity<?php echo $i; ?>" aria-label="Example text with button addon" aria-describedby="button-addon1">
							  
							 
                              <div class="input-group-append">
                                <button class="btn btn-outline-black increase" type="button">&plus;</button>
                              </div>
                            </div>
							<input type="hidden" class="form-control" name="img_id<?php echo $i; ?>" value="<?php echo $product_id; ?>">
        
                          </td>
                          <td>£<?php echo ($product_price * $qty); ?></td>
                          <td><a class="btn btn-black btn-sm" onclick="remove_from_cart(<?php echo $product_id; ?>)">X</a></td>
                        </tr>
							<?php 
							
							} ?>
                       </tbody>
                    </table>
                  </div>
                
              </div>
        
              <div class="row">
			  <div id="response"></div>
                <div class="col-md-6">
                  <div class="row mb-5">
                    <div class="col-md-6 mb-3 mb-md-0">
                      <input type="submit" class="btn btn-info btn-sm btn-block" id="update_cart_btn" value="Update Cart"/>
                    </div>
                    <div class="col-md-6">
                      <a class="btn btn-sm btn-block btn-primary" href="<?php echo $path; ?>shop/">Continue Shopping</a>
                    </div>
                  </div>
                  
                </div>
                <div class="col-md-6 pl-5">
                  <div class="row justify-content-end">
                    <div class="col-md-7">
                      <div class="row">
                        <div class="col-md-12 text-right border-bottom mb-5">
                          <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <span class="text-black">Subtotal</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black">£<span id="sub_total"><?php 
						  $costs = $cart->subTotal($session_id);
							foreach($costs as $row) {
								extract($row);
								echo $subtotal; 
							
							}
						  
						  ?></span></strong>
                        </div>
                      </div>
                      <div class="row mb-5">
                        <div class="col-md-6">
                          <span class="text-black">Total</span>
                        </div>
                        <div class="col-md-6 text-right">
                          <strong class="text-black">£<span id="sub_total2"><?php echo $subtotal; ?></span></strong>
                        </div>
                      </div>
        
                      <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-warning btn-sm py-3 btn-block" onclick="window.location='<?php echo $path; ?>checkout/'" style="<?php if(count($products) == 0){ ?>pointer-events: none; <?php } ?>">Proceed To Checkout</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
			  </form>
            </div>
          </div>
		<script src="<?php echo $path; ?>js/jquery.min.js"></script>
		<script src="<?php echo $path; ?>js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo $path; ?>js/custom.js"></script>
	</body>
</html>
