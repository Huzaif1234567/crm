<?php 
session_start(); 
include "db_conn.php";
$ids = $_GET['id'];
$sql = "DELETE FROM  weeklyroster WHERE id={$ids}";
$result = mysqli_query($connectingDB, $sql);
	 header("Location: viewRoster.php?message= Roster Deleted");
	                 exit();

?>