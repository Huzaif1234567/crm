<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta http-equiv="Cache-control" content="no-cache">
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</head>
<body>
<div class="containerlogonav">
<div class="logo"><img src="mrlogo.png" alt=""/></a></div>
<div class="navigation-menu">
<div id ="navigation">
<div class="navbar">
  <a class="a" href="logoutteam.php">logout</a>
</div>
</div>
</div>
</div>
<div class="grid-container">


<div class="center-div">
<h1 class="h1">Leads Record</h1>

<div class="myDIV">

<table class="paginated">
<thead>
<tr>
<th>Date</th>
<th>Client Name</th>
<th>Client Number</th>
<th>Alternate Number</th>
<th>Type</th>
<th>Platform</th>
<th>Campaign</th>
<th>Interest</th>
<th>Write Respose</th>
</tr>
<thead>
<tbody>
<?php 
session_start(); 
include "db_conn.php";
$user = $_SESSION['user_name'];
if (isset($_POST['search'])) {
	$type = $_POST['type'];
	$platform = $_POST['platform'];
    $campaign = $_POST['campaign'];
  date_default_timezone_set('Asia/Karachi'); 
$date = date('m/d/Y', time());
	if(!empty($_POST['type'])&& !empty($_POST['platform'])&& !empty($_POST['campaign'])){
			
				$_SESSION['type'] = $_POST['type'];
				$_SESSION['platform'] = $_POST['platform'];
				$_SESSION['campaign'] = $_POST['campaign'];
				$sql = "SELECT * FROM leadformenduser WHERE teamlead='{$user}' AND Date='{$date}' AND type='{$type}' AND platform='{$platform}' AND campaign='{$campaign}'  ";
$result = mysqli_query($connectingDB, $sql);
$num = mysqli_num_rows($result);
while ($res = mysqli_fetch_array($result)){
	?>
	<tr>  
<td><?php echo $res['Date']?> </td>
<td><?php echo $res['cname']?> </td>
<td><?php echo $res['cnumber']?> </td>
<td><?php echo $res['acnumber']?></td>
<td><?php echo $res['type']?></td>
<td><?php echo $res['platform']?></td>
<td><?php echo $res['campaign']?></td>
<td><?php echo $res['interest']?></td>
<td><a href="responseformteam.php?id=<?php echo $res['id']?>" method="post">Write Response</a><br><br>
<a href="responseteam1.php?cnumber=<?php echo $res['cnumber']?>" method="post">View Response</a></td>
</tr>
<?php
}
	}
}
?>


</tbody>
</table>

    </div>
  
</div>
</div>


</body>
<script>
 


    $('table.paginated').each(function () {
        var currentPage = 0;
        var numPerPage = 50; // number of items 
        var $table = $(this);
        //var $tableBd = $(this).find("tbody");

        $table.bind('repaginate', function () {
            $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
        });
        $table.trigger('repaginate');
        var numRows = $table.find('tbody tr').length;
        var numPages = Math.ceil(numRows / numPerPage);
        var $pager = $('<div class="pager"></div>');
        for (var page = 0; page < numPages; page++) {
            $('<span class="page-number"></span>').text(page + 1).bind('click', {
                newPage: page
            }, function (event) {
                currentPage = event.data['newPage'];
                $table.trigger('repaginate');
                $(this).addClass('active').siblings().removeClass('active');
            }).appendTo($pager).addClass('clickable');
        }
        if (numRows > numPerPage) {
            $pager.insertAfter($table).find('span.page-number:first').addClass('active');
        }
    });
</script>

<html>
