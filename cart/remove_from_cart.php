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
	$message = "";
	$number_of_products = "";
	$sub_total = "";
	
	
  if(empty($_POST["img_id"])) {
   
			$error .= '<p class="text-danger">Full name is required</p>';
		
		} else {
		
			$img_id = clean_text($_POST["img_id"]);
			$session_id = session_id();
			
			$cart->remove_from_cart($session_id,$img_id);
			
				$costs = $cart->subTotal($session_id);
				foreach($costs as $row) {
					extract($row);
					$sub_total .= $subtotal; 
				
				}
				
			
				$number_of_products .= $cart->productInCart($session_id);
				
			$message .= '<div class="alert alert-danger"><strong>Success!</strong> Product removed from cart</div>';
		
	}
	
	$data = array(
		'sub_total'   => $sub_total,
		'message'   => $message,
		'number_of_products'   => $number_of_products
	);
	echo json_encode($data);
?>