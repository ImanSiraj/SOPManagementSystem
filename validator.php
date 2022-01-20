<?php
	session_start();
	
	if(!ISSET($_SESSION['staff'])){
		header('location:index.php');
	}
?>