<?php
ob_start();
	session_start();
		
	//include('connection/function.php');	
	include('../../db_connection/database_connection.php');
	include('../../class/products.php');


	$db = new DBConnection();
	$database = $db->getConnection();

	$product = new Product($database);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    
    $product->removeProductImage($product_id);
    $product->removeProduct($product_id);

	
}
$data = array(
		'message'   => "Deleted"
	);
echo json_encode($data);
?>
