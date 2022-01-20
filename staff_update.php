<!DOCTYPE html>
<?php 
	session_start();
	if(!ISSET($_SESSION['staff'])){
		header("location: index.php");
	}
	require_once 'admin/conn.php'
?>
<html lang="en">
	<head>
		<title>AEON SOP Management System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="admin/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="admin/css/jquery.dataTables.css" />
		<link rel="stylesheet" type="text/css" href="admin/css/style.css" />
	</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
		<div class="container-fluid">
			<label class="navbar-brand">AEON SOP Management System</label>
		</div>
	</nav>
	
	<div class="col-md-3">
		
		<div class="panel panel-warning" style="margin-top:20%;">
			<div class="panel-heading">
				<h1 class="panel-title">Update  Staff Information</h1>
			</div>
			<?php
				$query = mysqli_query($conn, "SELECT * FROM `staff` WHERE `id` = '$_SESSION[staff]'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);
			?>
			<div class="panel-body">
				<form method="POST" action="update_query.php">
					<div class="form-group">
						<label>Staff ID:</label> 
						<input type="text" class="form-control" value="<?php echo $fetch['staff_no']?>" name="staff_no" readonly="readonly"/>
						<input type="hidden" value="<?php echo $fetch['id']?>" name="id"/>
					</div>
					<div class="form-group">
						<label>Firstname:</label> 
						<input type="text" class="form-control" value="<?php echo $fetch['firstname']?>" name="firstname" required="required"/>
					</div>
					<div class="form-group">
						<label>Lastname:</label> 
						<input type="text" class="form-control" value="<?php echo $fetch['lastname']?>" name="lastname" required="required"/>
					</div>
					
					
					<br />
					<div class="form-group">
						<label>Password:</label> 
						<input type="password" class="form-control" value="" name="password" required="required"/>
					</div>
					<a class="btn btn-default" href="staff_profile.php">Cancel</a> <button class="btn btn-warning" name="update"><span class="glyphicon glyphicon-edit"></span> Update</button>
				</form>
				
			</div>
		</div>
	</div>


	<?php include 'script.php'?>
</body>
</html>