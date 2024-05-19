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
	
	
    $business_name = $_POST['business_name'];
    $addresss = $_POST['addresss'];
	$business_latitude = $_POST['business_latitude'];
    $business_longitude = $_POST['business_longitude'];
    $description = $_POST['description'];

    // Handle the file upload
    if (isset($_FILES['image_url']['name']) && $_FILES['image_url']['name'] != "") {
        $target_directory = "../../images/businesses/";
        $file = $_FILES['image_url']['name'];
        $path = pathinfo($file);
        $filename = $path['filename'];
        $ext = $path['extension'];
        $temp_name = $_FILES['image_url']['tmp_name'];
        $path_filename_ext = $filename.".".$ext;

        // Check if file already exists
        if (!file_exists($target_directory.$filename.".".$ext)) {
            move_uploaded_file($temp_name, $target_directory.$filename.".".$ext);
            //echo "Congratulations! File Uploaded Successfully.";
        } else {
            //echo "File already exists.";
        }
    }

    $business->addBusiness($business_name, $addresss, $business_latitude, $business_longitude, $description, $path_filename_ext);

	
}
?>
