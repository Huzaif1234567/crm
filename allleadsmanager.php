<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dashboard Manager</title>
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
  <a class="a" href="logout.php">logout</a>
</div>
</div>
</div>
</div>
<div class="grid-container">


<div class="center-div">
<h1 class="h1">Leads Record</h1>

<div class="myDIV">
<form action="filteredviewmanagerall.php" method="post">
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
		 <button  type="search" name="search" class="button1">Filter Results</button>
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
<th>Type</th>
<th>Platform</th>
<th>Campaign</th>
<th>Interest</th>
<th>Assign</th>
<th>Respose</th>
</tr>
<thead>
<tbody>
<?php 
session_start(); 
include "db_conn.php";
$sql = "SELECT * FROM leadformmanager";
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
<td><form action="assignteamlead.php?id=<?php echo $res['id']?>" method="post">
  <?php 
  $date = date('m/d/Y', time());
$day =  date('l', strtotime($date)); 
	$manager = $_SESSION['user_name'];

$query = "SELECT name from weeklyroster WHERE $day='On' AND manager='$manager'";
// AND role='Team-Lead'
@$results = mysqli_query($connectingDB, @$query);
@$rowcount = mysqli_num_rows(@$results);

?>
	<select  class="select" name="team">
	 <option disabled hidden selected>Assign</option>
	<?php
	for($i=0;$i<=$rowcount;$i++)
	{
	$row= mysqli_fetch_array($results);	
	?>
  <option value="<?php echo $row['name']?>"><?php echo $row['name']?></option>
	<?php
	}
	?>
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
