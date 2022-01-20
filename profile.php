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
		<title> AEON SOP Management System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="admin/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="admin/css/jquery.dataTables.css" />
		<link rel="stylesheet" type="text/css" href="admin/css/style.css" />
	</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
		<div class="container-fluid">
		<img src="AEON.png" alt="logo" >

<style>
.container-fluid img {
  float: left;
  width: 120px;
  height: 50px;

  
}</style>

		<label class="navbar-brand">AEON SOP Management System</label>
		<ul class = "nav navbar-right">	
				<li class = "dropdown">
					<a class = "user dropdown-toggle" data-toggle = "dropdown" href = "#">
						<span class = "glyphicon glyphicon-user"></span>
						
						<b class = "caret"></b>
					</a>
				<ul class = "dropdown-menu">
					<li>
						<a href = "logout.php"><i class = "glyphicon glyphicon-log-out"></i> Logout</a>
					</li>
				</ul>
				</li>
		</div>
	</nav>
	

						<?php
							$query = mysqli_query($conn, "SELECT * FROM `staff` WHERE `id` = '$_SESSION[staff]'") or die(mysqli_error());
							$fetch = mysqli_fetch_array($query);
							$staff_no = $fetch['staff_no'];
							$query1 = mysqli_query($conn, "SELECT * FROM `storage` WHERE `staff_no` = '$staff_no'") or die(mysqli_error());
							while($fetch1 = mysqli_fetch_array($query1))
							
						?>
						
                        <div class="col-md-4">
		
		<div class="panel panel-primary" style="margin-left:300px; margin-top:100px; width:600px ">
			<div class="panel-heading" style="background-color:#3090C7;">
				<h1 class="panel-title" >Staff Information </h1>
			</div>
			<div class="panel-body">
				<h4>Staff ID: <label class="pull-right"><?php echo $fetch['staff_no']?></label></h4>
				<hr style="border-top:1px dotted #ccc;"/>
				<h4>Name: <label class="pull-right"><?php echo $fetch['firstname']." ".$fetch['lastname']?></label></h4>
				
				<hr style="border-top:1px dotted #ccc;"/>
				<h4>Unit Division: <label class="pull-right"><?php echo $fetch['division']?></label></h4>
				<hr style="border-top:1px dotted #ccc;"/>
				<h3>File</h3>
				<form method="POST" enctype="multipart/form-data" action="save_file.php">
					<input type="file" name="file" size="4" style="background-color:#fff;" required="required" />
					<br />
					<input type="hidden" name="staff_no" value="<?php echo $fetch['staff_no']?>"/>
					<button class="btn btn-success btn-sm" name="save"><span class="glyphicon glyphicon-plus"></span> Add File</button>
				</form>
				<br style="clear:both;"/>
				<div class="dropdown pull-right">
					<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="glyphicon glyphicon-cog">&nbsp;</span><span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="staff_update.php">Update Account</a></li>
						<li><a href="#" data-toggle="modal" data-target="#modal_confirm">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
		
	</div>
	
	<div class="modal fade" id="modal_confirm" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">System</h3>
				</div>
				<div class="modal-body">
					<center><h4 class="text-danger">Are you sure you want to logout?</h4></center>
				</div>
				<div class="modal-footer">
					<a type="button" class="btn btn-success" data-dismiss="modal">Cancel</a>
					<a href="logout.php" class="btn btn-danger">Logout</a>
				</div>
			</div>
		</div>
	</div>
	<?php include 'sidebar.php'?>
	<div class="modal fade" id="modal_remove" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">System</h3>
				</div>
				<div class="modal-body">
					<center><h4 class="text-danger">Are you sure you want to remove this file?</h4></center>
				</div>
				<div class="modal-footer">
					<a type="button" class="btn btn-success" data-dismiss="modal">No</a>
					<button type="button" class="btn btn-danger" id="btn_yes">Yes</button>
				</div>
			</div>
		</div>
	</div>


<?php include 'script.php'?> 
<script type="text/javascript">
$(document).ready(function(){
	$('.btn_remove').on('click', function(){
		var store_id = $(this).attr('id');
		$("#modal_remove").modal('show');
		$('#btn_yes').attr('name', store_id);
	});
	
	$('#btn_yes').on('click', function(){
		var id = $(this).attr('name');
		$.ajax({
			type: "POST",
			url: "remove_file.php",
			data:{
				store_id: id
			},
			success: function(data){
				$("#modal_remove").modal('hide');
				$(".del_file" + id).empty();
				$(".del_file" + id).html("<td colspan='4'><center class='text-danger'>Deleting...</center></td>");
				setTimeout(function(){
					$(".del_file" + id).fadeOut('slow');
				}, 1000);
				
			}
		});
	});
});
</script>	
</body>
</html>