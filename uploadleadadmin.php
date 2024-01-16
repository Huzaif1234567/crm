<?php 
session_start(); 
include "db_conn.php";


if (isset($_POST['submit'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	date_default_timezone_set('Asia/Karachi'); 
    $date = date('m/d/Y', time());
	$cname = validate($_POST['cname']);
	$cnumber = validate($_POST['cnumber']);
	$acnumber = validate($_POST['acnumber']);
	$campaign = validate($_POST['campaign']);
	$type = validate($_POST['type']);
	$platform = validate($_POST['platform']);
	$project = validate($_POST['project']);
    
	$interest = validate($_POST['interest']);
	
	if(!empty($_POST['cname'])&& !empty($_POST['cnumber'])&& !empty($_POST['acnumber'])&& !empty($_POST['type'])&& !empty($_POST['platform'])&& !empty($_POST['campaign'])&& !empty($_POST['interest'])){
			 
				$_SESSION['cname'] = $_POST['cname'];
                $_SESSION['cnumber'] = $_POST['cnumber'];
				$_SESSION['acnumber'] = $_POST['acnumber'];
				$_SESSION['campaign'] = $_POST['campaign'];
				$_SESSION['type'] = $_POST['type'];
				$_SESSION['platform'] = $_POST['platform'];
				
				$_SESSION['project'] = $_POST['project'];
				$_SESSION['interest'] = $_POST['interest'];
				
				$check= "select * from leadform where cnumber='$cnumber'";
				$runcheck= mysqli_query($connectingDB, $check)or die (mysqli_error());
				$checkrows=mysqli_num_rows($runcheck);
				if($checkrows>0) {
      echo "record exists";
	
   } else {  
    //insert results from the form input
    
      $sql = "INSERT IGNORE into leadform (Date,cname,cnumber,acnumber,campaign,type,platform,project,interest)
		values('$date','$cname','$cnumber','$acnumber','$campaign','$type','$platform','$project','$interest')";
		
		$run= mysqli_query($connectingDB, $sql)or die (mysqli_error());
		
		if($run){
			  header("Location: dashboardadminsuper.php?message= Lead Uploaded");
	                 exit();
			
		}
		else {
				  header("Location: dashboardadminsuper.php?message= Lead not Uploaded");
	                 exit();
		}
	}

    }
    

		
	else {
		echo "All fields required";
	}
}

?>
	
