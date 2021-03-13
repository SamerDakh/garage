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


<!--start header-->
<div id="header">
    <?php
    echo '<td> <img src="img/garage-icon.png" alt="logo" height="140" width="180">'
    ?></div><!---close header-->

<?php

include 'include/main_menu.php';
include("include/clock.php");
echo '<p id="clockbox" style="height:40px ;width:120px; float:right; margin:10px;color:black; " ></p>';
$username = $_SESSION['username'];
echo " <p style='float:left;font-size:14px;padding:10px;font-weight:bolder;'>| שלום $username" . " | " . "<a style='color:blue;' href='logout.php'>יציאה</a> | </p>";
?>

<div id="home" style="padding:5%">

    <br><br><br>

    <br>


    </script>
    <div id="myForm">
        <table>
            <?php
            $motion_id = '';
            if ((isset($_GET['motion_id']))) {
                $motion_id = $_GET['motion_id'];
                $_SESSION['motion_id'] = $motion_id;
            } else {
                $motion_id = $_SESSION['motion_id'];
            }


            ?>
            <form method="post" style="border:2px solid #555; width:20%;padding:3%; background:#FCFCFC;"
                  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <tr>
                    <?php
                    $_car_id = '';
                    $_owner_name = '';
                    $_total_price = '';
                    $_paid_price = '';
                    $_is_cash = '';
                    $_check_id = '';
                    $_description = '';
                    require('include/connect.php');
                    $_sql_query = "SELECT * FROM motions where motion_id='$motion_id'";
                    $_rs = mysqli_query($conn, $_sql_query) or die("Query Failed");
                    $_rows = mysqli_num_rows($_rs);
                    if ($_rows) {
                        while ($_row = mysqli_fetch_array($_rs)) {
                            $_car_id = $_row['car_id'];
                            $_owner_name = $_row['owner_name'];
                            $_total_price = $_row['total_price'];
                            $_paid_price = $_row['paid'];
                            $_is_cash = $_row['is_cash'];
                            $_check_id = $_row['check_id'];
                            $_description = $_row['description'];
                            $_date = $_row['date'];
                        }
                    }
                    echo '<h2> עדכון תנועה מספר  ' . $motion_id . ' </h2>
    <tr>
      <td> <h3>  סך הכל לתשלום  </h3> </td>
      <td style="padding-right:20px; "><h3>' . $_total_price . ' </h3></td>
    </tr>

    <tr>
      <td> <h3>  סך הכל ששולם  </h3>  </td>
      <td style="padding-right:20px; "><h3>' . $_paid_price . ' </h3></td>
    </tr>
    <tr>

        <td> <h3> סכום חדש לתשלום  </h3> </td>
        <td style="padding-right:20px; ">  <input type="text"  maxlength="10" name="new_paid_price"/><br></td>';
                    $new_paid_price = '';
                    if (isset($_POST['submit'])) {
                        $new_paid_price = $_POST['new_paid_price'];
                    }
                    if ((isset($_POST['submit'])) && (empty($new_paid_price) || (!(is_numeric($new_paid_price))) || ($new_paid_price + $_paid_price > $_total_price))) {

                        if (empty($new_paid_price)) {
                            echo "<td style='color:red;'>* יש למלא סכום חדש לתשלום </td>";
                        } elseif (!is_numeric($new_paid_price)) {
                            echo "<td style='color:red;'>* סכום ששולם צריך להיות רק מספרים </td>";
                        } elseif ($new_paid_price + $_paid_price > $_total_price) {
                            echo "<td style='color:red;'>* סכומים ששולמו גדולים מסך הכל לתשלום </td>";
                        }

                    }
                    if ((isset($_POST['submit'])) && (!empty($new_paid_price) && ((is_numeric($new_paid_price))) && ($new_paid_price + $_paid_price <= $_total_price))) {
                        $conn = mysqli_connect($localhost, $user_db, $pass_db, $db) or die("Database Not Found");

                        $sql_query = "UPDATE motions SET paid=$new_paid_price + $_paid_price WHERE motion_id=$motion_id";
                        // $sql_query="UPDATE INTO motions (car_id,owner_name,total_price,paid,is_cash,check_id,description,date)  VALUES($_car_id,'$_owner_name','$_total_price',$_paid_prices+ $new_paid_price,$_is_cash,$_check_id,'$_description','$_date')" or die('Insert failed');

                        $result = mysqli_query($conn, $sql_query) or trigger_error(mysqli_error($conn) . " " . $sql_query);
                        if ($result) {
                            echo "<script> alert('התנועה עודכנה במערכת בהצלחה ...') </script>";
                            echo "<script>window.location.assign('motions_list.php');</script>";
                        } else {
                            echo "<script> alert('הפעולה נכשלה ...') </script>";
                        }

                        mysqli_close($conn);
                    }
                    ?>
                </tr>

        </table>
        <table>
            <tr>
                <td><input id="buttonSubmit1" style="height:30px;width:150px;margin-right:75px;margin-top:10px;"
                           type="submit" name="submit" value="הוספה"></td>
                <td><input id="buttonSubmit2" style="height:30px;width:160px;margin-right:20px;margin-top:10px;"
                           type="submit" formaction="motions_list.php" name="back_to_motions"
                           value="חזרה לרשימת תנועות"></td>
                <td></td>

                </form>

        </table>
    </div>
    <br>
    <br><br><br>

    <script>

        function back_to_motions() {
            window.location.assign('motions_list.php');   // The function returns the product of p1 and p2
        }
    </script>

</body>
</html>
