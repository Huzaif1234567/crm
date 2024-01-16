<?php
session_start();
include "db_conn.php";

if (isset($_POST['submit'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    date_default_timezone_set('Asia/Karachi');
    $date = date('Y-m-d', time());
    $cname = validate($_POST['cname']);
    $cnumber = validate($_POST['cnumber']);
    $acnumber = validate($_POST['acnumber']);
    $campaign = validate($_POST['campaign']);
    $type = validate($_POST['type']);
    $platform = validate($_POST['platform']);
    $project = validate($_POST['project']);
    $interest = validate($_POST['interest']);

    if (!empty($cname) && !empty($cnumber) && !empty($acnumber) && !empty($type) && !empty($platform) && !empty($campaign) && !empty($interest)) {

        $_SESSION['cname'] = $cname;
        $_SESSION['cnumber'] = $cnumber;
        $_SESSION['acnumber'] = $acnumber;
        $_SESSION['campaign'] = $campaign;
        $_SESSION['type'] = $type;
        $_SESSION['platform'] = $platform;
        $_SESSION['project'] = $project;
        $_SESSION['interest'] = $interest;

        $check = "SELECT * FROM leadform WHERE cnumber = '$cnumber'";
        $runcheck = mysqli_query($connectingDB, $check) or die(mysqli_error());
        $checkrows = mysqli_num_rows($runcheck);

        if ($checkrows > 0) {
            echo "Record exists";
        } else {
            // Insert results from the form input
            $sql = "INSERT IGNORE INTO leadform (Date, cname, cnumber, acnumber, campaign, type, platform, project, interest)
                    VALUES ('$date', '$cname', '$cnumber', '$acnumber', '$campaign', '$type', '$platform', '$project', '$interest')";

            $run = mysqli_query($connectingDB, $sql) or die(mysqli_error());

            if ($run) {
                header("Location: dashboardadminsuper.php?message=Lead Uploaded");
                exit();
            } else {
                header("Location: dashboardadminsuper.php?message=Lead not Uploaded");
                exit();
            }
        }
    } else {
        echo "All fields required";
    }
}
?>
