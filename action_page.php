<!DOCTYPE html>


<?php 
	session_start();
	if(!ISSET($_SESSION['staff'])){
		header("location: index.php");
	}
	require_once 'admin/conn.php'
?>
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #ffffff;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  margin-left:320px;
  font-family: Raleway;
  padding: 60px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

input.invalid {
  background-color: #ffdddd;
}

.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

.step.finish {
  background-color: #4CAF50;
}
.container-fluid img {
  float: left;
  width: 120px;
  height: 50px;
}
</style>
<html lang="en">
  
<head>
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="admin/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="admin/css/jquery.dataTables.css" />
		<link rel="stylesheet" type="text/css" href="admin/css/style.css" />
</head>
<body>
  
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
		<div class="container-fluid">
		<img src="1280px-AEON_logo.png" alt="logo" >

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
<?php include 'sidebar.php'?>
<form id="regForm" action="/action_page.php">
  <h1>Standard Operating Procedure:</h1>

  <div class="tab">Title:
    <p><input placeholder=Title oninput="this.className = ''" name="fname"></p>
  </div>
  <div class="tab"> <center><strong>SOP Details</strong></center>
    <p>Reference/Title:</p>
    <p><input placeholder="Reference/Title" oninput="this.className = ''" name="reference"></p>
    <p>Author/In-Charge:</p>
    <p><input placeholder="Author/In-Charge" oninput="this.className = ''" name="author"></p>
    <p>Creation Date:</p>
    <p><input placeholder="Creation Date" oninput="this.className = ''" name="creationdate"></p>
    <p>Effective Date/Application:</p>
    <p><input placeholder="Effective Date/Application" oninput="this.className = ''" name="effectivedate"></p>
    <p>Address to:</p>
    <p><input placeholder="Address to" oninput="this.className = ''" name="addressto"></p>
    <p>Version:</p>
    <p><input placeholder="Version" oninput="this.className = ''" name="version"></p>

  </div>
  
  <div class="tab">
    <p>Name of Procedure:</p>
    <p><input placeholder="Name Of Procedure" oninput="this.className = ''" name="dd"></p>
    <p>Name of Purpose:</p>
    <p><input placeholder="Purpose" oninput="this.className = ''" name="nn"></p>
    <p>Name of References:</p>
    <p><input placeholder="References" oninput="this.className = ''" name="yyyy"></p>
  </div>
  <div class="tab">Login Info:
    <p><input placeholder="Username..." oninput="this.className = ''" name="uname"></p>
    <p><input placeholder="Password..." oninput="this.className = ''" name="pword" type="password"></p>
  </div>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
  </div>

  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
  </div>
</form>

<script>
var currentTab = 0; 
showTab(currentTab); 

function showTab(n) {
  
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Generate";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
 
  fixStepIndicator(n)
}

function nextPrev(n) {
  
  var x = document.getElementsByClassName("tab");
 
  if (n == 1 && !validateForm()) return false;
  
  x[currentTab].style.display = "none";
 
  currentTab = currentTab + n;

  if (currentTab >= x.length) {
   
    document.getElementById("regForm").submit();
    
    return false;
  }
  
  showTab(currentTab);
}

function validateForm() {
  
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
 
  for (i = 0; i < y.length; i++) {
    
    if (y[i].value == "") {
      
      y[i].className += " invalid";
    
      valid = false;
    }
  }

  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; 
}

function fixStepIndicator(n) {
  
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }

  x[n].className += " active";
}

</script>

</body>
</html>