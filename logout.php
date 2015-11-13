<?php
	session_start();
	
		// to avoid the notice in php
	error_reporting(E_ALL ^ E_NOTICE);
	
	if((isset($_SESSION['CurrentUserId'])) == true)
	{
		echo "Thanks " . $SESSION['CurrentUserId'] . ", you have logged out successfully";
	
	session_destroy(); //session destroy
	}else{
		
		echo "You haven't logged in";
	}
?>