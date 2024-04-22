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
	
		
		$session_id = session_id();
		
		$number_of_products = $cart->productInCart($session_id);
		
		for($i=1;$i<=$number_of_products;$i++){
			
			$quantity_str = "quantity".$i;
			$img_id_str = "img_id".$i;
			
			$quantity = clean_text($_POST[$quantity_str]);
			$img_id = clean_text($_POST[$img_id_str]);
			
			$cart->update_cart($session_id,$img_id,$quantity);
			
		}
		
		$costs = $cart->subTotal($session_id);
		foreach($costs as $row) {
			extract($row);
			$sub_total .= $subtotal; 
		
		}
		
		$message .= '<div class="alert alert-success"><strong>Success!</strong> Cart updated</div>';

	
	
	$data = array(
		'sub_total'   => $sub_total,
		'message'   => $message,
		'number_of_products'   => $number_of_products
	);
	echo json_encode($data);
?>