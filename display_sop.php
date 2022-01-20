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
<?php
require('mem_image.php');

if(isset($_POST['new']) && $_POST['new']==1){

		ob_start();
		$pdf=new PDF_memImage();                                   //new instance to generate new fpdf
        $pdf->AddPage();                                           //add the first page in pdf
        $pdf->SetFont('Arial','B',16);    
    



		$pdf->output();
    	 ob_end_flush(); 
}

?>

</body>
</html>


