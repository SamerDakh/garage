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

<div id="home">

    <?php
    echo '<h2>אלטרנטורים</h2>';

    ?>

    <!--start navbar-->
    <div id="navbar">
        <ul>
            <li style="width: auto"><a href="alter_add.php">הוספת אלטרנטור</a></li>
            <li style="width: auto"><a href="alter_list.php">עדכון אלטרנטור</a></li>
        </ul>

    </div>
    <br><br><br>
    <?php
    echo '<h3>הוספת אלטרנטור</h3>';

    ?>
    <table>
        <form method="post" style="border:2px solid #555; width:20%;padding:3%; background:#FCFCFC;"
              action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <tr>

                <?php
                $alter_id = '';
                $cars = '';
                $amber = '';
                $amount = '';
                $description = '';
                $status= '';
                $from_year= '';
                $to_year= '';


                if ((isset($_POST['submit']))) {

//                    $alter_id = $_POST['company_name'];
                    $cars = $_POST['cars'];
                    $amber = $_POST['amber'];
                    $amount = $_POST['amount'];
                    $description = $_POST['description'];
                    $status= $_POST['status'];
                    $from_year= $_POST['from_year'];
                    $to_year= $_POST['to_year'];
                }


                ?>
            </tr>

            <tr>
                <td>רכב</td>
                <td><input type="text" maxlength="30" name="cars"/><br></td>
                <?php


                if ((isset($_POST['submit'])) && (empty($cars) || is_numeric($cars))) {
                    if (empty($cars)) {
                        echo "<td style='color:red;'> * יש למלא שם רכב <td/>";
                    }
                    if (is_numeric($cars)) {
                        echo "<td style='color:red;'>* שם רכב  צריך להיות אותיות <td/>";
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
                <td> מצב</td>
                <td>
                    <select name="status" id="status" style="width:100%">
                        <option value="new">חדש</option>
                        <option value="repaired">משובץ</option>

                    </select><br></td>

            </tr>

            <tr>
                <td>משנת</td>
                <td><input type="text" maxlength="30" name="from_year"/><br></td>
                <?php
                if ((isset($_POST['submit'])) && (empty($from_year) || (!(is_numeric($from_year))) || (0 > $from_year))) {
                    if (empty($from_year)) {
                        echo "<td style='color:red;'>* יש למלא שנה</td>";
                    } elseif (!is_numeric($from_year)) {
                        echo "<td style='color:red;'> * שנה צריכה להיות רק מספרים </td>";
                    } elseif (0 > $from_year) {
                        echo "<td style='color:red;'>  * שנה צריכה להיות גדול מאפס </td>";
                    }
                }
                ?>
            </tr>
            <tr>
                <td>עד שנת</td>
                <td><input type="text" maxlength="30" name="to_year"/><br></td>
                <?php
                if ((isset($_POST['submit'])) && (empty($to_year) || (!(is_numeric($to_year))) || (0 > $to_year)  || ($from_year > $to_year) )) {
                    if (empty($to_year)) {
                        echo "<td style='color:red;'>* יש למלא שנה</td>";
                    } elseif (!is_numeric($to_year)) {
                        echo "<td style='color:red;'> * שנה צריכה להיות רק מספרים </td>";
                    } elseif (0 > $to_year) {
                        echo "<td style='color:red;'>  * שנה צריכה להיות גדול מאפס </td>";
                    }
                     elseif ($from_year > $to_year) {
                        echo "<td style='color:red;'>  * עד-שנה צריכה להיות גדול או שווה ל- משנה </td>";
                    }
                }
                ?>
            </tr>
            <tr>
                <td>כמות</td>
                <td><input type="text" maxlength="30" name="amount"/><br></td>
                <?php
                if ((isset($_POST['submit'])) && (empty($amount) || (!(is_numeric($amount))) || (0 > $amount))) {
                    if (empty($amount)) {
                        echo "<td style='color:red;'>* יש למלא כמות</td>";
                    } elseif (!is_numeric($amount)) {
                        echo "<td style='color:red;'> * כמות צריכה להיות רק מספרים </td>";
                    } elseif (0 > $amount) {
                        echo "<td style='color:red;'>  * כמות צריכה להיות גדול מאפס </td>";
                    }
                }
                ?>
            </tr>


            <tr>
                <td>פירוט</td>
                <td><input type="text" name="description"/><br></td>
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
            if ( (isset($_POST['submit'])) &&
                (!(empty($description))) &&
                (!(empty($cars) || is_numeric($cars))) &&
                (!(empty($amount) || (!(is_numeric($amount))) || (0 > $amount)) &&
                (!(empty($from_year)  || (!(is_numeric($from_year))) || (0 > $from_year)  ) ) &&
                (!(empty($to_year)    || (!(is_numeric($to_year))) || (0 > $to_year)  || ($from_year > $to_year) ) )
            ) ){
                require('include/connect.php');

                $sql_query = "SELECT * FROM alternators WHERE cars='$cars' AND from_year='$from_year'  AND to_year='$to_year' AND status='$status' AND amber=$amber " or die("Error");

                $rs = mysqli_query($conn, $sql_query);

                $rows = mysqli_num_rows($rs);
                if ($rows > 0) {
                    $row = mysqli_fetch_array($rs);
                    $total_amount = $row['amount'] + $amount;

                    $alter_id = $row['alternator_id'];

                    $row = mysqli_fetch_array($rs);
                    $sql_query = "UPDATE alternators SET amount=" . $total_amount . " WHERE alternator_id=" . $alter_id;


                    $result = mysqli_query($conn, $sql_query) or trigger_error(mysqli_error($conn) . " " . $sql_query);
                    if ($result) {
                        echo "<script> alert('הכמות עודכנה בהצלחה ...') </script>";
                    } else {
                        echo "<script> alert('הפעולה נכשלה ...') </script>";
                    }

                } else {
                    $sql_query = "INSERT INTO alternators ( cars, status, amber, from_year ,to_year ,amount ,description) VALUES  ( '$cars', '$status','$amber', '$from_year','$to_year',$amount,'$description') " or die('Insert failed');
                    $result = mysqli_query($conn, $sql_query) or trigger_error(mysqli_error($conn) . " " . $sql_query);
//                    echo $sql_query;
                    if ($result) {
                        echo "<script> alert(' עודכן במערכת בהצלחה ...') </script>";
                    } else {
                        echo "<script> alert('הפעולה נכשלה ...') </script>";
                    }

                }
                mysqli_close($conn);
                echo "<script>window.location.assign('alter_add.php');</script>";
            }
            ?>
        </tr>
    </table>
    </form>
</div>
</body>
</html>
