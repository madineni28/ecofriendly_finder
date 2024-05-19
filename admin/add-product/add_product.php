<?php
ob_start();
	session_start();
	
	include('../../db_connection/database_connection.php');

	include('../../class/products.php');

	$db = new DBConnection();
	$database = $db->getConnection();

	$product = new Product($database);
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$business_id = $_POST['business_id'];
	$category_id = $_POST['category_id'];
	$product_name = $_POST['product_name'];
	$product_price = $_POST['product_price'];
	$description = $_POST['description'];

	$product_id = rand(1,2300);

	
	// Handle the file upload
    if (isset($_FILES['image_url']['name']) && $_FILES['image_url']['name'] != "") {
        $target_directory = "../../images/";
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
	
	
	$product->addProduct($product_id, $business_id, $category_id, $product_name, $product_price, $description);


	$product->addImage($product_id, $path_filename_ext);
}
	
?>