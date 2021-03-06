<?php
$SERVER = 'localhost';
$USER = 'root';
$PASSWORD = '';
$DATABASE_NAME='garage';

$_dbx = new mysqli ($SERVER,$USER,$PASSWORD);

if ($_dbx->connect_error){
 echo "Connection not detected".$_dbx->connect_error;
}

$database_sql = "CREATE DATABASE IF NOT EXISTS $DATABASE_NAME";
if ($_dbx->query($database_sql) === FALSE){
return true;
}

$table_sql = "CREATE TABLE IF NOT EXISTS $DATABASE_NAME.motions(car_id INT NOT NULL PRIMARY KEY ,owner_name VARCHAR(30),total_price INT,paied INT,is_cash BOOLEAN,check_id INT,description VARCHAR(100),date DATE)";

// $table_sql = "CREATE TABLE IF NOT EXISTS <name_of_database>.status_table(ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT, NAME VARCHAR(30) NOT NULL, STATUS VARCHAR(5) NOT NULL)";
if ($_dbx->query($table_sql) === FALSE){
echo "Table not created: ".$_dbx->error;
}
?>