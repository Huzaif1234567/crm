<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
session_start(); 
include "db_conn.php";
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

if (isset($_POST['submit'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

    $name = validate($_POST['name']);
	$role = validate($_POST['role']);
	$manager = $_SESSION['user_name'];
	if(!empty($_POST['name'])&& !empty($_POST['role'])){
			    $_SESSION['name'] = $_POST['name'];
				$_SESSION['role'] = $_POST['role'];
				$_SESSION['manager'] = $_SESSION['user_name'];
              
			
               $sql = "INSERT INTO managerTeam (name, role,manager) VALUES ('$name', '$role', '$manager')";
	
		
			$run= mysqli_query($connectingDB, $sql);
		if($run){
		 header("Location: createRoster.php?message= Account Created");
	                 exit();
			
		}
		else {
			 header("Location: createRoster.php?message=Account not Created");
	                 exit();
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
	<title>Add Team</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta http-equiv="Cache-control" content="no-cache">
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>
<body>
<div class="containerlogonav">
<div class="logo"><img src="mrlogo.png" alt=""/></div>
</div>
<div class="form">
     <form class="form1" action="" method="post">
     	<h2>Add Team</h2>
     	<input type="text" name="name" placeholder="Name" value="" >
		<br>
		<select  class="select" name="role">
            <option disabled hidden selected>Select Role</option>
			 <option value="Team-Lead">Team-Lead</option>
             <option value="Team-Member">Team-Member</option>  
 
        </select>
     	<button type="submit" name="submit" class="button">Add Team</button>
     </form>
	 </div>
</body>
</html>
<?php
}else{
   header("location:" .$_SERVER['PHP_SELF']);
		exit();
}
 ?>