<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    header('Pragma: no-cache');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Team Members</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta http-equiv="Cache-control" content="no-cache">
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>
<body>
    <div class="containerlogonav">
        <div class="logo"><img src="mrlogo.png" alt=""/></div>
        <div class="navigation-menu">
            <div id="navigation">
                <div class="navbar">
                    <a class="a" href="logout.php">logout</a>
                </div>
            </div>
        </div>
    </div>
    <table class="paginated">
        <thead>
            <tr>
                <th>Follow Up Date</th>
                <th>Call Duration</th>
                <th>Comments</th>
                <th>Assigned To</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "db_conn.php";
            $resnumber = $_GET['cnumber'];
            $sql = "SELECT * FROM leadform WHERE cnumber= '$resnumber' ";
            $resultresponse12 = mysqli_query($connectingDB, $sql);
            
            if ($resultresponse12) {
                $res12 = mysqli_fetch_array($resultresponse12);
                $cnumberlimit = preg_replace('/\p{Pd}|\p{Pc}/', '', $resnumber);
                $qq = "SHOW TABLES LIKE '" . $cnumberlimit . "_client'";
                $query_result = mysqli_query($connectingDB, $qq);
                $table_exists = mysqli_num_rows($query_result) > 0;

                $resultresponse11 = null; // Initialize the variable

                if ($table_exists) {
                    $sqlresponse = "SELECT * FROM " . $cnumberlimit . "_client ";
                    $resultresponse11 = mysqli_query($connectingDB, $sqlresponse);
                }


                echo "Name: " . htmlspecialchars(@$res12['cname']) . "<br>";
                echo "Phone Number: " . htmlspecialchars($resnumber) . "<br>";
                echo "Assigned Date: " . htmlspecialchars(@$res12['Date']) . "<br>";
               
                
           
             
                if ($resultresponse11 !== null && mysqli_num_rows($resultresponse11) > 0) {
                    while ($res11 = mysqli_fetch_array($resultresponse11)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($res11['Date']) . "</td>";
                        echo "<td>" . htmlspecialchars($res11['callduration']) . "</td>";
                        echo "<td>" . htmlspecialchars($res11['comments']) . "</td>";
                        echo "<td>" . htmlspecialchars($res11['member_name']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "No data found.";
                }
            } else {
                echo "Error executing query: " . mysqli_error($connectingDB) . "<br>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
<?php
} else {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}
?>
