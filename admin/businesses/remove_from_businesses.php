<?php
ob_start();
	session_start();
		
	//include('connection/function.php');	
	include('../../db_connection/database_connection.php');
	include('../../class/businesses.php');


	$db = new DBConnection();
	$database = $db->getConnection();

	$business = new Business($database);
	


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $business_id = $_POST['business_id'];
    
	
	$business->removeProductsByBusinessId($business_id);
    $business->removeBusiness($business_id);
	

	
}
$data = array(
		'message'   => "Deleted"
	);
echo json_encode($data);
?>
