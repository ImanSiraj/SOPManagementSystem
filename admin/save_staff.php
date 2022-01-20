<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['save'])){
		$staff_no = $_POST['staff_no'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$gender = $_POST['division'];
		$password = md5($_POST['password']);
		
		mysqli_query($conn, "INSERT INTO `staff` VALUES('', '$staff_no', '$firstname', '$lastname', '$division', '$password')") or die(mysqli_error());
		
		header('location: staff.php');
	}
?>