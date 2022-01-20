<?php

	$host = "localhost";
    $db_name = "db_sfms";
    $username = "root";
    $password = "";
    session_start();
      if(!ISSET($_SESSION['staff'])){
        header("location: index.php");
      }
      $conn = mysqli_connect("localhost", "root", "", "db_sfms");
$sql = "SELECT * FROM form";
$result= mysqli_query($conn,$sql);
?>
<html>
<head>
<title>Users List</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<style>
font-family:Arial;
}
input {
font-family:Arial;
font-size:14px;
}
label{
font-family:Arial;
font-size:14px;
color:#999999;
}
.tblSaveForm {
border-top:2px #999999 solid;
background-color: #f8f8f8;
}
.tableheader {
background-color: #fedc4d;
}
.tablerow {
background-color: #A7D6F1;
color:white;
}
.btnSubmit {
background-color:#fd9512;
padding:5px;
border-color:#FF6600;
border-radius:4px;
color:white;
}
.message {
color: #FF0000;
text-align: center;
width: 100%;
}
.txtField {
padding: 5px;
border:#fedc4d 1px solid;
border-radius:4px;
}
.evenRow {
background-color: #E2EDF9;
font-size:12px;
color:#101010;
}
.evenRow:hover {
background-color: #ffef46;
}
.oddRow {
background-color: #B3E8FF;
font-size:12px;
color:#101010;
}
.oddRow:hover {
background-color: #ffef46;
}
.tblListForm {
border-top:2px #999999 solid;
}
.listheader {
background-color: #fedc4d;
font-size:12px;
font-weight:bold;
}
.link{
text-decoration:none;
color:#5e8fc7;
font-size:11px;
}
</style>

<form name="frmUser" method="post" action="">
<div style="width:500px;">
<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
<div align="right" style="padding-bottom:5px;">
<a href="form2.php" class="link">
<img alt='List' title='List' src='images/list.png' 
width='15px' height='15px'/> List User</a></div>
<table border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm">
<tr class="listheader">
<td>title</td>
<td>version_no</td>
<td>business_unit</td>
<td>date</td>
<td>doc_no</td>
<td>approved_by</td>
<td>reviewed_by</td>
<td>policy</td>
<td>purpose</td>
<td>scope</td>
<td>review_pro</td>
<td>monitoring</td>
<td>verification</td>
</tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
if($i%2==0)
$classname="evenRow";
else
$classname="oddRow";
?>
<tr class="<?php if(isset($title)) echo $title;?>">
<td><?php echo $row["title"]; ?></td>
<td><?php echo $row["version_no"]; ?></td>
<td><?php echo $row["business_unit"]; ?></td>
<td><?php echo $row["date"]; ?></td>
<td><?php echo $row["doc_no"]; ?></td>
<td><?php echo $row["approved_by"]; ?></td>
<td><?php echo $row["reviewed_by"]; ?></td>
<td><?php echo $row["policy"]; ?></td>
<td><?php echo $row["purpose"]; ?></td>
<td><?php echo $row["scope"]; ?></td>
<td><?php echo $row["review_pro"]; ?></td>
<td><?php echo $row["monitoring"]; ?></td>
<td><?php echo $row["verification"]; ?></td>
<td><a href="insert_form_php.php?userId=<?php echo $row["title"]; 
?>" class="link"><img alt='Edit' title='Edit' 
src='images/edit.png' width='15px' height='15px' hspace='10' />
</a>  <a href="delete_user.php?userId=<?php echo $row["userId"]; ?>"  class="link"><img alt='Delete' title='Delete' src='images/delete.png' width='15px' height='15px'hspace='10' /></a></td>
</tr>
<?php
$i++;
}
?>
</table>
</form>
</div>
</body></html>