<!DOCTYPE html>
<html lang="he">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="IE=chrome"/>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
        <meta charset="utf-8" />

        <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
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
        <a href="#">מוצרים</a>
        <ul>
              <li><a href="product_add.php">הוספת מוצר</a></li>
            <li><a href="product_update.php">עדכון מוצר</a></li>
            <li><a href="product_freeze.php">הקפאת מוצר</a></li>
        </ul>
    </li>
    <li>
        <a href="#">ספקים</a>
        <ul>
              <li><a href="supplier_add.php">הוספת ספק</a></li>
            <li><a href="supplier_update.php">עדכון ספק</a></li>

        </ul>
    </li>
    <li><a href="reports.php">דוחות</a></li>
</ul>
<?php include("include/footer.php"); ?>
</html>
