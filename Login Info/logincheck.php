<?php

define( 'DB_NAME', 'login' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', 'Iamtheuwu1' );
define( 'DB_HOST', 'localhost' );


	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // Check connection
 	 if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	  }


	$usn = $_POST['usn'];
	$psw = $_POST['psw'];



	$sql = "SELECT * FROM user WHERE usn='$usn' AND psw='$psw'";

	mysqli_query($conn, $sql);

mysqli_close($conn);

?>
