<?php
	require_once 'admin/conn.php';
	if(ISSET($_POST['store_id'])){
		$store_id = $_POST['store_id'];
		$query = mysqli_query($conn, "SELECT * FROM `storage` WHERE `store_id` = '$store_id'") or die(mysqli_error());
		$fetch  = mysqli_fetch_array($query);
		$filename = $fetch['filename'];
		$staff_no = $fetch['staff_no'];
		if(unlink("files/".$staff_no."/".$filename)){
			mysqli_query($conn, "DELETE FROM `storage` WHERE `store_id` = '$store_id'") or die(mysqli_error());
		}
	}
	if(ISSET($_POST['id'])){
		$id = $_POST['id'];
		$query = mysqli_query($conn, "SELECT * FROM `form` WHERE `id` = '$id'") or die(mysqli_error());
		$fetch  = mysqli_fetch_array($query);
		$filename = $fetch['filename'];
		$staff_no = $fetch['staff_no'];
		if(unlink("files/".$staff_no."/".$filename)){
			mysqli_query($conn, "DELETE FROM `form` WHERE `id` = '$id'") or die(mysqli_error());
		}
	}
?>