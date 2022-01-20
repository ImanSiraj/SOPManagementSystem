<?php
$host = "localhost";
$db_name = "db_sfms";
$username = "root";
$password = "";
$conn = mysqli_connect("localhost", "root", "", "db_sfms");

session_start();
  if(!ISSET($_SESSION['staff'])){
      header("location: index.php");
  }
  echo "Connected successfully";
  $title=$_POST['title'];
  $query = "SELECT * from form where title='".$title."'"; 
  $sql = mysqli_query($conn, $query) or die ( mysqli_error());
  $row = mysqli_fetch_assoc($sql);
require_once 'admin/conn.php'

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>View Records</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><a href="index.php">Home</a> | <a href="insert.php">Insert New Record</a> | <a href="logout.php">Logout</a></p>
<h2>View Records</h2>
<table width="100%" border="1" style="border-collapse:collapse;">
<thead>
<tr><th><strong>Title</strong></th><th><strong>Version No</strong></th><th><strong>Doc No</strong></th><th><strong>Edit</strong></th><th><strong>Delete</strong></th></tr>
</thead>
<tbody>
<?php
$count=1;
$sel_query="Select * from form ORDER BY title desc;";
$sql = mysqli_query($conn,$sel_query);
while($row = mysqli_fetch_assoc($sql)) { ?>
<tr><td align="center"><?php echo $count; 
?></td><td align="center">
    <?php echo $row["title"]; 
    ?></td><td align="center">
        <?php echo $row["version_no"]; 
        ?></td><td align="center">
            <a href="edit.php?id=<?php echo $row["title"]; ?>">Edit</a></td><td align="center"><a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a></td></tr>
<?php $count++; } ?>
</tbody>
</table>

<br /><br /><br /><br />

</div>
</body>
</html>
