<?php 
session_start(); 
include "db_conn.php";
$ids = $_GET['id'];
$sql = "SELECT * FROM leadform WHERE id=$ids";
$result = mysqli_query($connectingDB, $sql);
$num = mysqli_num_rows($result);
$res = mysqli_fetch_array($result);

    $cDate =  $res['Date'];
	$cname =  $res['cname'];
	$cnumber =  $res['cnumber'];
	$acnumber =  $res['acnumber'];
	$type = $res['type'];
	$platform = $res['platform'];
    $campaign =  $res['campaign'];
	$interest =  $res['interest'];
		$check= "select * from leadformdistributor where cnumber='$cnumber'";
				$runcheck= mysqli_query($connectingDB, $check)or die (mysqli_error());
				$checkrows=mysqli_num_rows($runcheck);
				if($checkrows>0) {
      header("Location: dashboardadmin.php?message=Record Exists");
	                 exit();
   } else {  
    //insert results from the form input
    
      $sql2 = "INSERT into leadformdistributor (Date,cname,cnumber,acnumber,type,platform,campaign,interest)
		values('$cDate','$cname','$cnumber','$acnumber','$type','$platform','$campaign','$interest')";
		$run= mysqli_query($connectingDB, $sql2)or die (mysqli_error());
  header("Location: dashboardadmin.php?message=Record Added");
	                 exit();
   }
   

?>