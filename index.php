<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

// Start session and include db_conn.php
session_start();
include_once("db_conn.php");

// Handle form submissions
if (isset($_POST['uname']) && isset($_POST['password'])) {
    // Existing login logic
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: index.php?error=User Name is required");
        exit();
    } else if(empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM users_all WHERE user_name='$uname' AND password='$pass'";
        $result = mysqli_query($connectingDB, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['type'] = $row['type'];

                // Redirect based on user type
                if ($_SESSION['type'] == "Super-Admin") {
                    header("Location: dashboardadminsuper.php?Type=Super-Admin");
                } else if ($_SESSION['type'] == "Admin") {
                    header("Location: dashboardadmin.php?Type=Admin");
                } else if ($_SESSION['type'] == "Distributor") {
                    header("Location: dashboarddistributor.php?Type=Distributor");
                } else if ($_SESSION['type'] == "Manager") {
                    header("Location: dashboardManager.php?Type=Manager");
                } else if ($_SESSION['type'] == "Team-Lead") {
                    header("Location: dashboardteamlead.php?Type=Team-Lead");
                } else if ($_SESSION['type'] == "Team-Member") {
                    header("Location: dashboardteam.php?Type=Team-Member");
                }
                exit();
            } else {
                header("Location: index.php?error=Incorrect User name or password");
                exit();
            }
        } else {
            header("Location: index.php?error=Incorrect User name or password");
            exit();
        }
    }

} else if (isset($_POST['createAccount'])) {
    // Redirect to createAccount.php when "Create Account" button is pressed
    header("Location: createAccount.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome to MRealtors CRM</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta http-equiv="Cache-control" content="no-cache">
</head>
<body>
<div class="form">
    <form class="form1" action="" method="post">
        <div class="imgcontainer">
            <img src="mrlogo.png" alt="Avatar">
        </div>
        <div>
            <div class="container">
                <br><br>
                <input type="text" placeholder="Enter Username" name="uname" required>
                <br><br>
                <input type="password" placeholder="Enter Password" name="password" required>
                <br><br>
                <button class="button" type="submit">Login</button>
               
            </div>
        </div>
    </form>
    <script>
        function redirectCreateAccount() {
            window.location.href = "createAccount.php";
        }
    </script>
</div>
</body>
</html>
