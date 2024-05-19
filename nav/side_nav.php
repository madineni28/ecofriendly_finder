<?php
if(!empty($_COOKIE['adminLogin'])){
	$email = $_COOKIE['adminLogin'];

	
	$admin_details = $admin->getAdminDetails($email);
	
	foreach($admin_details as $row) {
		extract($row);
		
	}
}
?>
<!-- partial:index.partial.html -->
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container-fluid">
			<!-- Start Product Section -->
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <div class="user-pic">
          <img class="img-responsive img-rounded" src="https://static.vecteezy.com/system/resources/previews/019/879/186/non_2x/user-icon-on-transparent-background-free-png.png"
            alt="User picture">
        </div>
        <div class="user-info">
          <span class="user-name"><?php echo $first_name ?>
            <strong><?php echo $last_name; ?></strong>
          </span>
          <span class="user-role">Sales manager</span>
          <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
          </span>
        </div>
      </div>
      <!-- sidebar-header  -->
      <div class="sidebar-search">
        <div>
          <div class="input-group">
            <input type="text" class="form-control search-menu" placeholder="Search...">
            <div class="input-group-append">
              <span class="input-group-text">
                <i class="fa fa-search" aria-hidden="true"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
      <!-- sidebar-search  -->
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>General</span>
          </li>
          <li class="">
            <a href="./">
              <i class="fa fa-home"></i>
              <span>Home</span>
            </a>
          </li>
		  <li class="sidebar-dropdown">
            <a href="#">
              <i class="far fa-gem"></i>
              <span>Business</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="<?php echo $path; ?>admin/add-business/">Add business</a>
                </li>
                <li>
                  <a href="<?php echo $path; ?>admin/businesses/">Business</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-shopping-cart"></i>
              <span>Products</span>
              <span class="badge badge-pill badge-danger">3</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="<?php echo $path; ?>admin/add-product/">Add product

                  </a>
                </li>
                <li>
                  <a href="<?php echo $path; ?>admin/products/">Product</a>
                </li>
              </ul>
            </div>
          </li>
          
		  <li class="sidebar-dropdown">
            <a href="#">
              <i class="far fa-user"></i>
              <span>Customer</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <!--<li>
                  <a href="<?php //echo $path; ?>add-customer/">Add customer</a>
                </li>-->
                <li>
                  <a href="<?php echo $path; ?>admin/customers/">Customers</a>
                </li>
              </ul>
            </div>
          </li>
		  <li class="sidebar-dropdown">
            <a href="#">
              <i class="far fa-gem"></i>
              <span>Orders</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="<?php echo $path; ?>admin/orders/">Orders</a>
                </li>
                
              </ul>
            </div>
          </li>
         
          
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
      <a href="#">
        <i class="fa fa-shopping-cart"></i>
        <span class="badge badge-pill badge-warning notification" id="number_of_trips"><?php //echo $number_of_trips; ?></span>
      </a>
      <a href="#">
        <i class="fa fa-envelope"></i>
        <span class="badge badge-pill badge-success notification">7</span>
      </a>
      <a href="#">
        <i class="fa fa-cog"></i>
        <span class="badge-sonar"></span>
      </a>
      <a href="<?php echo $path; ?>admin/logout.php">
        <i class="fa fa-power-off"></i>
      </a>
    </div>
  </nav>
  