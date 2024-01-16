<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
?>
<html>
<head>
	<title>Upload CSV</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta http-equiv="Cache-control" content="no-cache">
</head>
<body>
<div class="containerlogonav">
<div class="logo"><img src="mrlogo.png" alt=""/></div>
</div>
<div class="form">
     <form class="form1" action="uploadfileadmin.php" method="post" enctype="multipart/form-data">
     	<h2>Upload CSV</h2>

     	<input type="file" name="csvfile" required="required"><br>
      <br>
     	<input class="button" type="submit" value="upload"/>
     </form>
	 </div>
</body>
</html>