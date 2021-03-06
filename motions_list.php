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
  echo'<h3>עדכון מוצר</h3>';

	?>


<br>



<?php



$field='motion_id';
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
if(isset($_GET['field'])=='motion_id')
{
   $field = "motion_id";
}
elseif(isset($_GET['field'])=='car_id')
{
   $field = "car_id";
}
elseif(isset($_GET['field'])=='total_price')
{
   $field="total_price";
}
elseif(isset($_GET['field'])=='paid')
{
   $field="paid";
}
elseif(isset($_GET['field'])=='date')
{
   $field="date";
}
elseif(isset($_GET['field'])=='is_cash')
{
   $field="date";
}
elseif(isset($_GET['field'])=='check_id')
{
   $field="date";
}
elseif(isset($_GET['field'])=='description')
{
   $field="description";
}

require('include/connect.php');
$sql_query="SELECT * FROM motions  ORDER BY $field $sort";
$rs = mysqli_query($conn , $sql_query) ;
$rows=mysqli_num_rows($rs);
if($rows>0 )
{

 echo '<table id="table10" style="width:950px;" >';
 echo'<thead >';
 	echo'
		<th ><a style="color:black;" href="motions_list.php"></a></th>
		<th ><a style="color:black;" href="motions_list.php?sorting='.$sort.'&field=motion_id">מספר תנועה</a></th>
   	<th ><a style="color:black;" href="motions_list.php?sorting='.$sort.'&field=car_id">מספר רכב</a></th>
		<th ><a style="color:black;" href="motions_list.php?sorting='.$sort.'&field=owner_name">שם בעל רכב</a></th>
		<th ><a style="color:black;" href="motions_list.php?sorting='.$sort.'&field=total_price">סך הכל לתשלום</a></th>
		<th ><a style="color:black;" href="motions_list.php?sorting='.$sort.'&field=paid">סכום ששולם</a></th>
    <th ><a style="color:black;" href="motions_list.php?sorting='.$sort.'&field=is_cash">אופן תשלום</a></th>
    <th ><a style="color:black;" href="motions_list.php?sorting='.$sort.'&field=check_id">מספר ציק</a></th>
    <th ><a style="color:black;" href="motions_list.php?sorting='.$sort.'&field=date">תאריך</a></th>
    <th ><a style="color:black;" href="motions_list.php?sorting='.$sort.'&field=description">פירוט</a></th>';
  echo'</thead>';

 echo'<tbody >';
 $cnt=0;
 $class='';


 while($row = mysqli_fetch_array($rs))
{
$car_id='';
 $cnt++;

	if($cnt % 2)
	$class='odd';

	else
	$class='even';
 if (strlen($row['car_id']) ==7 )
    $car_id=substr($row['car_id'],0,2)."-".substr($row['car_id'],2,3)."-".substr($row['car_id'],5,2);
elseif (strlen($row['car_id']) ==8) {
    $car_id=substr($row['car_id'],0,3)."-".substr($row['car_id'],3,2)."-".substr($row['car_id'],5,3);
}else {
  $car_id=$row['car_id'];
}
$payment_type='';
$check_id='';
if($row['is_cash']==1){
  $payment_type='מזומן';
  $check_id="";
}
else {
  $payment_type='ציק';
  $check_id=$row['check_id'];
}
	echo'<form  action="motions_list.php" method="POST">';
	echo "<tr class=$class >";

		echo " <td style='color:white;'>"."<input style='color:#555;width:75px;' type=submit name=update value='עדכן' "."</td>";
		echo " <td >".$row['motion_id']."</td>";
		echo " <td >".$car_id."</td>";
		echo " <td >".$row['owner_name']."</td>";
		echo " <td >".$row['total_price']."</td>";
		echo " <td >".$row['paid']."</td>";
    echo " <td >".$payment_type."</td>";
    echo " <td >".$check_id."</td>";
    echo " <td >".$row['date']."</td>";
    echo " <td >".$row['description']."</td>";
		echo " <td style='display:none'>"."<input  type=hidden name=hidden value=".$row['motion_id']." </td>";echo"</form>";
		echo "</tr>";

 }echo'</tbody >';

echo "</table>";




}
else
 echo"אין מוצרים ברשימה";


 	if((isset($_POST['update']))) {
    $hidden = $_POST['hidden'];
      echo '<script> location.replace("payment_update.php?motion_id='.$hidden.'"); </script>';
      // alert(".$hidden.");
      // window.location('payment_update.php?motion_id=".$hidden."');</script>";
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
