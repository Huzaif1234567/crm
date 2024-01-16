<?php 
session_start(); 
include "db_conn.php";

$file=$_FILES['csvfile']['tmp_name'];
$handle=fopen($file,"r");
while(($cont=fgetcsv($handle,1000,","))!==false){
date_default_timezone_set('Asia/Karachi'); 
    $date = date('m/d/Y', time());
	echo $date;
	$cname = $cont[0];
	$cnumber = $cont[1];
	$acnumber = $cont[2];
	$project = $cont[3];
	$type = $cont[4];
	$platform = $cont[5];
    $campaign = $cont[6];
	$interest = $cont[7];
	$check= "select * from leadform where cnumber='$cnumber'";
				$runcheck= mysqli_query($connectingDB, $check)or die (mysqli_error());
				$checkrows=mysqli_num_rows($runcheck);
				if($checkrows>0) {
      echo "record exists";
   } else {  
    //insert results from the form input
    
      $sql = "INSERT IGNORE into leadform (Date,cname,cnumber,acnumber,project,type,platform,campaign,interest)
		values('$date','$cname','$cnumber','$acnumber','$type','$platform','$project','$campaign','$interest')";
		
		$run= mysqli_query($connectingDB, $sql)or die (mysqli_error());
		if($run){
		 echo "record added";
			
		}
		else {
		
		}
	}
   
}

?>
	