<?php
session_start();
	
setcookie("rahukLogin", "", time()-(86400 * 15),"/");

header("location: ../");
	
	
?>