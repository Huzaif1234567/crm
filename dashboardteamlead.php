<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Team Lead</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
    <meta http-equiv="Cache-control" content="no-cache">
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>
</head>
<body>
    <div class="containerlogonav">
        <div class="logo"><img src="mrlogo.png" alt=""/></div>
        <div class="navigation-menu">
            <div id ="navigation">
                <div class="navbar">
                    <a class="a" href="logout.php">logout</a>
                    <a class="a" href="ChangePassword.php?id=<?php echo $_SESSION['id']?>">Change Password</a>
                    <a class="a" href="allleadsteamlead.php">All Leads Record</a>
                </div>
            </div>
        </div>
    </div>
    <div class="grid-container">
        <div class="center-div">
            <h1 class="h1">Leads Record</h1>
            <div class="myDIV">
                <form action="" method="post">
                    <h4>Filter Records </h4>
                    <input type="text" name="search_name" placeholder="Search by Name">
                    <input id="datepicker" name="search_date" type="text" placeholder="Select Date" class="custom-width flatpickr-input active">
                    <select name="platform" class="select1">
                        <option disabled hidden selected>Platform</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Instagram">Instagram</option>
                        <option value="Google">Google</option>
                        <option value="Youtube">Youtube</option>
                        <option value="Whatsapp">Whatsapp</option>
                        <option value="LinkedIn">Likendin</option>
                    </select>
                    <select name="type" class="select1">
                        <option disabled hidden selected>Lead Type</option>
                        <option value="Personal">Personal</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Affiliate">Affiliate</option>
                        <option value="Cold">Cold</option>
                        <option value="UAN">UAN</option>
                        <option value="Walk-In">Walk-In</option>
                        <option value="Referral">Referral</option>
                    </select>
                    <select name="campaign" class="select1">
                        <option disabled hidden selected>Campaign</option>
                        <option value="Sofia Sapphire">Sofia Sapphire</option>
                        <option value="IBC">IBC</option>
                        <option value="Regus">Regus</option>
                        <option value="Mall-VIII">Mall-VIII</option>
                        <option value="All-Projects">All-Projects</option>
                        <option value="5 WEST">5 WEST</option>
                        <option value="Organic">Organic</option>
                    </select>
                    <button type="submit" name="search" class="button1">Filter Results</button>
                </form>
            </div>
        </div>
        <table class="paginated">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Client Name</th>
                    <th>Client Number</th>
                    <th>Alternate Number</th>
                    <th>campaign</th>
                    <th>Type</th>
                    <th>Platform</th>
                    <th>project</th>
                    <th>Interest</th>
                    <th>Assign</th>
                    <th>Response</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include "db_conn.php";
                $user = $_SESSION['user_name'];
                date_default_timezone_set('Asia/Karachi'); 
                $date = date('m/d/Y', time());
                $sql = "SELECT * FROM leadformteamlead WHERE teamlead= '$user' ";

                if(isset($_POST['search'])) {
                    $searchName = isset($_POST['search_name']) ? $_POST['search_name'] : '';
                    $searchDate = isset($_POST['search_date']) ? $_POST['search_date'] : '';

                    if (!empty($searchName)) {
                        $sql .= " AND cname LIKE '%$searchName%' ";
                    }

                    if (!empty($searchDate)) {
                        $sql .= " AND Date = '$searchDate' ";
                    }
                }

                $result = mysqli_query($connectingDB, $sql);
                $num = mysqli_num_rows($result);
                while ($res = mysqli_fetch_array($result)){
                ?>
                <tr>  
                    <td><?php echo $res['Date']?> </td>
                    <td><?php echo $res['cname']?> </td>
                    <td><?php echo $res['cnumber']?> </td>
                    <td><?php echo $res['acnumber']?></td>
                    <td><?php echo $res['campaign']?></td>
                    <td><?php echo $res['type']?></td>
                    <td><?php echo $res['platform']?></td>
                    <td><?php echo $res['project']?></td>
                    <td><?php echo $res['interest']?></td>
                    <td>
                        <form action="assignteammember.php?id=<?php echo $res['id']?>" method="post">
                            <?php 
                            $date = date('m/d/Y', time());
                            $day =  date('l', strtotime($date)); 
                            $manager = 'manager1';

                            $query = "SELECT user_name from users_all WHERE type='Team-Member' ";
                            $results = mysqli_query($connectingDB, $query);
                            $rowcount = mysqli_num_rows($results);
                            ?>
                            <select class="select" name="teammember">
                                <option disabled hidden selected>Assign</option>
                                <?php
                                for($i=0; $i<$rowcount; $i++) {
                                    $row = mysqli_fetch_array($results);    
                                ?>
                                <option value="<?php echo $row['user_name']?>"><?php echo $row['user_name']?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <button type="search" name="assign">Assign</button>
                        </form>
                    </td>
                    <td><a href="responseteam1.php?cnumber=<?php echo $res['cnumber']?>" method="post">View Response</a></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        flatpickr("#datepicker", {
            dateFormat: "Y-m-d",
        });
    </script>
</body>
</html>

<?php 
} else {
    // ... existing code ...
}
?>
