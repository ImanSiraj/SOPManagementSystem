<?php
	session_start();
	require 'admin/conn.php';
	
	if(ISSET($_POST['login'])){
		$staff_no = $_POST['staff_no'];
		$password = md5($_POST['password']);
		
		$query = mysqli_query($conn, "SELECT * FROM `staff` WHERE `staff_no` = '$staff_no' && `password` = '$password'") or die(mysqli_error());
		$fetch = mysqli_fetch_array($query);
		$row = $query->num_rows;
		
		if($row > 0){
			$_SESSION['staff'] = $fetch['id'];
			header("location:staff_profile.php");
		}else{
			echo "<center><label class='text-danger'>Invalid username or password</label></center>";
		}
	}
?>