<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
session_start(); 
include "db_conn.php";
$ids = $_GET['id'];
$sql = "SELECT * FROM users_all WHERE id={$ids}";
$result = mysqli_query($connectingDB, $sql);
$arr = mysqli_fetch_array($result);
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
if (isset($_POST['submit'])) {

	$password = validate($_POST['password']);

if(!empty($_POST['password'])){
			  
			$_SESSION['password'] = $_POST['password'];	
			$_SESSION['type']=$arr['type'];
	        $sql = "UPDATE users_all SET password=$password WHERE id={$ids}";
		               $run= mysqli_query($connectingDB, $sql)or die (mysqli_error());
		               if($run){
						 	if($_SESSION['type']=="Super-Admin"){
		          	        header("Location: dashboardadminsuper.php?Message=Password Changed");
	                        exit();
		                 }
						   else if ($_SESSION['type']=="Admin"){
			            	header("Location: dashboardadmin.php?Message=Password Changed");
				            exit();
						 }
						 else if ($_SESSION['type']=="Manager"){
					 	 header("Location: dashboardManager.php?Message=Password Changed");
					    	exit();
				         }
				         else if ($_SESSION['type']=="Team-Lead"){
					 	header("Location: dashboardteamlead.php?Message=Password Changed");
					    	exit();
			          	}
			        	else if ($_SESSION['type']=="Team-Member"){
					 	header("Location: dashboardteam.php?Message=Password Changed");
						   exit();
				        }
		                else {
			            header("Location: dashboardadmin.php?message=Password not changed ");
	                    exit();
		          }
					   }
}
else {
		echo "All fields required";
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Cache-control" content="no-cache">
</head>
<body>
<div class="containerlogonav">
<div class="logo"><img src="mrlogo.png" alt=""/></a></div>
</div>
<div class="form">
<form class="form1" action="" method="post">
  <div class="imgcontainer">
    <img src="mrlogo.png" alt="Avatar" >
  </div>
<div>
  <div class="container">
  <br><br>
  
    <input type="text" value="<?php echo $arr['user_name'] ?>" required>
<br><br>

    <input type="password" placeholder="New Password" name="password" required>
<br><br>
    <button class="button" type="submit" name="submit">Change Password</button>
  </div>
</form>
</div>
</body>
</html>