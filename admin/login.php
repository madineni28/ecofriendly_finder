<?php
ob_start();
	session_start();
		
	include('../class/function.php');
	include('../db_connection/database_connection.php');
	include('../class/admin.php');

	$db = new DBConnection();
	$database = $db->getConnection();

	$admin = new Admin($database);
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
															
		$success = $admin->login($email_address,$account_password);
		
		if($success > 0){
			
															
			setcookie("adminLogin", $email_address, time()+(86400 * 7),"/");
		
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