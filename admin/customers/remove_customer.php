<?php
ob_start();
	session_start();
		
	//include('connection/function.php');	
	include('../../db_connection/database_connection.php');
	include('../../class/customer.php');


	$db = new DBConnection();
	$database = $db->getConnection();

	$customer = new Customer($database);
	


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    
    $customer->removeCustomer($user_id);

	
}

$data = array(
		'message'   => "Deleted"
	);
echo json_encode($data);
?>
