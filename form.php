<?PHP

require('mem_image.php');
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

require("admin/conn.php");

$query = mysqli_query($conn, "SELECT * FROM `staff` WHERE `id` = '$_SESSION[staff]'") or die(mysqli_error());
							$fetch = mysqli_fetch_array($query);
							$staff_no = $fetch['staff_no'];
                            $division = $fetch['division'];
							$firstname = $fetch['firstname'];

$today = date("F j, Y");

if(isset($_POST['pdf_view'])){

    global $connection;
    
    $title=$_POST['title'];
    $version_no=$_POST['version_no'];
    $business_unit=$_POST['business_unit'];
    $date=$_POST['date'];
    $doc_no=$_POST['doc_no'];
    $approved_by=$_POST['approved_by'];
    $reviewed_by=$_POST['reviewed_by'];
    $policy=$_REQUEST['policy'];
    $purpose = $_REQUEST['purpose'];
    $scope=$_POST['scope'];
    $review_pro=$_POST['review_pro'];
    $monitoring=$_POST['monitoring'];
    $verification=$_POST['verification'];
    $steps=$_POST['steps'];
    $desc=$_POST['desc'];

    if(getimagesize($_FILES['file']['tmp_name']) == FALSE) //if input type file has no 'image' file
    {
        echo 'Please select image to upload'; //display message there is no image
    }
    else                            
    {
        $name = addslashes($_FILES['file']['name']);  //store the image name in vaiable
        $image = addslashes (file_get_contents($_FILES['file']['tmp_name'])); //storing the image file in variable

        uploadfile($image); //call the function upload image

    }

}
  
function uploadfile($image)
{
    $today = date("F j, Y");

    $conn = mysqli_connect("localhost", "root", "", "db_sfms");

    $query = mysqli_query($conn, "SELECT * FROM `staff` WHERE `id` = '$_SESSION[staff]'") or die(mysqli_error());
							$fetch = mysqli_fetch_array($query);
							$staff_no = $fetch['staff_no'];
                            $division = $fetch['division'];
							$firstname = $fetch['firstname'];

    $title=$_POST['title'];
    $version_no=$_POST['version_no'];
    $business_unit=$_POST['business_unit'];
    $date=$_POST['date'];
    $doc_no=$_POST['doc_no'];
    $approved_by=$_POST['approved_by'];
    $reviewed_by=$_POST['reviewed_by'];
    $policy=$_REQUEST['policy'];
    $purpose = $_REQUEST['purpose'];
    $scope=$_POST['scope'];
    $review_pro=$_POST['review_pro'];
    $monitoring=$_POST['monitoring'];
    $verification=$_POST['verification'];
    

    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') '
        . mysqli_connect_error());
        }
    else{
    $sql = "INSERT INTO form (staff_no,title,version_no, uploaded_date, business_unit, date,doc_no,
    approved_by, reviewed_by, policy, purpose, scope, review_pro, monitoring, 
    verification,_FILES) VALUES ('$staff_no','$title',  '$version_no', '$today',
    '$business_unit','$date','$doc_no', '$approved_by', '$reviewed_by',
    '$policy', '$purpose','$scope','$review_pro','$monitoring',
    '$verification','$image')";
    if ($conn->query($sql)){
        echo "New record is inserted sucessfully";
        }
        else{
        echo "Error: ". $sql ."
        ". $conn->error;
        }

    }
 
}
   
?>