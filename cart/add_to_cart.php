<?php
ob_start();
	session_start();
		
	include('../class/function.php');
	include('../db_connection/database_connection.php');
	include('../class/cart.php');

	$db = new DBConnection();
	$database = $db->getConnection();

	$cart = new Cart($database);

	$error = "";
	$cart_error = "";
	$number_of_products = "";
	
	
  if(empty($_POST["product_id"])) {
   
			$error .= '<p class="text-danger">Full name is required</p>';
		
		} else {
		
			$product_id = clean_text($_POST["product_id"]);
			$session_id = session_id();
			
			
			
			$no_of_row = $cart->productExists($product_id, $session_id);
		
			if($no_of_row > 0) {
				
				$cart_error .= '<p class="text-danger">Product is already in the cart</p>';
			 
			} else {
				
				$qty = 1;
				
				$cart->add_to_cart($session_id,$product_id,$qty);
			
				$number_of_products .= $cart->productInCart($session_id);
				
				
			}
		
	}
	
	$data = array(
		'error'   => $error,
		'cart_error'   => $cart_error,
		'number_of_products'   => $number_of_products
	);
	echo json_encode($data);
?>