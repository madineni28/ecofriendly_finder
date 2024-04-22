<?php
if(!empty($_COOKIE['rahukLogin'])){
	$email = $_COOKIE['rahukLogin'];

	
	$customerd_details = $customer->getCustomersDetails($email);
	
	foreach($customerd_details as $row) {
		extract($row);
		
	}
}
?>
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="<?php echo $path; ?>">Ecofriendly<span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						<li class="nav-item <?php if($page == 'home') { ?> active <?php } ?>">
							<a class="nav-link" href="<?php echo $path; ?>">Home</a>
						</li>
						<li class="nav-item <?php if($page == 'shop') { ?> active <?php } ?>"><a class="nav-link" href="<?php echo $path; ?>shop/">Shop</a></li>
						<li class="nav-item <?php if($page == 'about') { ?> active <?php } ?>"><a class="nav-link" href="#">About us</a></li>
						<li class="nav-item <?php if($page == 'contact') { ?> active <?php } ?>"><a class="nav-link" href="#">Contact us</a></li>
					</ul>

					<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
					<?php if(empty($email)) { ?>
							<li><a class="nav-link" href="<?php echo $path; ?>login/"><img src="<?php echo $path; ?>images/user.svg"></a></li>
					<?php } else { ?>
							<li><a class="nav-link" href="<?php echo $path; ?>login/logout"><?php echo $first_name.' '.$last_name; ?></a></li>
							<li><a class="nav-link" href="<?php echo $path; ?>login/logout.php">Logout</a></li>
					<?php } ?>
						<li><a class="nav-link" href="<?php echo $path; ?>cart/"><img src="<?php echo $path; ?>images/cart_shopping_icon.svg" style="height:30px;width:auto;"><span class="badge" style="background:#f8b810;border-radius:15px;" id="number_of_products"><?php echo $number_of_products; ?></span></a></li>
					</ul>
				</div>
			</div>
				
		</nav>
		<!-- End Header/Navigation -->