<?php include("include/session.php") ?>
<?php
header("Content-Type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html lang="he">
    <head>
 <?php


 require("include/meta.php");

 ?>


    </head>
<body style="text-align:right;">


<!--start header--> <div id="header">
<?php
	echo'<td> <img src="img/garage-icon.png" alt="logo" height="140" width="180">'
	?></div><!---close header-->

<?php

  include'include/main_menu.php';
  include("include/clock.php");
	echo'<p id="clockbox" style="height:40px ;width:120px; float:right; margin:10px;color:black; " ></p>';
	$username=$_SESSION['username'];
  echo" <p style='float:left;font-size:14px;padding:10px;font-weight:bolder;'>| שלום $username"." | "."<a style='color:blue;' href='logout.php'>יציאה</a> | </p>";
	?>

    <div id="home" style="padding:5%">

     <br><br><br>

        <?php
  echo'<h3>מצבר מוצר</h3>';

	?>


<br>



<?php



$field='battery_id';
$sort='ASC';
if(isset($_GET['sorting']))
{
  if($_GET['sorting']=='ASC')
  {
    $sort='DESC';
  }
  else
  {
    $sort='ASC';
  }
}
if(isset($_GET['field'])=='battery_id')
{
   $field = "battery_id";
}
elseif(isset($_GET['field'])=='company_name')
{
   $field = "car_id";
}
elseif(isset($_GET['field'])=='amount')
{
   $field="total_price";
}
elseif(isset($_GET['field'])=='expire_date')
{
   $field="paid";
}
elseif(isset($_GET['field'])=='amber')
{
   $field="date";
}
elseif(isset($_GET['field'])=='description')
{
   $field="description";
}

require('include/connect.php');
$sql_query="SELECT * FROM batteries  ORDER BY $field $sort";
$rs = mysqli_query($conn , $sql_query) ;
$rows=mysqli_num_rows($rs);
if($rows>0 )
{

 echo '<table id="table10" style="width:950px;" >';
 echo'<thead >';
 	echo'
		<th ><a style="color:black;" href="battery_list.php"></a></th>
		<th ><a style="color:black;" href="battery_list.php?sorting='.$sort.'&field=battery_id">מספר מצבר</a></th>
		<th ><a style="color:black;" href="battery_list.php?sorting='.$sort.'&field=company_name">שם חברה</a></th>
   	    <th ><a style="color:black;" href="battery_list.php?sorting='.$sort.'&field=amber">אמבר</a></th>
		<th ><a style="color:black;" href="battery_list.php?sorting='.$sort.'&field=amount">כמות</a></th>
		<th ><a style="color:black;" href="battery_list.php?sorting='.$sort.'&field=expire_date">תאריך תפוגה</a></th>
        <th ><a style="color:black;" href="battery_list.php?sorting='.$sort.'&field=description">פירוט</a></th>';
  echo'</thead>';

 echo'<tbody >';
 $cnt=0;
 $class='';


 while($row = mysqli_fetch_array($rs))
{
 $cnt++;

	if($cnt % 2)
	$class='odd';

	else
	$class='even';


	echo'<form  action="battery_list.php" method="POST">';
	echo "<tr class=$class >";

		echo " <td style='color:white;'>"."<input style='color:#555;width:75px;' type=submit name=update value='עדכן' "."</td>";
		echo " <td >".$row['battery_id']."</td>";
		echo " <td >".$row['company_name']."</td>";
		echo " <td >".$row['amber']."</td>";
		echo " <td >".$row['amount']."</td>";
		echo " <td >".$row['expire_date']."</td>";
        echo " <td >".$row['description']."</td>";
		echo " <td style='display:none'>"."<input  type=hidden name=hidden value=".$row['battery_id']." </td>";echo"</form>";
		echo "</tr>";

 }echo'</tbody >';

echo "</table>";




}
else
 echo"אין מצברים ברשימה";


 	if((isset($_POST['update']))) {
    $hidden = $_POST['hidden'];
      echo '<script> location.replace("battery_update.php?battery_id='.$hidden.'"); </script>';
      // alert(".$hidden.");
      // window.location('payment_update.php?battery_id=".$hidden."');</script>";
      // header("Location: google.com");
      // echo "<script> alert(".$hidden.") </script>";
      // header('Location: www.google.com');
      // header("Location: http://www.example.com/another-page.php", true, 301);
      exit(header("Location: /finished.html"));
}
?>
<br><br><br>


</div><!---close home-->


<? include'include/footer.php' ?>

</body>
</html>
