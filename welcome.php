<?php

$d = date("Y-m-d", strtotime("+2 week"));


include 'main.php';
include('include/connect.php');
// 	$q="SELECT  * FROM  inventory WHERE  expiry_date <  '$d'
//   ";
// 	$rs = mysql_query($q) or die("asdasdasd");
//    $s=mysql_num_rows($rs);
// 
// 	if($s)
// 	{
// echo "<script type='text/javascript'>alert('יש מוצרים במלאי שתאריך התפוגה שלהם פחות מ 14 ימים');</script>";//alert meesage
//
//
//
//  }
// session_start();
$_SESSION["Login"] = "YES";
$username ="";
$_SESSION['username'] = $username;
echo "<script>window.location.assign('main.php');</script>";

?>
