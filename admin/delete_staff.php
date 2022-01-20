<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['id'])){
		$id = $_POST['id'];
		$query = mysqli_query($conn, "SELECT * FROM `staff` WHERE `id` = '$id'") or die(mysqli_error());
		$fetch  = mysqli_fetch_array($query);
		$staff_no = $fetch['staff_no'];
		
		if(file_exists("../files/".$staff_no)){
			removeDir("../files/".$staff_no);
			mysqli_query($conn, "DELETE FROM `staff` WHERE `id` = '$id'") or die(mysqli_error());
			mysqli_query($conn, "DELETE FROM `storage` WHERE `staff_no` = '$staff_no'") or die(mysqli_error());
		}
	}
	
	function removeDir($dir) {
		$items = scandir($dir);
		foreach ($items as $item) {
			if ($item === '.' || $item === '..') {
				continue;
			}
			$path = $dir.'/'.$item;
			if (is_dir($path)) {
				xrmdir($path);
			} else {
				unlink($path);
			}
		}
		rmdir($dir);
	}
?>