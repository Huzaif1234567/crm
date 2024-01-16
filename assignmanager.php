<?php 
session_start(); 
include "db_conn.php";
$ids = $_GET['id'];
if (isset($_POST['assign'])) {
$sql = "SELECT * FROM leadformdistributor WHERE id=$ids";
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
	$manager = $_POST['manager'];
		$check= "select * from  leadformmanager where cnumber='$cnumber'";
				$runcheck= mysqli_query($connectingDB, $check);
				$checkrows=mysqli_num_rows($runcheck);
				if($checkrows>0) {
					echo '<script>alert("Lead Already Assigned"); history.go(-1);</script>';
   } else {  
    //insert results from the form input
    
      $sql2 = "INSERT into  leadformmanager (Date,cname,cnumber,acnumber,type,platform,campaign,interest,manager)
		values('$cDate','$cname','$cnumber','$acnumber','$type','$platform','$campaign','$interest','$manager')";
		$run= mysqli_query($connectingDB, $sql2);
		echo '<script>alert("Lead Assigned Successfully"); history.go(-1);</script>';
		
   }
}

?>