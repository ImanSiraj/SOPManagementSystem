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

    require_once ("admin/conn.php");

    $query = mysqli_query($conn, "SELECT * FROM `staff` WHERE `id` = '$_SESSION[staff]'") or die(mysqli_error());
                                $fetch = mysqli_fetch_array($query);
                                $staff_no = $fetch['staff_no'];
                                $division = $fetch['division'];
                                $firstname = $fetch['firstname'];


    $today = date("F j, Y");
   
    ob_start();
    $pdf=new PDF_MemImage();
    // Output it
    $pdf->AddPage();
    $pdf->Ln(100);
    $pdf->Image('AEON.png',50,50,-300);
    $pdf->SetFont("Arial","B",20);
    $pdf->Cell(0,10,"STANDARD OPERATING PROCEDURE",0,1,'C');
    $pdf->SetFont("Arial","B",25);
    $pdf->Cell(0,10,$row['title'],0,1,'C');

    //Version History
    $pdf->Ln(80);
    $pdf->SetFont("Arial","B",11);
    $pdf->Cell(190,10,"VERSION HISTORY ",1,1);
    $pdf->Cell(47.5,10,"VERSION NO. :",1,0);
    $pdf->Cell(47.5,10,$row['version_no'],1,0);

    $pdf->Cell(47.5,10,"DEPT./BUSINESS UNIT: ",1,0);
    $pdf->Cell(47.5,10,$row['business_unit'],1,1);

    $pdf->Cell(47.5,10,"EFFECTIVE DATE :",1,0);
    $pdf->Cell(47.5,10,$row['date'],1,0);

    $pdf->Cell(47.5,10,"DOCUMENT NO. : ",1,0);
    $pdf->Cell(47.5,10,$row['doc_no'],1,1);

    $pdf->Cell(47.5,10,"APPROVED BY :",1,0);
    $pdf->Cell(47.5,10,$row['approved_by'],1,0);

    $pdf->Cell(47.5,10,"REVIEWED BY : ",1,0);
    $pdf->Cell(47.5,10,$row['reviewed_by'],1,1);

    $pdf->Cell(47.5,10,"SIGNATURE :",1,0);
    $pdf->Cell(47.5,10," ",1,0);

    $pdf->Cell(47.5,10,"SIGNATURE : ",1,0);
    $pdf->Cell(47.5,10," ",1,1);

    //Table of Content
    $pdf->AddPage();
    $pdf->SetFont("Arial","B",20);
    $pdf->SetFont("Arial","B",11);
    $pdf->Ln(10);
    $pdf->Cell(190,20,"TABLE OF CONTENT ",0,1,'C');
    $pdf->Cell(20,8,"NO. ",1,0);
    $pdf->Cell(130,8,"DESCRIPTION",1,0);
    $pdf->Cell(40,8,"PAGE",1,1);

    $pdf->Cell(20,8,"1. ",1,0);
    $pdf->Cell(130,8,"Policy",1,0);
    $pdf->Cell(40,8,"",1,1);

    $pdf->Cell(20,8,"2. ",1,0);
    $pdf->Cell(130,8,"Purpose",1,0);
    $pdf->Cell(40,8," ",1,1);

    $pdf->Cell(20,8,"3. ",1,0);
    $pdf->Cell(130,8,"Scope",1,0);
    $pdf->Cell(40,8," ",1,1);

    $pdf->Cell(20,8,"4. ",1,0);
    $pdf->Cell(130,8,"Review Procedure",1,0);
    $pdf->Cell(40,8," ",1,1);

    $pdf->Cell(20,8,"5. ",1,0);
    $pdf->Cell(130,8,"Monitoring",1,0);
    $pdf->Cell(40,8," ",1,1);

    $pdf->Cell(20,8,"6. ",1,0);
    $pdf->Cell(130,8,"Verification and Record Keeping",1,0);
    $pdf->Cell(40,8," ",1,1);

    $pdf->Cell(20,8,"7. ",1,0);
    $pdf->Cell(130,8,"Process (High Level Flow Chart)",1,0);
    $pdf->Cell(40,8," ",1,1);

    $pdf->Cell(20,8,"8. ",1,0);
    $pdf->Cell(130,8,"Procedure",1,0);
    $pdf->Cell(40,8," ",1,1);


    //SOP Content
    $pdf->AddPage();
    $pdf->Ln(10);
    $pdf->SetFont("Arial","B",15);
    $pdf->Cell(10,10,"POLICY",0,1);
    $pdf->SetFont("Arial","",12);
    $pdf->Write(12,$row['policy'],0,1);

    $pdf->Ln(10);
    $pdf->SetFont("Arial","B",15);
    $pdf->Cell(10,10,"PURPOSE",0,1);
    $pdf->SetFont("Arial","",12);
    $pdf->Write(12,$row['purpose'],0,1);

    $pdf->Ln(10);
    $pdf->SetFont("Arial","B",15);
    $pdf->Cell(10,10,"SCOPE",0,1);
    $pdf->SetFont("Arial","",12);
    $pdf->Write(12,$row['scope'],0,1);

    $pdf->AddPage();
    $pdf->Ln(10);
    $pdf->SetFont("Arial","B",15);
    $pdf->Cell(10,10,"REVIEW PROCEDURE",0,1);
    $pdf->SetFont("Arial","",12);
    $pdf->Write(12,$row['review_pro'],0,1);
    $pdf->Ln(5);

    $pdf->Ln(10);
    $pdf->SetFont("Arial","B",15);
    $pdf->Cell(10,10,"MONITORING",0,1);
    $pdf->SetFont("Arial","",12);
    $pdf->Write(12,$row['monitoring'],0,1);

    $pdf->Ln(10);
    $pdf->SetFont("Arial","B",15);
    $pdf->Cell(10,10,"VERIFICATION AND RECORD KEEPING",0,1);
    $pdf->SetFont("Arial","",12);
    $pdf->Write(12,$row['verification'],0,1);

    $pdf->AddPage();
    $pdf->Ln(10);
    $pdf->SetFont("Arial","B",15);
    $pdf->Cell(10,10,"FLOWCHART",0,1);
    $pdf->Ln(10);
    $pdf->MemImage($row['_FILES'],50,50,-300);

    //Procedure
    $pdf->AddPage();
    $pdf->SetFont("Arial","B",11);
    $pdf->Ln(10);
    $pdf->Cell(190,10,"PROCEDURE ",0,1);
    $pdf->Ln(10);
    //$pdf->BasicTable($steps,$desc);
    

    $pdf->output();
    ob_end_flush(); 

    


?>
        


