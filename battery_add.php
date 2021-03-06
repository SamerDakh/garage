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
	  $username=$_SESSION['username']; echo" <p style='float:left;font-size:14px;padding:10px;font-weight:bolder;'>| שלום $username"." | "."<a style='color:blue;' href='logout.php'>יציאה</a> | </p>";
	?>

<div id="home">

	<?php
   echo'<h2>מצברים</h2>';

	?>

    <!--start navbar-->
    <div id="navbar">
		<ul >
			<li> <a href="battery_add.php">הוספת מצבר</a></li>
			<li> <a href="battery_list.php">עדכון מצבר</a></li>
		</ul>

	</div>
  <br><br><br>
  <?php
  echo'<h3>הוספת מצבר</h3>';

	?>
  <table>
    <form method="post" style="border:2px solid #555; width:20%;padding:3%; background:#FCFCFC;" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" >
    <tr>

          <?php
          $battery_id='';
          $company_name='';
          $amber='';
          $amount='';
          $description='';
          $expire_date='';

          if(  (isset($_POST['submit']))){
            $company_name= $_POST['company_name'];
            $amber= $_POST['amber'];
            $amount= $_POST['amount'];
            $expire_date= $_POST['expire_date'];
            $description= $_POST['description'];
          }


         ?>
    </tr>

    <tr>
        <td>שם חברה </td>
        <td>  <input type="text"  maxlength="30" name="company_name"/><br></td>
          <?php


          if(  (isset($_POST['submit'])) &&  ( empty($company_name) || is_numeric($company_name) ) ){
              if (empty($company_name)){
                  echo"<td style='color:red;'> * יש למלא שם חברה <td/>";
               }
               if (is_numeric($company_name)){
                   echo"<td style='color:red;'>* שם חברה  צריך להיות אותיות <td/>";
                }
         }

         ?>
    </tr>

   <tr>
        <td> אמבר</td>
        <td>
            <select name="amber" id="amber" style="width:100%">
              <option value="12">12</option>
              <option value="24">24</option>

            </select><br></td>

    </tr>
    <tr>
        <td>כמות</td>
        <td>  <input type="text"  maxlength="30" name="amount"/><br></td>
          <?php
          if(  (isset($_POST['submit'])) &&  ( empty($amount) ||  (!(is_numeric($amount)))  || (0>$amount)) ){
              if (empty($amount)){
                  echo"<td style='color:red;'>* יש למלא כמות</td>";
               }
               elseif (!is_numeric($amount)){
                   echo"<td style='color:red;'> * כמות צריכה להיות רק מספרים </td>";
               }
               elseif (0>$amount) {
                   echo"<td style='color:red;'>  * כמות צריכה להיות גדול מאפס </td>";
               }
         }
         ?>
    </tr>

    <tr>
        <td>תאריך תפוגה</td>
        <td>  <input type="date"  name="expire_date"/><br></td>
      <?php
        $today_in_sec = Strtotime(date('Y-m-d'));
        $expire_date_in_sec = Strtotime($expire_date);
        if(  (isset($_POST['submit'])) &&  ( empty($expire_date) || ($expire_date_in_sec < $today_in_sec ) ) ){
              if (empty($expire_date)){
                  echo"<td style='color:red;'> * יש למלא תאריך תפוגה <td/>";
               }
                elseif ($expire_date_in_sec < $today_in_sec ) {
                   echo"<td style='color:red;'>* תאריך תפוגה ישן <td/>";
                }
         }
         ?>
    </tr>
    <tr>
        <td>פירוט</td>
        <td>  <input type="text"  name="description"/><br></td>
          <?php
          if(  (isset($_POST['submit'])) &&  ( empty($description)  ) ){
              if (empty($description)){
                  echo"<td style='color:red;'> * יש למלא פירוט <td/>";
               }
         }
         ?>
    </tr>


  </table>
  <table>
    <tr>
      <td> <input id="buttonSubmit1"  style="height:30px;width:150px;margin-right:75px;margin-top:10px;" type="submit" name="submit"  value="הוספה"></td>
      <td> <input id="buttonSubmit"  style="height:30px;width:60px;margin-right:20px;margin-top:10px;" type="reset" name="clear" value="אפס"></td>
      <td></td>
      <?php
      if(  (isset($_POST['submit'])) &&
           (! ( empty($description) ) ) &&
           (! ( empty($amount) ||  (!(is_numeric($amount))) )  ) &&
           (! ( empty($company_name) || is_numeric($company_name) ) ) &&
           ( ! ( empty($amount) ||  (!(is_numeric($amount)))  || (0>$amount)))

      ){
        require('include/connect.php');
        $sql_query="SELECT * FROM batteries WHERE company_name='$company_name' AND expire_date='$expire_date' AND amber=$amber ";

        $rs = mysqli_query($conn , $sql_query)  ;

        $rows=mysqli_num_rows($rs);
        if($rows>0 )
        {
            $row = mysqli_fetch_array($rs);
            $total_amount=$row['amount']+$amount;

            $battery_id=$row['battery_id'];

            $row = mysqli_fetch_array($rs);
            $sql_query="UPDATE batteries SET amount=".$total_amount." WHERE battery_id=".$battery_id;


            $result=mysqli_query($conn , $sql_query) or  trigger_error(mysqli_error($conn)." ".$sql_query);
            if($result){
                echo "<script> alert('הכמות עודכנה בהצלחה ...') </script>";
            }
            else {
                echo "<script> alert('הפעולה נכשלה ...') </script>";
            }

        }
        else{

            $sql_query="INSERT INTO batteries ( amber, company_name, amount, description, expire_date) VALUES  ( '$amber', '$company_name', '$amount','$description', '$expire_date') " or die('Insert failed');
            $result=mysqli_query($conn , $sql_query) or  trigger_error(mysqli_error($conn)." ".$sql_query);
            if($result){
                echo "<script> alert(' עודכן במערכת בהצלחה ...') </script>";
            }
            else {
                echo "<script> alert('הפעולה נכשלה ...') </script>";
            }

        }
            mysqli_close($conn);
            echo "<script>window.location.assign('battery_add.php');</script>";
            }
      ?>
    </tr>
  </table>
  </form>
</body>
</html>
