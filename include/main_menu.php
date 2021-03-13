<!DOCTYPE html>
<html lang="he">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=chrome"/>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
<meta charset="utf-8"/>

<link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
<link href="dist/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<ul id="menu">
    <li><a href="main.php">דף הבית</a></li>
    <li>
        <a href="inventory.php">מלאי</a>

    </li>

    <li>
        <a href="#">תנועות</a>
        <ul>
            <li><a href="motion_add.php">הוספת תנועה</a></li>
            <li><a href="motions_list.php">עדכון תנועה</a></li>

        </ul>
    </li>
    <li>
        <a href="#">אלטרנטורים</a>
        <ul>
            <li><a href="alter_add.php"> הוספת אלטרנטור </a></li>
            <li><a href="alter_list.php"> עדכון אלטרנטור </a></li>
        </ul>
    </li>
    <li>
        <a href="#">מצברים</a>
        <ul>
            <li><a href="battery_add.php"> הוספת מצבר</a></li>
            <li><a href="battery_list.php"> עדכון מצבר</a></li>
        </ul>
    </li>
    <li>
        <a href="#">מדחסים</a>
        <ul>
            <li><a href="compressor_add.php"> הוספת מדחס</a></li>
            <li><a href="compressor_list.php"> עדכון מדחס </a></li>
        </ul>
    </li>
    <li>
        <a href="#">סטרטרים</a>
        <ul>
            <li><a href="starter_add.php"> הוספת סטרטר</a></li>
            <li><a href="starter_list.php">עדכון סטרטר</a></li>
        </ul>
    </li>
    </li>
    <li>
        <a href="#">אחר</a>
        <ul>
            <li><a href="others_add.php"> הוספת </a></li>
            <li><a href="others_list.php"> עדכון</a></li>
        </ul>
    </li>
    <li><a href="reports.php">דוחות</a></li>
</ul>
<?php include("include/footer.php"); ?>
</html>
