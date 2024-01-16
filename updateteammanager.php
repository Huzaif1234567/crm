<?php 
session_start(); 
include "db_conn.php";
$ids = $_GET['id'];
$sql = "SELECT * FROM managerteam WHERE id={$ids}";
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
    $name = validate($_POST['name']);
	$role = validate($_POST['role']);
	$manager = $_SESSION['user_name'];
	if(!empty($_POST['name'])&& !empty($_POST['role'])){
			    $_SESSION['name'] = $_POST['name'];
				$_SESSION['role'] = $_POST['role'];
          
			
$sql = "UPDATE managerteam set id=$ids, name='$name',role='$role' where id=$idsup";
	
		
		$run= mysqli_query($connectingDB, $sql)or die (mysqli_error());
		if($run){
		 header("Location: EditViewTeam.php?message= Record Updated");
	                 exit();
			
		}
		else {
			 header("Location:  EditViewTeam.php?message=Record Update failed");
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
	<title>Update Team</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Cache-control" content="no-cache">
</head>
<body>
<div class="containerlogonav">
<div class="logo"><img src="mrlogo.png" alt=""/></div>
</div>
<div class="form">
     <form class="form1" action="" method="post">
     	<h2>Update Team</h2>
     	<input type="text" name="name" placeholder="Name" value="<?php echo $arr['name']?>" >
		<br>
		<select  class="select" name="role">
             <option disabled hidden selected value="<?php echo $arr['role']?>"><?php echo $arr['role']?></option>
			 <option value="Team-Lead">Team-Lead</option>
             <option value="Team-Member">Team-Member</option>  
 
        </select>
     	<button type="submit" name="submit" class="button">Update Team</button>
     </form>
	 </div>

</body>
</html>

