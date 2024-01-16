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
	$monday = validate($_POST['monday']);
	$tuesday = validate($_POST['tuesday']);
	$wednesday = validate($_POST['wednesday']);
	$thursday = validate($_POST['thursday']);
	$friday = validate($_POST['friday']);
	$saturday = validate($_POST['saturday']);
	$sunday = validate($_POST['sunday']);
	$manager = $_SESSION['user_name'];
	if(!empty($_POST['name'])&& !empty($_POST['monday']) && !empty($_POST['tuesday']) && !empty($_POST['wednesday']) && !empty($_POST['thursday']) && !empty($_POST['friday']) && !empty($_POST['saturday']) && !empty($_POST['sunday'])){
			    $_SESSION['name'] = $_POST['name'];
				$_SESSION['monday'] = $_POST['monday'];
				$_SESSION['tuesday'] = $_SESSION['tuesday'];
                $_SESSION['wednesday'] = $_POST['wednesday'];
				$_SESSION['thursday'] = $_SESSION['thursday'];
				$_SESSION['friday'] = $_POST['friday'];
				$_SESSION['saturday'] = $_SESSION['saturday'];
			    $_SESSION['sunday'] = $_POST['sunday'];
			
               $sql = "INSERT INTO weeklyroster (name, Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday,manager) VALUES ('$name', '$monday', '$tuesday', '$wednesday', '$thursday', '$friday', '$saturday', '$sunday', '$manager')";
	
		
			$run= mysqli_query($connectingDB, $sql);
		if($run){
		 header("Location: createRoster.php?message= Roster Added");
	                 exit();
			
		}
		else {
			 header("Location: createRoster.php?message=Roster not Added");
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
	<title>Create Roster</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta http-equiv="Cache-control" content="no-cache">
		<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>
<body>
<div class="containerlogonav">
<div class="logo"><img src="mrlogo.png" alt=""/></a></div>
<div class="navigation-menu">
<div id ="navigation">
<div class="navbar">
  <a class="a" href="EditViewTeam.php">Edit/View Team</a>
   <a class="a" href="viewRoster.php">View Roster</a>
    <a class="a" href="AddTeam.php">Add Team</a>
	
</div>
</div>
</div>
</div>
<div class="form">
     <form class="form1" action="" method="post">
     	<h2>Add Roaster</h2>
<?php
include "db_conn.php";
	$manager = $_SESSION['user_name'];

$query = "SELECT name from managerteam WHERE manager='$manager'";
$result = mysqli_query($connectingDB, $query);
$rowcount = mysqli_num_rows($result);

?>
	<select  class="select" name="name">
	 <option disabled hidden selected>Select Name</option>
	<?php
	for($i=0;$i<=$rowcount;$i++)
	{
	$row= mysqli_fetch_array($result);	
	?>
  <option value="<?php echo $row['name']?>"><?php echo $row['name']?></option>
	<?php
	}
	?>
 </select>

		<br>
		<select  class="select" name="monday">
            <option disabled hidden selected>Monday</option>
			 <option value="On">On</option>
             <option value="Off">Off</option>  
        </select>
		<select  class="select" name="tuesday">
            <option disabled hidden selected>Tuesday</option>
			 <option value="On">On</option>
             <option value="Off">Off</option>  
        </select>
		<select  class="select" name="wednesday">
            <option disabled hidden selected>Wednesday</option>
			 <option value="On">On</option>
             <option value="Off">Off</option>  
        </select>
		<select  class="select" name="thursday">
            <option disabled hidden selected>Thursday</option>
			 <option value="On">On</option>
             <option value="Off">Off</option>  
        </select>
		<select  class="select" name="friday">
            <option disabled hidden selected>Friday</option>
			 <option value="On">On</option>
             <option value="Off">Off</option>  
        </select>
		<select  class="select" name="saturday">
            <option disabled hidden selected>Saturday</option>
			 <option value="On">On</option>
             <option value="Off">Off</option>  
        </select>
		<select  class="select" name="sunday">
            <option disabled hidden selected>Sunday</option>
			 <option value="On">On</option>
             <option value="Off">Off</option>  
        </select>
     	<button type="submit" name="submit" class="button">Add Roaster</button>
     </form>
	 </div>



</html>
<?php 
}else{
    
   header("location:" .$_SERVER['PHP_SELF']);
		exit();
}
 ?>