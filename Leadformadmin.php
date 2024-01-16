<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
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
     <form class="form1" action="uploadleadadminsuper.php" method="post">
     	<h2>Upload Lead</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<input type="text" name="cname" placeholder="Client Name">

     	<input type="text" name="cnumber" placeholder="Client Number">
     	
		
     	<input type="text" name="acnumber" placeholder="Alternate Number">
         <input type="text" name="campaign" placeholder="Campaign">

    <select  class="select" name="type">
            <option disabled hidden selected>Select Lead Type</option>
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
            <option disabled hidden selected>Select Platform</option>
            <option value="Facebook">Facebook</option>
            <option value="Instagram">Instagram</option>
            <option value="Google">Google</option>
            <option value="Youtube">Youtube</option>
			  <option value="Whatsapp">Whatsapp</option>
            <option value="LinkedIn">Likendin</option>
        </select>
		<br>
        <select class="select" name="project">
            <option disabled hidden selected>Select Project</option>
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
            <option disabled hidden selected>Select Interest</option>
            <option value="Shop">Shop</option>
            <option value="Office">Office</option>
            <option value="Apartment">Apartment</option>
            <option value="Residential-Plot">Residential-Plot</option>
			<option value="Commercial-Plot">Commercial-Plot</option>
		
        </select>

     	<button class="button" type="submit" name="submit">Submit Lead</button>
     </form>
	 <div>
</body>
</html>