<?php 
session_start(); 
include "db_conn.php";
$ids = $_GET['id'];
$sql = "SELECT * FROM weeklyroster WHERE id={$ids}";
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
	$monday = validate($_POST['monday']);
	$tuesday = validate($_POST['tuesday']);
	$wednesday = validate($_POST['wednesday']);
	$thursday = validate($_POST['thursday']);
	$friday = validate($_POST['friday']);
	$saturday = validate($_POST['saturday']);
	$sunday = validate($_POST['sunday']);
	
	if(!empty($_POST['name'])&& !empty($_POST['monday']) && !empty($_POST['tuesday']) && !empty($_POST['wednesday']) && !empty($_POST['thursday']) && !empty($_POST['friday']) && !empty($_POST['saturday']) && !empty($_POST['sunday'])){
			    $_SESSION['name'] = $_POST['name'];
				$_SESSION['monday'] = $_POST['monday'];
				$_SESSION['tuesday'] = $_SESSION['tuesday'];
                $_SESSION['wednesday'] = $_POST['wednesday'];
				$_SESSION['thursday'] = $_SESSION['thursday'];
				$_SESSION['friday'] = $_POST['friday'];
				$_SESSION['saturday'] = $_SESSION['saturday'];
			    $_SESSION['sunday'] = $_POST['sunday'];
			
$sql = "UPDATE weeklyroster set id=$ids, name='$name', Monday='$monday',Tuesday='$tuesday', Wednesday='$wednesday', Thursday='$thursday', Friday='$friday',
Saturday='$saturday', Sunday='$sunday' where id=$idsup";
	
		
		$run= mysqli_query($connectingDB, $sql)or die (mysqli_error());
		if($run){
		 header("Location: viewRoster.php?message= Roster Updated");
	                 exit();
			
		}
		else {
		 header("Location: viewRoster.php?message=Roster not Updated");
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
	<title>Upload Lead</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Cache-control" content="no-cache">
</head>
<body>
<div class="containerlogonav">
<div class="logo"><img src="mrlogo.png" alt=""/></div>
</div>
<div class="form">
     <form class="form1" action="" method="post">
     	<h2>Add Roaster</h2>

	<select  class="select" name="name">
  <option value="<?php echo $arr['name']?>"><?php echo $arr['name']?></option>
	
 </select>

		<br>
		<select  class="select" name="monday">
            <option disabled hidden selected><?php echo $arr['Monday']?></option>
			 <option value="On">On</option>
             <option value="Off">Off</option>  
        </select>
		<select  class="select" name="tuesday">
            <option disabled hidden selected><?php echo $arr['Tuesday']?></option>
			 <option value="On">On</option>
             <option value="Off">Off</option>  
        </select>
		<select  class="select" name="wednesday">
            <option disabled hidden selected><?php echo $arr['Wednesday']?></option>
			 <option value="On">On</option>
             <option value="Off">Off</option>  
        </select>
		<select  class="select" name="thursday">
            <option disabled hidden selected><?php echo $arr['Thursday']?></option>
			 <option value="On">On</option>
             <option value="Off">Off</option>  
        </select>
		<select  class="select" name="friday">
            <option disabled hidden selected><?php echo $arr['Friday']?></option>
			 <option value="On">On</option>
             <option value="Off">Off</option>  
        </select>
		<select  class="select" name="saturday">
            <option disabled hidden selected><?php echo $arr['Saturday']?></option>
			 <option value="On">On</option>
             <option value="Off">Off</option>  
        </select>
		<select  class="select" name="sunday">
            <option disabled hidden selected><?php echo $arr['Sunday']?></option>
			 <option value="On">On</option>
             <option value="Off">Off</option>  
        </select>
     	<button type="submit" name="submit" class="button">Update Roaster</button>
     </form>
	 </div>


</body>
</html>

