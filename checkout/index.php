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

$page = 'checkout';

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
		<title>Checkout :: Ecofriendly </title>
		<!-- Bootstrap CSS -->
		<link href="<?php echo $path; ?>css/bootstrap.min.css" rel="stylesheet">
		
		<link href="<?php echo $path; ?>css/style.css" rel="stylesheet">
	</head>

	<body>

		<?php include("../nav/nav.php"); ?>

		

		<div class="untree_co-section">
		    <div class="container">
		      <div class="row mb-5">
		        <div class="col-md-12">
		          <div class="border p-4 rounded" role="alert">
		            Returning customer? <a href="../login/">Click here</a> to login
		          </div>
		        </div>
		      </div>
			  <form class="col-md-12" method="post" id="checkout_frm">
		      <div class="row">
		        <div class="col-md-6 mb-5 mb-md-0">
		          <h2 class="h3 mb-3 text-black">Billing Details</h2>
		          <div class="p-3 p-lg-5 border bg-white">
		            
		            <div class="form-group row">
		              <div class="col-md-6">
		                <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_fname" name="c_fname" value="" required >
						<span id="f_error"></span>
		              </div>
		              <div class="col-md-6">
		                <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_lname" name="c_lname" value="" required >
						<span id="l_error"></span>
		              </div>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-12">
		                <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address" value="" required >
						<span id="a_error"></span>
		              </div>
		            </div>
		            <div class="form-group row">
		              <div class="col-md-6">
		                <label for="c_state_country" class="text-black">State <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_state_country" name="c_state_country" value="" required >
						<span id="e_error"></span>
		              </div>
		              <div class="col-md-6">
		                <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip" value="" required >
						<span id="p_error"></span>
		              </div>
		            </div>

		            <div class="form-group row mb-5">
		              <div class="col-md-6">
		                <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_email_address" name="c_email_address" value="" required >
						<span id="mail_error"></span>
		              </div>
		              <div class="col-md-6">
		                <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number" value="" required >
						<span id="pno_error"></span>
		              </div>
		            </div>
					<div class="form-group row mb-5">
		              <div class="col-md-6">
		                <label for="c_email_address" class="text-black">Account Password <span class="text-danger">*</span></label>
		                <input type="password" class="form-control" id="c_account_password" name="c_account_password" placeholder="" value="" required >
		              </div>
		              <div class="col-md-6">
		                <label for="c_phone" class="text-black">Account Confirm Password <span class="text-danger">*</span></label>
		                <input type="password" class="form-control" id="c_confirm_account_password" name="c_confirm_account_password" placeholder="" value="" required >
						
		              </div>
					  <span id="pass_error"></span>
		            </div>

		          </div>
		        </div>
		        <div class="col-md-6">

					
		          <div class="row mb-5">
		            <div class="col-md-12">
		              <h2 class="h3 mb-3 text-black">Your Order</h2>
		              <div class="p-3 p-lg-5 border bg-white">
		                <table class="table site-block-order-table mb-5">
		                  <thead>
		                    <th>Product</th>
		                    <th>Total</th>
		                  </thead>
		                  <tbody>
							<?php

							$products = $cart->getProductInCart($session_id);
							$i = 0;
							foreach($products as $row) {
										extract($row);
										$i++;
							?>
		                    <tr>
		                      <td><?php echo $name; ?><strong class="mx-2">x</strong><?php echo $qty; ?></td>
		                      <td>£<?php echo $product_price; ?></td>
		                    </tr>
							<?php }  
							$costs = $cart->subTotal($session_id);
							foreach($costs as $row) {
								extract($row);
								 
							
							}
						  
						  ?>
		                    
		                    <tr>
		                      <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
		                      <td class="text-black font-weight-bold"><strong>£<?php echo $subtotal; ?></strong></td>
		                    </tr>
		                  </tbody>
		                </table>
						<div id="message"></div>
						<div id="cart_error"></div>
		                <div class="form-group">
		                  <input type="submit" class="btn btn-warning btn-sm py-3 btn-block" id="btn_checkout" value="Place Order" />
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