<?php

session_start();
$_SESSION["Login"] = "NO";

echo "<script>window.location.assign('login.php');</script>";

?>
