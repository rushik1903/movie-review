<!-- php connection -->
<?php
	$con=new mysqli("localhost","root","password","test");
	if (!$con) {
		die("Connection failed: " . mysqli_connect_error());
	}
	else {
		echo "Connected successfully";
	}
?>