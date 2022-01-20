<div class="panel panel-primary" style="margin-left:150px; margin-top:100px">
			<div class="panel-heading">
				<h1 class="panel-title">Staff Information</h1>
			</div>
			<div class="panel-body">
				<h4>ID: <label class="pull-right"><?php echo $fetch['staff_no']?></label></h4>
				<hr style="border-top:1px dotted #ccc;"/>
				<h4>Name: <label class="pull-right"><?php echo $fetch['firstname']." ".$fetch['lastname']?></label></h4>
				<hr style="border-top:1px dotted #ccc;"/>
				<h4>Gender: <label class="pull-right"><?php echo $fetch['gender']?></label></h4>
				<hr style="border-top:1px dotted #ccc;"/>
				<h4>Department: <label class="pull-right"><?php echo $fetch['yr&sec']?></label></h4>
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