<?php include("include/session.php") ?>
<?php
header("Content-Type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html lang="he">
<head>
    <?php require("include/meta.php"); ?>


    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>


</head>
<body style="text-align:right;">


<!--start header-->
<div id="header">
    <?php
    echo '<td> <img src="img/logo EIM.JPG.png" alt="logo" height="140" width="180">'
    ?></div><!---close header-->


<?php

include 'include/main_menu.php'; ?>
<? include("include/clock.php");
echo '<p id="clockbox" style="height:40px ;width:120px; float:right; margin:10px;color:black; " ></p>';
$username = $_SESSION['username'];
echo " <p style='float:left;font-size:14px;padding:10px;font-weight:bolder;'>| שלום $username" . " | " . "<a style='color:blue;' href='logout.php'>יציאה</a> | </p>";
?>
<div id="home">

    <?php
    echo '<h2 id="aa">דוחות</h2>';

    ?>
    <br><br>


    <?php
    echo '<p style="font-size:16px;font-weight:bolder;">לפי תנועות:</p> '

    ?>
    <br> <br>
    <form action="<?php echo $PHP_SELF; ?>" method="POST">
        <tr>
            <input type="radio" name="radiob" value="מכירה"> מכירות
            <input style="margin-right:30px;" type="radio" name="radiob" value="קניה"> קניות
            <input style="margin-right:30px;" type="radio" name="radiob" value="השמדה"> השמדות
            <input style="margin-right:30px;" type="radio" name="radiob" value="החזרה"> החזרות
        </tr>
        <br> <br>
        <tr>מתאריך
            <input style="margin-right:10px; margin-left:30px;" type="date" name="from">

            עד תאריך
            <input style="margin-right:10px;" type="date" name="to">
        </tr>
        <br> <br>
        <tr>
            <td><input id="buttonSubmit1" style="height:30px;width:200px;margin-right:150px;margin-top:10px;"
                       type="submit" name="add1" value="הצג">

        </tr>
        <br><br><br>
        <hr>
        <br><br>


    </form>
    <form action="<?php echo $PHP_SELF; ?>" method="POST">
        <tr>
            <?php
            echo '<p style="font-size:16px;font-weight:bolder;">  לפי קוד תעודת קניה :</p> '

            ?>

            <br> <br>
            קוד תעודה :
            <input style="margin-right:10px;width:90px;height:20px;" type="text" name="acc">
        </tr>
        <br>

        <td><input id="buttonSubmit1" style="height:30px;width:200px;margin-right:150px;margin-top:10px;" type="submit"
                   name="add2" value="הצג">
        </td>
            <br>
            <br> <?php

            if (isset($_POST['add2'])) {


                if (!ctype_digit($_POST['acc'])) {
                    echo "<p style='color:red;'>* קוד תעודה חייב להיות רק מספרים<p/>";
                }


                if (!(strlen($_POST['acc']) == 6)) {
                    echo "<p style='color:red;'>* קוד תעודה בן 6 ספרות<p/>";
                } else {

                    $OverAllPrice = 0;
                    $OverAllAmount = 0;
                    $OverAllMotions = 0;

                    require('include/connect.php');
                    $q = "SELECT  *
FROM  `motions` WHERE acc_id=$_POST[acc] ";
                    $rs = mysql_query($q);
                    $s = mysql_num_rows($rs);

                    if ($s) {

                        ?>
                        <hr>
                        <br>

                        <?php
                        echo '<p style="font-size:16px;">  דוח תעודה מספר ' . $_POST['acc'] . '</p>';
                        ?>


                        <?php
                        echo '<table id="table2" style=" overflow:auto;">';
                        echo '<thead >';
                        echo '
		
        <th style="color:white;width:120px;"><a style="color:white;width:120px;">קוד תנועה</a></th>
		
        <th style="color:white;width:120px;"><a style="color:white;width:120px;">זמן</a></th>
		
   		<th style="color:white;width:140px;"><a style="color:white;width:120px;">קוד מוצר</a></th>
		
        <th style="color:white;width:110px;" ><a style="color:white;width:120px;">כמות</a></th>
		<th style="color:white;width:110px;" ><a style="color:white;width:120px;">מחיר ₪ </a></th>
        <th style="color:white;width:120px;"><a style="color:white;width:120px;">שם ספק</a></th>
		<th style="color:white;width:120px;"><a style="color:white;width:120px;">תאריך תפוגה</a></th>';
                        echo '</thead>';

                        echo '<tbody >';

                        while ($sar = mysql_fetch_assoc($rs)) {


                            echo "<tr >";

                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . $sar['mo_id'] . " </td>";
                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . substr($sar['date'], 0, 10) . " </td>";
                            echo " <td style='width:140px;height:20px;background:white;border:1px solid black' >" . $sar['pro_id'] . " </td>";

                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . $sar['amount'] . " </td>";
                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . $sar['price'] . " </td>";
                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . $sar['supplier_name'] . " </td>";
                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . $sar['expiry_date'] . " </td>";
                            echo "</tr>";

                            $OverAllPrice = $OverAllPrice + ($sar['price'] * $sar['amount']);
                            $OverAllAmount = $OverAllAmount + $sar['amount'];
                            $OverAllMotions++;
                        }
                    }

                }
                echo "<tr>";

                echo " 
  <tr>
    <td style='font-size:16px;background:white;'> ערך תעודה    </td>
    <td style='font-size:16px;background:white;'>  $OverAllPrice ₪</td>		
   
  </tr>
  <tr>
    <td style='font-size:16px;background:white;'>מוצרים  </td>
    <td style='font-size:16px;background:white;'>  $OverAllAmount</td>		
    
  </tr>
  <tr>
    <td style='font-size:16px;background:white;'>תנועות  </td>
    <td style='font-size:16px;background:white;'>  $OverAllMotions</td>		
    
  </tr>";
            }
            ?>
            </tr><br><br>


            <br>


            <?php


            if (isset($_POST['add1']) && (!empty($_POST['radiob'])) && $_POST['from'] < $_POST['to']) {

                $radiob = $_POST['radiob'];
                $from = $_POST['from'];
                $to = $_POST['to'];

                $OverAllPrice = 0;
                $OverAllAmount = 0;
                $OverAllMotions = 0;

                if (isset($_POST['add1'])) {
                    if ($_POST['radiob'] == 'קניה')
                        $msg = 'קניות';
                    elseif ($_POST['radiob'] == 'מכירה')
                        $msg = 'מכירות';
                    elseif ($_POST['radiob'] == 'החזרה')
                        $msg = 'החזרות';
                    elseif ($_POST['radiob'] == 'השמדה')
                        $msg = 'השמדות';

                }


                require('include/connect.php');
                $q = "SELECT  *
FROM  `motions` WHERE motion_type='$radiob' AND date > '$from' AND date<'$to' ";
                $rs = mysql_query($q);
                $s = mysql_num_rows($rs);

                if ($s) {

                    ?>
                    <hr>
                    <br>

                    <?php
                    echo '<p style="font-size:16px;"> דוח ' . $msg . ' מתאריך ' . $from . ' לתאריך ' . $to . '</p>';
                    ?>

                    <br><br>
                    <?php
                    if ($_POST['radiob'] == 'קניה') {
                        echo '<table id="table2" style=" overflow:auto;">';
                        echo '<thead >';
                        echo '
		
        <th style="color:white;width:120px;"><a style="color:white;width:120px;">קוד תנועה</a></th>
		
        <th style="color:white;width:120px;"><a style="color:white;width:120px;">זמן</a></th>
		<th style="color:white;width:120px;"><a style="color:white;width:120px;">קוד תעודה</a></th>
   		<th style="color:white;width:140px;"><a style="color:white;width:120px;">קוד מוצר</a></th>
		
        <th style="color:white;width:110px;" ><a style="color:white;width:120px;">כמות</a></th>
		<th style="color:white;width:110px;" ><a style="color:white;width:120px;">מחיר ₪ </a></th>
        <th style="color:white;width:120px;"><a style="color:white;width:120px;">שם ספק</a></th>
		<th style="color:white;width:120px;"><a style="color:white;width:120px;">תאריך תפוגה</a></th>';
                        echo '</thead>';

                        echo '<tbody >';

                        while ($sar = mysql_fetch_assoc($rs)) {


                            echo "<tr >";

                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . $sar['mo_id'] . " </td>";
                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . substr($sar['date'], 0, 10) . " </td>";
                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . $sar['acc_id'] . " </td>";
                            echo " <td style='width:140px;height:20px;background:white;border:1px solid black' >" . $sar['pro_id'] . " </td>";

                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . $sar['amount'] . " </td>";
                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . $sar['price'] . " </td>";
                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . $sar['supplier_name'] . " </td>";
                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . $sar['expiry_date'] . " </td>";
                            echo "</tr>";
                            $OverAllPrice = $OverAllPrice + ($sar['price'] * $sar['amount']);
                            $OverAllAmount = $OverAllAmount + $sar['amount'];
                            $OverAllMotions++;
                        }
                    } else {
                        echo '<table id="table2" style=" overflow:auto;">';
                        echo '<thead >';
                        echo '
		
        <th style="color:white;width:121px;"><a style="color:white;width:120px;">קוד תנועה</a></th>
		
        <th style="color:white;width:121px;"><a style="color:white;width:120px;">זמן</a></th>
	
   		<th style="color:white;width:127px;"><a style="color:white;width:120px;">קוד מוצר</a></th>
		
        <th style="color:white;width:120px;" ><a style="color:white;width:120px;">כמות</a></th>
		<th style="color:white;width:120px;" ><a style="color:white;width:120px;">מחיר ₪ </a></th>
       
		<th style="color:white;width:124px;"><a style="color:white;width:120px;">תאריך תפוגה</a></th>';
                        echo '</thead>';

                        echo '<tbody >';

                        while ($sar = mysql_fetch_assoc($rs)) {


                            echo "<tr >";

                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . $sar['mo_id'] . " </td>";
                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . substr($sar['date'], 0, 10) . " </td>";

                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . $sar['pro_id'] . " </td>";

                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . $sar['amount'] . " </td>";
                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . $sar['price'] . " </td>";

                            echo " <td style='width:120px;height:20px;background:white;border:1px solid black' >" . $sar['expiry_date'] . " </td>";
                            echo "</tr>";
                            $OverAllPrice = $OverAllPrice + ($sar['price'] * $sar['amount']);
                            $OverAllAmount = $OverAllAmount + $sar['amount'];
                            $OverAllMotions++;
                        }
                    }


                    echo "<tr>";

                    echo " 
  <tr>
    <td style='font-size:16px;background:white;'>ערך $msg  </td>
    <td style='font-size:16px;background:white;'>  $OverAllPrice ₪</td>		
   
  </tr>
  <tr>
    <td style='font-size:16px;background:white;'>מוצרים  </td>
    <td style='font-size:16px;background:white;'>  $OverAllAmount</td>		
    
  </tr>
  <tr>
    <td style='font-size:16px;background:white;'>תנועות  </td>
    <td style='font-size:16px;background:white;'>  $OverAllMotions</td>		
    
  </tr>";


                    echo '</tbody >';


                    echo "</table>";


                } else
                    echo "אין תנועות ";
            }


            ?>


</div><!---close home-->


<? include 'include/footer.php' ?>

</body>
</html>