<?php 
require('mem_image.php');

	$host = "localhost";
  $db_name = "db_sfms";
  $username = "root";
  $password = "";
  $conn = mysqli_connect("localhost", "root", "", "db_sfms");

  $id=$_REQUEST['id'];
  $query = "SELECT * from form where id='".$id."' "; 
  $result = mysqli_query($conn, $query) or die ( mysqli_error());
  $row = mysqli_fetch_assoc($result);

  session_start();
    if(!ISSET($_SESSION['staff'])){
      header("location: index.php");
    }
    echo "Connected successfully";

	require_once 'admin/conn.php'

?>

<!DOCTYPE html>
<html lang="en">
  
<head>
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="admin/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="admin/css/jquery.dataTables.css" />
		<link rel="stylesheet" type="text/css" href="admin/css/style.css" />

  
  <title>Create SOP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://www.dukelearntoprogram.com/course1/common/js/image/SimpleImage.js">
</script>
  
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
}
label {
  font-size:;
}
textarea {
  border: 1px solid #ccc;
}
input[type=text], select, textarea {
  
  width: 750px;
  padding: 12px 20px;

  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 750px;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=file] {
  margin-left:400px;
  align:center;
}

input[type=submit]:hover {
  background-color: #45a049;
}


div. {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
  
  
}
#content{ 
    width: 50%; 
    margin: 20px auto; 
    border: 1px solid #cbcbcb; 
} 
section {
  margin-left: 400px;
  
}
    body {
      font-family: arial;
     
    }
 
    .input-box {
      margin: 15px 0;
    }
 
    .input-box input {
      padding: 5px 10px;
      border-radius: 2px;
      border: 1px solid #999;
    }
 
    .btn {
      cursor: pointer;
      padding: 5px 10px;
      border-radius: 2px;
      border: 1px solid #17a2b8;
      color: #fff;
      background-color: #17a2b8;
    }
 
    .btn:hover {
      background-color: #138496;
      border-color: #117a8b;
    }
 
    .btn:focus {
      outline: 0;
    }
 
    .input-box a {
      color: red;
      font-size: 13px;
      text-decoration: none;
    }
 
    .input-box a:hover {
      text-decoration: underline;
    }
  </style>

		<label class="navbar-brand">AEON SOP Management System</label>
   
		

	</nav>
   
    <header><br><br><br>
     <h1 align='center'>AEON CO.</h1>
     <h2 align='center'> Standard Operating Procedure </h2>
    </header>
    <section>
    
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{

    $title =$_REQUEST['title'];
    $version_no = $_REQUEST['version_no'];
    $business_unit = $_REQUEST['business_unit'];
    $date = $_REQUEST['date'];
    $doc_no = $_REQUEST['doc_no'];
    $approved_by = $_REQUEST['approved_by'];
    $reviewed_by = $_REQUEST['reviewed_by'];
    $policy=$_REQUEST['policy'];
    $purpose = $_REQUEST['purpose'];
    $scope = $_REQUEST['scope'];
    $review_pro = $_REQUEST['review_pro'];
    $monitoring = $_REQUEST['monitoring'];
    $verification = $_REQUEST['verification'];
    $_FILES = $_REQUEST['_FILES'];

    
$update="update form set title='".$title."', version_no='".$version_no."', 
business_unit='".$business_unit."', date='".$date."', doc_no='".$doc_no."', 
approved_by='".$approved_by."', reviewed_by='".$reviewed_by."', policy='".$policy."', 
purpose='".$purpose."', scope='".$scope."', review_pro='".$review_pro."', 
monitoring='".$monitoring."', verification='".$verification."', _FILES='".$_FILES."' where id='".$id."'";
mysqli_query($conn, $update) or die(mysqli_error());
$status = "Record Updated Successfully. </br></br><a href='view.php'>View Updated Record</a>";
echo '<p style="color:#FF0000;">'.$status.'</p>';
}else {
?> 
        
        <div>
        <form action="edit.php" method="post"><br><br>
        <input type="hidden" name="new" value="1" />
     
        <input name="id" type="hidden" value="<?php echo $row['id'];?>" />
            <label> SOP Details </label><br><br><br>
            <p>
                SOP Title:<br><br>
                <input type="text" name="title"  value="<?php echo $row['title'];?>"/></p>
            <p>
                Version No. :<br><br>
                <input type="text" name="version_no"  value="<?php echo $row['version_no'];?>"/></p>
            <p>
                Dept./Business Unit:<br><br>
                <input type="text" name="business_unit"  value="<?php echo $row['business_unit'];?>"/>
            </p> 
            <p>
                Effective Date : <br><br>
                <tr><input type="date" name="date"  value="<?php echo $row['date'];?>" />
            </p>
            <p>
                Document No. : <br><br>
                <input type="text" name="doc_no"  value="<?php echo $row['doc_no'];?>"/>
            </p>
            <p>
                Approved By : <br><br>
                <input type="text" name="approved_by"  value="<?php echo $row['approved_by'];?>" />
            </p>
            <p>
                Reviewed By : <br><br>
                <input type="text"  name="reviewed_by"  value="<?php echo $row['reviewed_by'];?>" />
            </p>
           <br>
           
        <label> SOP Content  </label><br><br>

        Policy :<br><br>
        <textarea  name="policy" type="policy" style="height:200px"> <?php echo $row['policy'] ?></textarea><br><br>
      
         Purpose :<br><br>
         <textarea  name ="purpose" style="height:200px"><?php echo $row['purpose'] ?></textarea><br><br>

        <p>
         Scope :<br><br>
         <textarea   name = "scope" placeholder="Enter Scope" style="height:200px"> <?php echo $row['scope'] ?></textarea></p><br><br>

        <p>
         Review Procedure :<br><br>
         <textarea   name = "review_pro" style="height:200px" placeholder="Enter Review Procedure"> <?php echo $row['review_pro'] ?></textarea></p><br><br>

        <p>
         Monitoring :<br><br>
         <textarea  name = "monitoring" style="height:200px" placeholder="Enter Monitoring"> <?php echo $row['monitoring'] ?></textarea></p><br><br>

        <p>
         Verification and Record Keeping :<br><br>
         <textarea  cols = "100" name = "verification" style="height:200px">  <?php echo $row['verification'] ?></textarea></p><br><br>
        <p>
        Picture Selected:

<?php 
        echo '<td><img style="height:200px;width:300px;" src="data:image/jpg;base64,' . base64_encode( $row['_FILES'] ) . '" /></td>';
?>
        <input type="file" name="_FILES"  accept=".jpg" style="background-color:#fff;" required />


        Procedure :
        <div class="wrapper">
     <div class="input-box">
      Procedure : <br>
       <input type="text" name="steps[]"><br><br>
      Description :<br>
        <textarea rows = "5" cols = "100" name = "desc[]">
         </textarea>
         <br><br>
       <button class="btn add-btn">Add More</button>
     </div>
   </div>
   </p>
   <br>
					<p><input name="submit" type="submit" value="Update" /></p>
        </form>
       
<?php
 } ?>   
 
 <script type="text/javascript">
   $(document).ready(function () {

     // allowed maximum input fields
     var max_input = 30;

     // initialize the counter for textbox
     var x = 1;

     // handle click event on Add More button
     $('.add-btn').click(function (e) {
       e.preventDefault();
       if (x < max_input) { // validate the condition
         x++; // increment the counter
         $('.wrapper').append(`
           <div class="input-box">
           Procedure : <br>
       <input type="text" name="steps[]"><br><br>
      Description : <br>
       <textarea rows = "5" cols = "100" name = "desc[]">
         </textarea>
             <a href="#" class="remove-lnk">Remove</a>
           </div>
         `); // add input field
       }
     });

     // handle click event of the remove link
     $('.wrapper').on("click", ".remove-lnk", function (e) {
       e.preventDefault();
       $(this).parent('div').remove();  // remove input field
       x--; // decrement the counter
     })

   });
 </script>
        
</div>
    </section>


<?php include 'sidebar.php'?>
</body>
</html>