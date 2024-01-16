<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
session_start(); 
include "db_conn.php";
$ids = $_GET['id'];
$sql = "SELECT * FROM leadformenduser WHERE id={$ids}";
$result = mysqli_query($connectingDB, $sql);
$arr = mysqli_fetch_array($result);

if (isset($_POST['submit'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    date_default_timezone_set('Asia/Karachi'); 
    $date = date('m/d/Y h:i:sa', time());
    $cname = validate($_POST['cname']);
    $cnumber = validate($_POST['cnumber']);
    $callduration = validate($_POST['callduration']);
    $comments = validate($_POST['comments']);

    // Fetch teammember information from the database based on the logged-in user
    $ids = $_GET['id'];

    $sqlFetchTeammember = "SELECT teammember FROM leadformenduser WHERE id = '$ids'";
    $resultTeammember = mysqli_query($connectingDB, $sqlFetchTeammember);
    $teammemberData = mysqli_fetch_assoc($resultTeammember);

    if ($teammemberData) {
        $member_name = $teammemberData['teammember'];
    } else {
        // Handle the case where teammember data is not found
        // You might want to set a default value or handle it accordingly
        $member_name = 'DefaultTeammember';
    }

    $cnumberlimit = preg_replace('/\p{Pd}|\p{Pc}/', '', $cnumber);
    echo $cnumberlimit;
    $qq = "SHOW TABLES LIKE '" . $cnumberlimit . "_client'";
    $query_result = mysqli_query($connectingDB, $qq);
    $table_exists = mysqli_num_rows($query_result) > 0;

    if ($table_exists) {
        $sql = "INSERT IGNORE into " . $cnumberlimit . "_client (Date, cnumber, cname, callduration, comments, member_name)
                values('$date','$cnumber','$cname','$callduration','$comments','$member_name')";
        $run = mysqli_query($connectingDB, $sql) or die(mysqli_error($connectingDB));
        if ($run) {
            header("Location: dashboardteam.php?message=Submitted Successfully");
            exit();
        } else {
            header("Location: dashboardteam.php?message= Not Submitted");
            exit();
        }
    } else {
        $query1 = "CREATE TABLE " . $cnumberlimit . "_client (
                        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                        Date varchar(255) NOT NULL,
                        cnumber varchar(255) NOT NULL,
                        cname varchar(255) NOT NULL,
                        callduration varchar(255) NOT NULL,
                        comments varchar(255) NOT NULL,
                        member_name varchar(255) NOT NULL)";
        $result = mysqli_query($connectingDB, $query1) or die(mysqli_error($connectingDB));

        $sql2 = "INSERT IGNORE into " . $cnumberlimit . "_client (Date, cnumber, cname, callduration, comments, member_name )
                values('$date','$cnumber','$cname','$callduration','$comments','$member_name')";
        $result1 = mysqli_query($connectingDB, $sql2) or die(mysqli_error($connectingDB));

        if ($result1) {
            header("Location: dashboardteam.php?message=Submitted Successfully");
            exit();
        } else {
            header("Location: dashboardteam.php?message= Not Submitted");
            exit();
        }
    }
} else {
    echo "All fields required";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lead Response Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta http-equiv="Cache-control" content="no-cache">
</head>
<body>
<div class="containerlogonav">
    <div class="logo"><img src="mrlogo.png" alt=""/></div>
</div>
<div class="form">
    <form class="form1" action="" method="post">
        <h2>Lead Response Form</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <input type="text" name="cname" value="<?php echo $arr['cname']?>" placeholder="Client Name">
        <input type="text" name="cnumber"  value="<?php echo $arr['cnumber']?>" placeholder="Client Number">
        <input type="text" name="callduration" placeholder="Call Duration">
        <input type="text" name="comments"  placeholder="Comments">
        <button class="button" type="submit" name="submit">Submit Response</button>
    </form>
    <div>
</body>
</html>
