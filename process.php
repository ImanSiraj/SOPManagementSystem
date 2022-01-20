<?php
	//TechWorld3g - Please Support Us <3
	//Facebook : https://www.facebook.com/TechWorld3g 
	//Twitter : https://twitter.com/TechWorld3g 
	//Youtube : https://www.youtube.com/user/TechWorld3g 
	//Blog : https://tech-world3g.blogspot.com 
	//Donate : https://imraising.tv/u/techworld3g﻿

	include 'exportpdf.php';

	//--------------------------//

	if((isset($_POST['editor'])) && (!empty(trim($_POST['editor'])))) //if content of CKEditor ISN'T empty
	{
		$posted_editor = trim($_POST['editor']); //get content of CKEditor
		$path = "files/file.pdf"; //specify the file save location and the file name
				
		if(exportPDF($posted_editor,$path)) //exportPDF function returns TRUE
		{					
			echo "File has been successfully exported!";
		}
		else //exportPDF function returns FALSE
		{
			echo "Failed to export the pdf file!";
		}				
	}
	else //if content of CKEditor IS empty
	{
		echo "Error : Empty content!";
	}

	//Warning : if file already exists, it will be overwritten! 