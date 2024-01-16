<?php 
session_start(); 
include "db_conn.php";
$ids = $_GET['id'];
$sql = "SELECT * FROM users_all WHERE id={$ids}";
$result = mysqli_query($connectingDB, $sql);
$arr = mysqli_fetch_array($result);

if (isset($_POST['submit'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	$idsup = $_GET['id'];
    $user_name = validate($_POST['user_name']);
	$password = validate($_POST['password']);
	$name = validate($_POST['name']);
	$type = validate($_POST['type']);
	if(!empty($_POST['user_name'])&& !empty($_POST['password'])&& !empty($_POST['name']) && !empty($_POST['type'])){
			    $_SESSION['user_name'] = $_POST['user_name'];
				$_SESSION['password'] = $_POST['password'];
                $_SESSION['name'] = $_POST['name'];
			    $_SESSION['type'] = $_POST['type'];
			
$sql = "UPDATE users_all set id=$ids, user_name='$user_name',password='$password',name='$name',type='$type' where id=$idsup";
	
		
		$run= mysqli_query($connectingDB, $sql)or die (mysqli_error());
		if($run){
		 header("Location: manageAccounts.php?message= Password Changed");
	                 exit();
			
		}
		else {
			 header("Location: manageAccounts.php?message=Password change failed");
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
	<title>Update Password</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Cache-control" content="no-cache">
</head>
<body>
<div class="containerlogonav">
<div class="logo"><img src="mrlogo.png" alt=""/></div>
</div>
<div class="form">
     <form class="form1" action="" method="post">
     	<h2>Update Password</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<input type="text" name="user_name" placeholder="User Name" value="<?php echo $arr['user_name']?>" >
     	<input type="text" name="password" placeholder="Password" value="<?php echo $arr['password']?>">
        <input type="text" name="name" placeholder="Name" value="<?php echo $arr['name']?>">
		<br>
		<select  class="select" name="type">
            <option disabled hidden selected value="<?php echo $arr['type']?>"><?php echo $arr['type']?></option>
			<option value="Super-Admin">Super-Admin</option>
            <option value="Admin">Admin</option>
            <option value="Distributor">Distributor</option>
            <option value="Manager">Manager</option>
            <option value="Team-Lead">Team-Lead</option>
			<option value="Team-Member">Team-Member</option>
        </select>
     	<button type="submit" name="submit" class="button">Update Password</button>
     </form>
	 <div>
</body>
</html>

