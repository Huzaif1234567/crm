<?php 
session_start(); 
include "db_conn.php";
$ids = $_GET['id'];
$sql = "DELETE FROM users_all WHERE id={$ids}";
$result = mysqli_query($connectingDB, $sql);
	 header("Location: manageAccounts.php?message=Account Deleted");
	                 exit();

?>