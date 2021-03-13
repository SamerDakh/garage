<?php include("include/session.php") ?>
<!DOCTYPE html>
<html lang="he">
<head>
    <?php require("include/meta.php");
    ?>
    <?php include("include/session.php") ?>
</head>
<body style="text-align:right;">


<!--start header-->
<div id="header">
    <?php
    echo '<td> <img src="img/garage-icon.png" alt="logo" height="160" width="200">';
    ?></div><!---close header-->


<?php

include('include/main_menu.php');
include("include/clock.php");
echo '<p id="clockbox" style="height:40px ;width:120px; float:right; margin:10px;color:black; " ></p>';

$username = $_SESSION['username'];
echo " <p style='float:left;font-size:14px;padding:10px;font-weight:bolder;'>| שלום $username" . " | " . "<a style='color:blue;' href='logout.php'>יציאה</a> | </p>";
?>

<div id="home" align="center">

    <?php
    echo '<h2 style="text-align:center;color:black;">פעולות ראשיות</h2>';

    ?>
    <br>
    <table style="text-align:center;">
        <tr>
            <td style="text-align:center;border:1px solid #880000;"><a href="motion_add.php"><img src="img/motion.png"></a>
            </td>
            <td style="width:20px;"></td>
            <td style="text-align:center;border:1px solid #880000;"><a href="product_add.php"><img
                            src="img/inventory.png"></a></td>
            <td style="width:20px;"></td>
            <td style="text-align:center;border:1px solid #880000;"><a href="reports.php"><img src="img/report.png"></a>
            </td>
        </tr>
        <tr>
            <td style="text-align:center;border:1px solid #880000;"><a id="pa" href="motion_add.php">תנועה חדשה</a></td>
            <td style="width:20px;"></td>
            <td style="text-align:center;border:1px solid #880000;"><a id="pa" href="product_add.php">מוצר חדש</a></td>
            <td style="width:20px;"></td>
            <td style="text-align:center;border:1px solid #880000;"><a id="pa" href="reports.php">דוח חדש</a></td>
        </tr>
    </table>
    <br><br>


</div><!---close home-->


<? include 'include/footer.php' ?>

</body>
</html>
