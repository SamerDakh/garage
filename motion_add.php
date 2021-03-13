<?php include("include/session.php") ?>
<?php
header("Content-Type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html lang="he">
<head>
    <?php

    // $was_submitted=false;
    require("include/meta.php");
    //  if($was_submitted==true ) {
    //      $_SESSION['post_data'] = $_POST;
    //      header('Location: main.php', true, 303);
    //  }
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

<div id="home">

    <?php
    echo '<h2>תנועות</h2>';

    ?>

    <!--start navbar-->
    <div id="navbar">
        <ul>
            <li><a href="motion_add.php">הוספת תנועה</a></li>
            <li><a href="motions_list.php">עדכון תנועה</a></li>


        </ul>

    </div>
    <br><br><br>
    <?php
    echo '<h3>הוספת תנועה</h3>';

    ?>
    <table>
        <form method="post" style="border:2px solid #555; width:20%;padding:3%; background:#FCFCFC;"
              action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <tr>
                <td>מס רכב</td>
                <td><input type="text" maxlength="30" name="car_id"/><br></td>
                <?php
                $car_id = '';
                $owner_name = '';
                $paid_price = '';
                $total_price = '';
                $description = '';
                $is_cash = '';
                $check_id = '';
                if ((isset($_POST['submit']))) {
                    $car_id = $_POST['car_id'];
                    $owner_name = $_POST['owner_name'];
                    $paid_price = $_POST['paid_price'];
                    $total_price = $_POST['total_price'];
                    $is_cash = ($_POST['payment_type'] == 'cash') ? 1 : 0;
                    $check_id = $_POST['check_id'];
                    $description = $_POST['description'];
                }

                if ((isset($_POST['submit'])) && (empty($car_id) || (!(is_numeric($car_id))) || ((strlen($car_id) < 5) || (strlen($car_id) > 8)))) {
                    if (empty($car_id)) {
                        echo "<td style='color:red;'> * יש למלא מס' רכב<td/>";
                    } elseif (!is_numeric($car_id)) {
                        echo "<td style='color:red;'> * מס' רכב חייב להיות רק מספרים <td/>";
                    } elseif (((strlen($car_id) < 5) || (strlen($car_id) > 8))) {
                        echo "<td style='color:red;'>  * מספר רכב צריך להיות 8-5 ספרות <td/>";
                    }
                }

                ?>
            </tr>

            <tr>
                <td>שם בעל רכב</td>
                <td><input type="text" maxlength="30" name="owner_name"/><br></td>
                <?php


                if ((isset($_POST['submit'])) && (empty($owner_name) || is_numeric($owner_name))) {
                    if (empty($owner_name)) {
                        echo "<td style='color:red;'> * יש למלא שם בעל רכב <td/>";
                    }
                    if (is_numeric($owner_name)) {
                        echo "<td style='color:red;'>* שם בעל רכב צריך להיות אותיות <td/>";
                    }
                }

                ?>
            </tr>

            <tr>
                <td>סכ לתשלום</td>
                <td><input type="text" maxlength="30" name="total_price"/><br></td>
                <?php
                // echo (isset($_POST['submit'])) &&  ( empty($total_price) &&  ((!is_numeric($total_price))) ) ;
                if ((isset($_POST['submit'])) && (empty($total_price) || ((!is_numeric($total_price))) || ($paid_price > $total_price))) {
                    if (empty($total_price)) {
                        echo "<td style='color:red;'> * יש למלא סך הכל לתשלום</td>";
                    } elseif (!is_numeric($total_price)) {
                        echo "<td style='color:red;'> * סכום לתשלום צריך להיות רק מספרים </td>";
                    } elseif ($paid_price > $total_price) {
                        echo "<td style='color:red;'>  * סכום ששולם גדול מהסכום לתשלום </td>";
                    }
                }
                ?>
            </tr>
            <tr>
                <td>סכום ששולם</td>
                <td><input type="text" maxlength="30" name="paid_price"/><br></td>
                <?php
                if ((isset($_POST['submit'])) && (empty($paid_price) || (!(is_numeric($paid_price))))) {
                    if (empty($paid_price)) {
                        echo "<td style='color:red;'>* יש למלא סכום ששולם</td>";
                    } elseif (!is_numeric($paid_price)) {
                        echo "<td style='color:red;'> * סכום ששולם צריך להיות רק מספרים </td>";
                    } elseif ($paid_price > $total_price) {
                        echo "<td style='color:red;'>  * סכום ששולם גדול מהסכום לתשלום </td>";
                    }
                }
                ?>
            </tr>
            <tr>
                <td>אופן תשלום</td>
                <td>
                    <select name="payment_type" id="payment_type" style="width:100%">
                        <option value="cash">מזומן</option>
                        <option value="check">ציק</option>

                    </select><br></td>

            </tr>
            <tr>
                <td>מספר ציק</td>
                <td><input type="text" maxlength="30" name="check_id"/><br></td>
                <?php
                if ((isset($_POST['submit'])) && ((empty($paid_price) && $is_cash == false) || (!(is_numeric($check_id))))) {
                    if (empty($check_id) && $is_cash == false) {
                        echo "<td style='color:red;'>* אופן התשלום הוא ציק - לכן חובה למלא מספר ציק</td>";
                    } elseif (!is_numeric($check_id) && $is_cash == false) {
                        echo "<td style='color:red;'> * מספר ציק צריך להיות רק מספרים </td>";
                    }

                }
                ?>
            </tr>
            <tr>
                <td>פירוט</td>
                <td><input type="text" maxlength="30" name="description"/><br></td>
                <?php
                if ((isset($_POST['submit'])) && (empty($description))) {
                    if (empty($description)) {
                        echo "<td style='color:red;'> * יש למלא פירוט <td/>";
                    }
                }
                ?>
            </tr>
    </table>
    <table>
        <tr>
            <td><input id="buttonSubmit1" style="height:30px;width:150px;margin-right:75px;margin-top:10px;"
                       type="submit" name="submit" value="הוספה"></td>
            <td><input id="buttonSubmit" style="height:30px;width:60px;margin-right:20px;margin-top:10px;" type="reset"
                       name="clear" value="אפס"></td>
            <td></td>
            <?php
            if ((isset($_POST['submit'])) &&
                (!(empty($car_id) || (!(is_numeric($car_id))) || ((strlen($car_id) < 5) || (strlen($car_id) > 8)))) &&
                (!(empty($owner_name) && !ctype_digit($owner_name))) &&
                (!(empty($description))) &&
                ((($is_cash)) || (is_numeric($check_id) && (!$is_cash)) && !empty($check_id)) &&
                (!((empty($total_price)) && (!(ctype_digit($total_price))))) &&
                (!((empty($paid_price)) && (!(ctype_digit($paid_price))))) &&
                (!($paid_price > $total_price))
            ) {
                $localhost = "localhost";
                $user_db = "root";
                $pass_db = "";
                $db = "garage";
                $check_id = (!empty($check_id) && !$is_cash) ? $check_id : "NULL";

                $conn = mysqli_connect($localhost, $user_db, $pass_db, $db) or die("Database Not Found");
                $date = date("Y-m-d");
                $sql_query = "INSERT INTO motions (car_id,owner_name,total_price,paid,is_cash,check_id,description,date)  VALUES($car_id,'$owner_name','$total_price',$paid_price,$is_cash,$check_id,'$description','$date')" or die('Insert failed');

                $result = mysqli_query($conn, $sql_query) or trigger_error(mysqli_error($conn) . " " . $sql_query);
                if ($result) {
                    echo "<script> alert('התנועה עודכנה במערכת בהצלחה ...') </script>";
                } else {
                    echo "<script> alert('הפעולה נכשלה ...') </script>";
                }

                mysqli_close($conn);
                echo "<script>window.location.assign('motion_add.php');</script>";
            }

            ?>
        </tr>
    </table>
    </form>
</div>
</body>
</html>
