<div class="col-md-4"></div>
<style>
body {
	background: url(bg.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;

}
</style>
<div class="row">
<div class="col-md-4">
	<div class="panel panel-default" id="panel-margin">
		<div class="panel-heading" style="background-color:white;">
		
		<center><img src="AEON.png" style="width:300px;height:100px;"></center><br><br>

			<center><h1 class="panel-title">Welcome to AEON SOP Staff Login</h1></center>
		</div>
		
		<div class="panel-body">
		
			<form method="POST">
				<div class="form-group">
					<label for="username">ID</label>
					<input oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="5" name="staff_no" class="form-control" required="required"/>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input class="form-control" name="password" type="password" required="required" >
				</div>
				<?php include 'login_query.php'?>
				<div class="form-group">
					<button class="btn btn-block btn-primary"  name="login"><span class="glyphicon glyphicon-log-in"></span> Login</button>
				</div>
			</form>
		</div>
	</div>
</div>	