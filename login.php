<?php session_start(); ?>
<?php
header("Content-Type: text/html; charset=utf-8");
?>

<!DOCTYPE html>
<html lang="he">
<head>
    <?php require("include/meta.php"); ?>


</head>
<body style="text-align:right; ">


<!--start header-->
<div id="header"><img src="img\garage-icon.png" alt="logo" height="100" width="100">
    <h2 id="title">מוסך מדין מרעי
    </h2></div><!---close header-->


<!--start home--><?php include("include/clock.php");
echo '<p id="clockbox" style="height:40px ;width:120px; float:right; margin:10px;color:black; " ></p>';
?>

<div id="home" height:300px;>


    <table>


        <td>


            <table style=" width:320px;height:160px; border: 2px solid #29384C ;background:#CCC;
    color: black;
    font-weight: bold;
    font-family: arial;
    padding: 10px;
    border-radius: 5px;
   ">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <tr>
                        <th style="padding-right: 10px;">שם משתמש</th>
                        <th style="padding-left: 10%;"><input style="height:20px;" type="text" name="username"></th>
                    </tr>
                    <tr>
                        <td style="padding-right: 10px;">סיסמה</td>
                        <td style="padding-left: 10%;"><input style="height:20px;" type="password" name="password"></td>
                    </tr>
                    <tr>

                        <td colspan="2" style="color: red; text-align:center;"><?php


                            $msg = '&nbsp';
                            if (isset($_POST['submit'])) {

                                $username = $_POST['username'];
                                $password = $_POST['password'];
                                if ((empty($username)) or (empty($password))) {
                                    $_SESSION["Login"] = "NO";
                                    $msg = '* יש שדות ריקים  ';
                                    echo "$msg";
                                } else {
                                    $localhost = "localhost";
                                    $user_db = "root";
                                    $pass_db = "";
                                    $db = "garage";

                                    $conn = mysqli_connect($localhost, $user_db, $pass_db) or die("Database Not Found");
                                    mysqli_set_charset(mysqli_connect($localhost, $user_db, $pass_db), 'utf8');
                                    mysqli_select_db($conn, $db) or die("Database Not Select");

                                    $username = $_POST['username'];
                                    $password = $_POST['password'];

                                    $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'") or die('Mysql Error');


                                    $result = mysqli_fetch_assoc($query);
                                    if ($result == 0) {
                                        $_SESSION["Login"] = "NO";
                                        $msg = '* משתמש או סיסמה אינם נכונים ';
                                        echo "$msg";
                                    } else {
                                        ob_start();
                                        mysqli_close($conn);
                                        session_start();
                                        $_SESSION['username'] = $username;

                                        $_SESSION["Login"] = "YES";
                                        echo "<script>window.location.assign('welcome.php');</script>";


                                    }


                                }

                            }

                            ?></td>
                    <tr>
                        <td></td>
                        <td><input id="buttonSubmit1"
                                   style="height:30px;width:175px;margin-top:10px;font-family: arial;" type="submit"
                                   name="submit" value="כניסה"></td>
                    </tr>
                </form>
            </table>
        </td>
        <td style="padding-right: 20%;"><img src="img\garage-img.png"></td>


    </table>

</div>


<?php include("include/footer.php"); ?>

</div><!---close home-->
</div>


</body>
</html>
