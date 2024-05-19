<?php
ob_start();
	session_start();
		
	include('../class/function.php');	
	include('../db_connection/database_connection.php');

	include('../class/trips.php');

	$db = new DBConnection();
	$database = $db->getConnection();

	$trip = new Trip($database);
	


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $deal_id = $_POST['deal_id'];
    
    $trip->removeTripDeal($deal_id);
	$trip->removeTripByDealId($deal_id);

	
}
?>
