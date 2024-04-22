<?php
ob_start();
	session_start();
		
	include('../class/function.php');
	include('../db_connection/database_connection.php');
	include('../class/products.php');
	include('../class/customer.php');
	include('../class/cart.php');

	$db = new DBConnection();
	$database = $db->getConnection();

	$product = new Product($database);
	$cart = new Cart($database);
	$customer = new Customer($database);

	$message = "";
	$error = "";
	
	$session_id = session_id();
		
	
	if(empty($_POST["email_address"])) {
   
		$mail_error .= '<p class="text-danger">Email is required</p>';
	
	} else {
		$email_address = clean_text($_POST["email_address"]);
	}
	
	if(empty($_POST["account_password"])) {
   
		$pass_error .= '<p class="text-danger">Password is required</p>';
	
	} else {
		
		$account_password = clean_text($_POST["account_password"]);
	}
	if(!empty($email_address) && !empty($account_password)){
		$email_address = convert_string('encrypt',$email_address);
		$account_password = convert_string('encrypt',$account_password);
															
		$success = $customer->login($email_address,$account_password);
		
		if($success > 0){
			$now = date('Y-m-d H:i:s');
			
			$customerd_details = $customer->getCustomersDetails($email_address);
				
				foreach($customerd_details as $row) {
					extract($row);
					
				}
														
			$costs = $cart->subTotal($session_id);
			foreach($costs as $row) {
				extract($row);
				 
			
			}
			$session_id = session_id();
			$order_id = rand(12,12000);
			
			$product->order($order_id,$now,$user_id,$subtotal);
			
			$images_in_cart = $cart->getProductInCart($session_id);
			foreach($images_in_cart as $row) {
				extract($row);
				
				$product->orderDetails($order_id,$qty,$product_id);
				$cart->emptyCart($session_id,$product_id);
			
			}
															
			setcookie("rahukLogin", $email_address, time()+(86400 * 7),"/");
		
		} else {
														
			$error .= '<div class="alert alert-danger"><strong>Error!</strong> Wrong password or email</div>';
			
		}
	} else {
		
		$error .= '<div class="alert alert-danger"><strong>Error!</strong> Empty</div>';
	}
														

	$data = array(
		'error'   => $error
	);
echo json_encode($data);
?>