<!DOCTYPE html>
<head>
    <meta http-equiv="refresh" content="10;login.php" charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="include/style.css" media="screen"/>
    <link href="dist/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <?php include("include/clock.php"); ?>
    <title>Expiry Inventory Management</title>
</head>
<body>
<!--start home-->
<div class="home">
    <!--start header-->
    <div id="header"><img src="img/garage-icon.png" alt="logo" height="100" width="100">
        <h2 id="title">Expiry Inventory Management</h2></div><!---close header-->


    <?php
    include("include/clock.php");
    echo '<p id="clockbox" style="height:40px ;width:120px; float:right; margin:10px;color:black; " ></p>'; ?>
    <!--close navbar-->
    <div id="home">
        <div style='text-align:left ;font-size:16px; color:#000' ;>
        </div>
        <br/><br/>
        <p style="text-align: center;color:#000;font-size: 16px;"> סליחה אתה לא מחובר ..תוך 10 שניות תועבר לדף ההתחברות
            או לחץ <a style="color: blue;" href="login.php">כאן</a></p>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <?php include("include/footer.php"); ?>

    </div><!---close home-->


</body>
</html>
