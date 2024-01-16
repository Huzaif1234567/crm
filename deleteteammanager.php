<?php 
session_start(); 
include "db_conn.php";
$ids = $_GET['id'];
$sql = "DELETE FROM managerteam WHERE id={$ids}";
$result = mysqli_query($connectingDB, $sql);
	 header("Location: EditViewTeam.php?message=Account Deleted");
	                 exit();

?>