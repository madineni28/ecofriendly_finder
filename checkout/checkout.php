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
	
	$session_id = session_id();

	$f_error = "";
	$l_error = "";
	$a_error = "";
	$e_error = "";
	$p_error = "";
	$mail_error = "";
	$pno_error = "";
	$pass_error = "";
	$message = "";
	$cart_error = "";
	
	$session_id = session_id();
	
	$products_in_cart = $cart->productInCart($session_id);	
	
	if($products_in_cart > 0){
		
		if(empty($_POST["c_fname"])) {
	   
				$f_error .= '<p class="text-danger">First name is required</p>';
		
		} else {
			$c_fname = clean_text($_POST["c_fname"]);
		}
			if(empty($_POST["c_lname"])) {
		   
					$l_error .= '<p class="text-danger">First name is required</p>';
			
			} else {
				$c_lname = clean_text($_POST["c_lname"]);
			}
				if(empty($_POST["c_address"])) {
			   
						$a_error .= '<p class="text-danger">Address is required</p>';
				
				} else {
					$c_address = clean_text($_POST["c_address"]);
				}
					if(empty($_POST["c_state_country"])) {
				   
							$e_error .= '<p class="text-danger">State is required</p>';
					
					} else {
						$c_state_country = clean_text($_POST["c_state_country"]);
					}
					
						if(empty($_POST["c_postal_zip"])) {
					   
								$p_error .= '<p class="text-danger">Zip code is required</p>';
						
						} else {
							$c_postal_zip = clean_text($_POST["c_postal_zip"]);
						}
							if(empty($_POST["c_email_address"])) {
						   
									$mail_error .= '<p class="text-danger">Email is required</p>';
							
							} else {
								$c_email_address = clean_text($_POST["c_email_address"]);
							}
								if(empty($_POST["c_phone"])) {
							   
										$pno_error .= '<p class="text-danger">Phone number is required</p>';
								
								} else {
									$c_phone = clean_text($_POST["c_phone"]);
								}
		
									if(empty($_POST["c_account_password"])) {
								   
											$pass_error .= '<p class="text-danger">Password is required</p>';
									
									} else {
										
										if(empty($_POST["c_confirm_account_password"])) {
								   
											$pass_error .= '<p class="text-danger">Confirmation is required</p>';
									
										} else {
											$c_confirm_account_password = clean_text($_POST["c_confirm_account_password"]);
											
											$c_account_password = clean_text($_POST["c_account_password"]);
											
											if($c_confirm_account_password == $c_account_password){
												
												if(strlen($c_account_password) >= 8){
													
													$c_email_address = convert_string('encrypt',$c_email_address);
													
													$no_email = $customer->emailExists($c_email_address);
										
													if($no_email > 0) {
														
														$mail_error .= '<p class="text-danger">Email already exists</p>';
													 
													} else {
														
														$customer_id = rand(12,12000);
														
														$now = date('Y-m-d H:i:s');
														
														$c_account_password = convert_string('encrypt',$c_account_password);
														$c_phone = convert_string('encrypt',$c_phone);
														
														$customer->register($customer_id,$c_fname,$c_lname,$c_address,$c_state_country,$c_postal_zip,$c_email_address,$c_phone,$c_account_password);
														
														$costs = $cart->subTotal($session_id);
														foreach($costs as $row) {
															extract($row);
															 
														
														}
														
														$order_id = rand(12,12000);
														
														$product->order($order_id,$now,$customer_id,$subtotal);
														
														$products_in_cart = $cart->getProductInCart($session_id);
														foreach($products_in_cart as $row) {
															extract($row);
															
															$product->orderDetails($order_id,$qty,$product_id);
															$cart->emptyCart($session_id,$product_id);
														
														}
														
														
														
														$message .= '<div class="alert alert-success"><strong>Success!</strong> Account created</div>';
													}
													
												} else {
													
													$pass_error .= '<p class="text-danger">Password should be 8 characters or more</p>';
													
												}
												
											} else {
												
												$pass_error .= '<p class="text-danger">Password do not match</p>';
											}
										}
										
								}
	} else {
		$cart_error .= '<div class="alert alert-danger"><strong>Error!</strong> Cart is empty   <a style="text-decoration: none;" href="../Shop/">Shop</a></div>';
	}

	$data = array(
		'f_error'   => $f_error,
		'l_error'   => $l_error,
		'a_error'   => $a_error,
		'e_error'   => $e_error,
		'p_error'   => $p_error,
		'mail_error'   => $mail_error,
		'pno_error'   => $pno_error,
		'pass_error'   => $pass_error,
		'cart_error'   => $cart_error,
		'message'   => $message
	);
echo json_encode($data);
?>