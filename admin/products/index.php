<?php
ob_start();
	session_start();
	
	if(empty($_COOKIE['adminLogin'])){
        
		header("location:../login/");
		
	}
		
	//include('connection/function.php');	
	include('../../db_connection/database_connection.php');
	include('../../class/admin.php');
	include('../../class/businesses.php');
	include('../../class/customer.php');
	include('../../class/products.php');

	$db = new DBConnection();
	$database = $db->getConnection();

	$admin = new Admin($database);
	$business = new Business($database);
	$product = new Product($database);
	$customer = new Customer($database);
	
	$session_id = session_id();
	


	$path = "../../";

$page = 'cart';

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />
		<title>Products :: EcoFinder</title>
		
		<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css'>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.13/css/all.css'>
		<!-- Bootstrap CSS -->
		<link href="<?php echo $path; ?>css/bootstrap.min.css" rel="stylesheet">
		
		<link href="<?php echo $path; ?>css/style.css" rel="stylesheet">
		
	</head>

	<body>

		<?php include($path."nav/side_nav.php"); ?>

		<div class="untree_co-section">
		
            <div class="container">
			<form class="col-md-12" method="post" id="update_cart">
              <div class="row mb-5">
                <span id="message"></span>
                  <div class="site-blocks-table">
                    <table class="table">
                      <thead>
                        <tr>
                          <th class="product-thumbnail">Image</th>
                          <th class="product-name">Name</th>
                          <th class="product-price">Price</th>
                          <th class="product-total">Description</th>
                          <th class="product-remove">Action</th>
                        </tr>
                      </thead>
                      <tbody>
						<?php
							
							$products = $product->selectProducts();
							
							if(count($products) == 0){
								echo '<tr><div class="alert alert-danger"><strong>Error!</strong> It is empty   </div></tr>';
							}
							$i = 0;
							foreach($products as $row) {
										extract($row);
										$i++;
						?>
                        <tr id="product_id<?php echo $product_id; ?>">
                          <td class="product-thumbnail">
                            <img src="<?php echo $path; ?>images/<?php echo $img_url; ?>" alt="Image" class="img-fluid">
                          </td>
                          <td class="product-name">
                            <h2 class="h5 text-black"><?php echo $name; ?></h2>
                          </td>
                          <td>£<?php echo $product_price; ?></td>
                          
                          <td><?php echo $description; ?></td>
                          <td><a class="btn btn-black btn-sm" onclick="remove_from_product(<?php echo $product_id; ?>)">X</a></td>
						  <td><a class="btn btn-black btn-sm" onclick="edit_product(<?php echo $product_id; ?>)">Edit</a></td>
                        </tr>
							<?php 
							
							} ?>
                       </tbody>
                    </table>
                  </div>
                
              </div>
        
              
			  </form>
            </div>
          </div>
		  </div>
    </div>

  </main>
  <!-- page-content" -->
</div>
<!-- page-wrapper -->
	<!-- partial -->
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/esm/popper.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.js'></script>
	<script  src="<?php echo $path; ?>js/script.js"></script>
	<script src="<?php echo $path; ?>js/jquery.min.js"></script>
	<script src="<?php echo $path; ?>js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo $path; ?>js/custom.js"></script>

</body>
</html>