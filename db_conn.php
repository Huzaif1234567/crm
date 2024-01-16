<!-- <php
$DSN='mysql:host = localhost; dbname=test-db';
$connectingDb = new PDO($DSN,'Root','test-db',"");

?> -->
<?php
                    $hostname = "localhost";
                    $username = 'crm_admin'; 
                    $password = '1234!'; 
                    $database = "crm_db";
                    $connectingDB = mysqli_connect($hostname, $username, $password, $database);

                    if (!$connectingDB) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
?>