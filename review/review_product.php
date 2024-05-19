<?php
ob_start();
	session_start();
	
	include('../db_connection/database_connection.php');

	include('../class/products.php');

	$db = new DBConnection();
	$database = $db->getConnection();

	$product = new Product($database);
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$product_id = $_POST['product_id'];
	$user_id = $_POST['user_id'];
	$rate = $_POST['rate'];
	$comment = $_POST['comment'];
	
	
	$count = $product->checkIfReviewed($product_id,$user_id);

	if($count == 0){
	
		$product->reviewProduct($product_id, $user_id, $rate, $comment);
	}

}
	
?>