<?php
ob_start();
	session_start();
	
	if(!empty($_COOKIE['adminLogin'])){
        
		header("location:../add-business/");
		
	}
		
	//include('connection/function.php');	
	include('../db_connection/database_connection.php');
	include('../class/customer.php');
	include('../class/cart.php');

	$db = new DBConnection();
	$database = $db->getConnection();

	$cart = new Cart($database);
	$customer = new Customer($database);
	

	

	$path = "../";

$page = 'login';

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
		<title>Admin Login :: Ecofriendly </title>	
		<!-- Bootstrap CSS -->
		<link href="<?php echo $path; ?>css/bootstrap.min.css" rel="stylesheet">
		
		<link href="<?php echo $path; ?>css/style.css" rel="stylesheet">
		
	</head>

	<body>

		<?php //include("../nav/nav.php"); ?>

		

		<div class="untree_co-section">
		    <div class="container">
		     
			 
		      <div class="row" style="margin:auto;">
		        <div class="col-md-6 mb-5 mb-md-0">
		          <h2 class="h3 mb-3 text-black">Admin Login</h2>
		          <div class="p-3 p-lg-5 border bg-white">
		             <form class="col-md-12" method="post" id="admin_login">
		            <div id="response"></div>
		            <div class="form-group mb-5">
		                <label for="email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
		                <input type="text" class="form-control" id="email_address" name="email_address" value="kingjonce@gmail.com" required >
						<span id="mail_error"></span>
		              
		            </div>
					<div class="form-group mb-5">
		                <label for="account_password" class="text-black">Password <span class="text-danger">*</span></label>
		                <input type="password" class="form-control" id="account_password" name="account_password" placeholder="" value="13541545" required >
					  <span id="pass_error"></span>
		            </div>
					<div class="form-group mb-5">
		                  <input type="submit" class="btn btn-warning btn-sm py-3 btn-block" id="btn_admin_login" value="Login" />
		                </div>
					 </form>
		          </div>
		        </div>
				</div>
		     
		    </div>
		  </div>
		<script src="<?php echo $path; ?>js/jquery.min.js"></script>
		<script src="<?php echo $path; ?>js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo $path; ?>js/custom.js"></script>
	</body>
</html>