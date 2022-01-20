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
	
<div class="col-md-8">
<div class="alert alert-info" style="margin-left:250px; margin-top:100px; width:1200px; background-color:#3090C7; border-color:none; text-color:grey;">Upload AEON SOP</div>
<div class="panel panel-default" style="margin-left:250px; width:1200px; ">
<div  >
				
<table id="table" class="table table-bordered">
<thead>
<tr>
							<th>Filename</th>
							<th>Version</th>
							<th>Date Uploaded</th>
							<th>Action</th>
							<th>Uploaded By</th>
</tr>
</thead>
<tbody>

<?php
$count=1;
$sel_query="Select * from form ORDER BY id desc;";
$result = mysqli_query($conn,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
						
							<tr class="del_file<?php echo $row['id']?>">
							<td><?php echo substr($row['title'], 0 ,30)."..."?></td>
							<td><?php echo $row['version_no']?></td>
							<td><?php echo $row['uploaded_date']?></td>
						
							<td>
							<a href="download.php?store_id=<?php echo $row['staff_no'];?>" class="btn btn-success">
							<span class="glyphicon glyphicon-download"></span> Download</a> |
							
							<button class="btn btn-danger btn_remove" type="button" id="<?php echo $row['id'];?>">
							
							<span class="glyphicon glyphicon-trash"></span> Remove</button>|
							
							<a href="edit.php?id=<?php echo $row["id"]; ?>" class="btn btn-success">Edit</a>|

							<a href="pdf_print.php?id=<?php echo $row["id"]; ?>" class="btn btn-success">Print</a></td>


							<td><?php echo $row['staff_no'];?></td>							
						</tr>
						<?php
							$count++; }
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


<?php include 'script.php'?> 
<script type="text/javascript">
$(document).ready(function(){
	$('.btn_remove').on('click', function(){
		var id = $(this).attr('id');
		$("#modal_remove").modal('show');
		$('#btn_yes').attr('name', id);
	});
	
	$('#btn_yes').on('click', function(){
		var id = $(this).attr('name');
		$.ajax({
			type: "POST",
			url: "remove_file.php",
			data:{
				id: id
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