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
		<title> AEON SOP Management Systemm</title>
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

		<label class="navbar-brand">SOP Builder System</label>
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
	
<div class="col-md-8">
<div class="alert alert-info" style="margin-left:300px; margin-top:100px; width:1000px; background-color:#3090C7; border-color:none; text-color:#FFFFFF;">Upload AEON SOP</div>
		<div class="panel panel-default" style="margin-left:300px; width:1000px; ">
			<div  >
				
				<table id="table" class="table table-bordered">
					<thead>
						<tr>
							<th>Filename</th>
							<th>File Type</th>
							<th>Date Uploaded</th>
							<th>Action</th>
							<th>Uploaded By</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$query = mysqli_query($conn, "SELECT * FROM `staff` WHERE `id` = '$_SESSION[staff]'") or die(mysqli_error());
							$fetch = mysqli_fetch_array($query);
							$staff_no = $fetch['staff_no'];
							$query1 = mysqli_query($conn, "SELECT * FROM `storage`") or die(mysqli_error());
							while($fetch1 = mysqli_fetch_array($query1))
						{
						?>
						        <tr class="del_file<?php echo $fetch1['store_id']?>">
						        <td><?php echo substr($fetch1['filename'], 0 ,30)."..."?></td>
							    <td><?php echo $fetch1['file_type']?></td>
							    <td><?php echo $fetch1['date_uploaded']?></td>
							    <td>
							    <a href="download.php?store_id=<?php echo $fetch1['store_id']?>" class="btn btn-success"><span class="glyphicon glyphicon-download"></span> Download</a> |
							    <button class="btn btn-danger btn_remove" type="button" id="<?php echo $fetch1['store_id']?>"><span class="glyphicon glyphicon-trash"></span> Remove</button>|
							    <a href="viewfiles.php?id=<?php echo $row['store_id']; ?>" class="btn btn-success" target="_blank">View</a></td></td>

							    <td><?php echo $fetch1['staff_no']?></td>
							
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
							
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