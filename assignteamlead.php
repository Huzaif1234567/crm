<?php 
session_start(); 
include "db_conn.php";

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    $ids = $_GET['id'];

    if (isset($_POST['assign'])) {
        $sql = "SELECT * FROM leadformmanager WHERE id=$ids";
        $result = mysqli_query($connectingDB, $sql);
        $num = mysqli_num_rows($result);
        $res = mysqli_fetch_array($result);

        $cDate =  $res['Date'];
        $cname =  $res['cname'];
        $cnumber =  $res['cnumber'];
        $acnumber =  $res['acnumber'];
        $type = $res['type'];
        $platform = $res['platform'];
        $campaign =  $res['campaign'];
        $interest =  $res['interest'];
        $teamlead = $_POST['team'];
        
        $check = "SELECT * FROM leadformteamlead WHERE cnumber='$cnumber'";
        $runcheck = mysqli_query($connectingDB, $check) or die(mysqli_error($connectingDB));

        $checkrows = mysqli_num_rows($runcheck);
        if($checkrows > 0) {
            echo '<script>alert("Lead Already Assigned"); history.go(-1);</script>';
        } else {  
            // Insert results from the form input
            $sql2 = "INSERT into leadformteamlead (Date,cname,cnumber,acnumber,type,platform,campaign,interest,teamlead)
                values('$cDate','$cname','$cnumber','$acnumber','$type','$platform','$campaign','$interest','$teamlead')";
            $run = mysqli_query($connectingDB, $sql2) or die(mysqli_error($connectingDB));

            // Use JavaScript to show alert and go back
            echo '<script>alert("Lead Assigned Successfully"); history.go(-1);</script>';
        }
    }
}
?>
