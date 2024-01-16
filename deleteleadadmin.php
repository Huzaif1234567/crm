<?php 
session_start(); 
include "db_conn.php";
$ids = $_GET['id'];
$sql = "DELETE FROM leadform WHERE id={$ids}";
$result = mysqli_query($connectingDB, $sql);
if($result){
	?>
	<script>
	alert("Deleted Successfully");
</script>
<?php
} else {
	?>
	<script>
	alert("Not Deleted");
</script>
<?php
}
header('location:dashboardadmin.php')
?>