<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['submit'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $user_name = validate($_POST['user_name']);
    $password = validate($_POST['password']);
    $name = validate($_POST['name']);
    $type = validate($_POST['type']);
    
    if (!empty($_POST['user_name']) && !empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['type'])) {
        $_SESSION['user_name'] = $_POST['user_name'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['type'] = $_POST['type'];

        $sql = "INSERT INTO users_all (user_name, password, name, type) VALUES ('$user_name', '$password', '$name', '$type')";
        $run = mysqli_query($connectingDB, $sql);

        if ($run) {
            header("Location: manageAccounts.php");
        } else {
            header("Location: createAccount.php?message=Account not Created");
        }
    } else {
        echo "All fields required";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Create New Account</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Cache-control" content="no-cache">
</head>
<body>
<div class="containerlogonav">
<div class="logo"><img src="mrlogo.png" alt=""/></div>
</div>
<div class="form">
     <form class="form1" action="" method="post">
     	<h2>Create New Account</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<input type="text" name="user_name" placeholder="User Name" value="" >
     	<input type="text" name="password" placeholder="Password" value="">
        <input type="text" name="name" placeholder="Name" value="">
		<br>
		<select  class="select" name="type">
            <option disabled hidden selected>Select Account</option>
			 <option value="Super-Admin">Super-Admin</option>
            <option value="Admin">Admin</option>
            <option value="Distributor">Distributor</option>
            <option value="Manager">Manager</option>
            <option value="Team-Lead">Team-Lead</option>
			<option value="Team-Member">Team-Member</option>
        </select>
     	<button type="submit" name="submit" class="button">Create Account</button>
     </form>
	 <div>
</body>
</html>

