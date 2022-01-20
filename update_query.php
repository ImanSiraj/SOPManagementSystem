<?php
	require_once 'admin/conn.php';
	
	if(ISSET($_POST['update'])){
		$id = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$gender = $_POST['gender'];
		$yrsec = $_POST['year']."".$_POST['section'];
		$password = md5($_POST['password']);
		
		mysqli_query($conn, "UPDATE `staff` SET `firstname`='$firstname', `lastname`='$lastname', `gender`='$gender', `yr&sec`='$yrsec', `password`='$password' WHERE `id`='$id' ") or die(mysqli_error());
		
		header('location: staff_profile.php');
	}
?>