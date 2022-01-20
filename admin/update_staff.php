<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['update'])){
		$id = $_POST['stud_id'];
		$staff_no = $_POST['staff_no'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = md5($_POST['password']);
		
		mysqli_query($conn, "UPDATE `staff` SET `staff_no` = '$stud_no', `firstname` = '$firstname', `lastname` = '$lastname',`password` = '$password' WHERE `id` = '$stud_id'") or die(mysqli_error());
		
		echo "<script>alert('Successfully updated!')</script>";
		echo "<script>window.location = 'staff.php'</script>";
	}
?>