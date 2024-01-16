<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Distributor</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.3/dist/flatpickr.min.css">
    <meta http-equiv="Cache-control" content="no-cache">
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>

<body>
    <div class="containerlogonav">
        <div class="logo"><img src="mrlogo.png" alt="" /></a></div>
        <div class="navigation-menu">
            <div id="navigation">
                <div class="navbar">
                    <a class="a" href="logout.php">logout</a>
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

                    <input type="text" id="datepicker" name="date" placeholder="Select Date" class="custom-width flatpickr-input active">
                    <input type="text" name="lead_name" placeholder="Enter Lead Name" class="custom-width">
                    <button type="submit" name="search" class="button1">Filter Results</button>
                </form>
            </div>
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
                <th>Respose</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            session_start(); 
            include "db_conn.php";
            
            $sql = "SELECT * FROM leadformdistributor";
            
            if(isset($_POST['search'])) {
                $leadName = mysqli_real_escape_string($connectingDB, $_POST['lead_name']);
                $date = mysqli_real_escape_string($connectingDB, $_POST['date']);
                $type = isset($_POST['type']) ? $_POST['type'] : '';
                $platform = isset($_POST['platform']) ? $_POST['platform'] : '';
                $campaign = isset($_POST['campaign']) ? $_POST['campaign'] : '';

                $whereClause = [];

                if (!empty($leadName)) {
                    $whereClause[] = "cname LIKE '%$leadName%'";
                }

                if (!empty($date)) {
                    $whereClause[] = "Date = '$date'";
                }

                if (!empty($type)) {
                    $whereClause[] = "type = '$type'";
                }

                if (!empty($platform)) {
                    $whereClause[] = "platform = '$platform'";
                }

                if (!empty($campaign)) {
                    $whereClause[] = "campaign = '$campaign'";
                }

                if (!empty($whereClause)) {
                    $sql .= " WHERE " . implode(" AND ", $whereClause);
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
                    <td><?php echo $res['project']?></td>
                    <td><?php echo $res['type']?></td>
                    <td><?php echo $res['platform']?></td>
                    <td><?php echo $res['campaign']?></td>
                    <td><?php echo $res['interest']?></td>
                    <td>
                        <form action="assignmanager.php?id=<?php echo $res['id']?>" method="post">
                            <select name="manager">
                                <option disabled hidden selected>ASSIGN</option>
                                <option value="manager1" >Manager 1</option>
                                <option value="manager2">Manager 2</option>
                            </select>
                            <button  type="search" name="assign">Assign</button>
                        </form>
                    </td>
                    <td><a href="responseteam1.php?cnumber=<?php echo $res['cnumber']?>" method="post">View Response</a></td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.3/dist/flatpickr.min.js"></script>
    <script
