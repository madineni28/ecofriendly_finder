<?php
session_start();
	
setcookie("adminLogin", "", time()-(86400 * 15),"/");

header("location: ../");
	
	
?>