<?php 
session_start(); 
include "db_conn.php";
$ids = $_GET['id'];
$sql = "SELECT * FROM leadform WHERE id={$ids}";
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
    $cDate = validate($_POST['cDate']);
	$cname = validate($_POST['cname']);
	$cnumber = validate($_POST['cnumber']);
	$acnumber = validate($_POST['acnumber']);
	$type = validate($_POST['type']);
	$platform = validate($_POST['platform']);
    $campaign = validate($_POST['campaign']);
	$interest = validate($_POST['interest']);
	if(!empty($_POST['cDate'])&& !empty($_POST['cname'])&& !empty($_POST['cnumber'])&& !empty($_POST['acnumber'])&& !empty($_POST['type'])&& !empty($_POST['platform'])&& !empty($_POST['campaign'])&& !empty($_POST['interest'])){
			    $_SESSION['cDate'] = $_POST['cDate'];
				$_SESSION['cname'] = $_POST['cname'];
                $_SESSION['cnumber'] = $_POST['cnumber'];
				$_SESSION['acnumber'] = $_POST['acnumber'];
				$_SESSION['type'] = $_POST['type'];
				$_SESSION['platform'] = $_POST['platform'];
				$_SESSION['campaign'] = $_POST['campaign'];
				$_SESSION['interest'] = $_POST['interest'];
$sql = "UPDATE leadform set id=$ids, Date='$cDate',cname='$cname',cnumber='$cnumber',acnumber='$acnumber',type ='$type',platform='$platform'
,campaign='$campaign',interest='$interest' where id=$idsup";
	
		
		$run= mysqli_query($connectingDB, $sql)or die (mysqli_error());
		if($run){
		 header("Location: dashboardadmin.php?message= Lead Updated");
	                 exit();
			
		}
		else {
		 header("Location: dashboardadmin.php?message=Lead not Updated");
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
     	<h2>Update Lead Record</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<input type="text" name="cDate" placeholder="Date" value="<?php echo $arr['Date']?>" >
     	<input type="text" name="cname" placeholder="Client Name" value="<?php echo $arr['cname']?>">

     	<input type="text" name="cnumber" placeholder="Client Number" value="<?php echo $arr['cnumber']?>">
     	
		
     	<input type="text" name="acnumber" placeholder="Alternate Number" value="<?php echo $arr['acnumber']?>">

		
		<select  class="select" name="type">
            <option value="<?php echo $arr['type']?>"><?php echo $arr['type']?></option>
            <option value="Personal">Personal</option>
            <option value="Marketing">Marketing</option>
            <option value="Affiliate">Affiliate</option>
		    <option value="Cold">Cold</option>
			<option value="UAN">UAN</option>
			<option value="Walk-In">Walk-In</option>
			<option value="Referral">Referral</option>
			 
        </select>
		<br>
     	 <select class="select"name="platform">
            <option value="<?php echo $arr['platform']?>"><?php echo $arr['platform']?></option>
            <option value="Facebook">Facebook</option>
            <option value="Instagram">Instagram</option>
            <option value="Google">Google</option>
            <option value="Youtube">Youtube</option>
			  <option value="Whatsapp">Whatsapp</option>
            <option value="LinkedIn">Likendin</option>
        </select>
		<br>
        <select class="select" name="campaign">
            <option value="<?php echo $arr['campaign']?>"><?php echo $arr['campaign']?></option>
            <option value="Sofia Sapphire">Sofia Sapphire</option>
            <option value="IBC">IBC</option>
            <option value="Regus">Regus</option>
            <option value="Mall-VIII">Mall-VIII</option>
			<option value="All-Projects">All-Projects</option>
			 <option value="5 WEST">5 WEST</option>
            <option value="Organic">Organic</option>
        </select>
		<br>
		<select  class="select" name="interest">
            <option value="<?php echo $arr['interest']?>"><?php echo $arr['interest']?></option>
            <option value="Shop">Shop</option>
            <option value="Office">Office</option>
            <option value="Apartment">Apartment</option>
            <option value="Residential-Plot">Residential-Plot</option>
			<option value="Commercial-Plot">Commercial-Plot</option>
		
        </select>


     	<button type="submit" name="submit" class="button">Update</button>
     </form>
	 <div>
</body>
</html>

