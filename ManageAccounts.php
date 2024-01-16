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
	<title>Welcome to MRealtors CRM</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Cache-control" content="no-cache">
</head>
<body>
<div class="containerlogonav">
<div class="logo"><img src="mrlogo.png" alt=""/></a></div>
<div class="navigation-menu">
<div id ="navigation">
<div class="navbar">
 <a class="a" href="createAccount.php">Create Account</a>
</div>
</div>
</div>
</div>
<div class="grid-container">


<div class="center-div">
<h1 class="h1">List of Registered Accounts </h1>

	
		
</div>
<table class="paginated">
<thead>
<tr>
<th>ID</th>
<th>User</th>
<th>Password</th>
<th>Name</th>
<th>Type</th>
<th>Change Password</th>
<th>Delete Account</th>
</tr>
<thead>
<tbody>
<?php 

include "db_conn.php";

$sql = "SELECT * FROM users_all";
$result = mysqli_query($connectingDB, $sql);
$num = mysqli_num_rows($result);
while ($res = mysqli_fetch_array($result)){
	?>

	<tr>  
<td><?php echo $res['id']?></td>
<td><?php echo $res['user_name']?></td>
<td><?php echo $res['password']?></td>
<td><?php echo $res['name']?></td>
<td><?php echo $res['type']?></td>
<td><a href="updatepass.php?id=<?php echo $res['id']?>"><img src="edit.png" width="20px" height= "20px" alt=""/></td>
<td><a href="deleteaccount.php?id=<?php echo $res['id']?>"><img src="delete.png" width="20px" height= "20px" alt=""/></td>

</tr>
</div>
<?php
}
?>

</tbody>
</table>
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
<?php 
}else{
   header("location:" .$_SERVER['PHP_SELF']);
		exit();
}
 ?>