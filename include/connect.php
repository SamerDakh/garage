<?php
$localhost = "localhost";
$user_db = "root";
$pass_db = "";
$db = "garage";

$conn = mysqli_connect($localhost, $user_db, $pass_db, $db);

mysqli_query($conn, "SET CHARACTER SET 'hebrew'");


// Create connection
mysqli_set_charset($conn, 'utf8',);
mysqli_select_db($conn, $db);


?>
