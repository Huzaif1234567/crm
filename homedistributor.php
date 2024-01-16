<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Cache-control" content="no-cache">
</head>
<body>
<div class="divHead"><h1>Hello, <?php echo $_SESSION['name']; ?></h1>
     <a href="logout.php">Logout</a></div>
     
</body>
</html>

<?php 
}else{
    header("location:" .$_SERVER['PHP_SELF']);
		exit();
}
 ?>