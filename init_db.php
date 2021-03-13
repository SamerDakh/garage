<?php
$SERVER = 'localhost';
$USER = 'root';
$PASSWORD = '';
$DATABASE_NAME = 'garage';

$_dbx = new mysqli ($SERVER, $USER, $PASSWORD);

if ($_dbx->connect_error) {
    echo "Connection not detected" . $_dbx->connect_error;
}

$database_sql = "CREATE DATABASE IF NOT EXISTS $DATABASE_NAME";
if ($_dbx->query($database_sql) === FALSE) {
    return true;
}


#######   motions #####
$motions_table_sql = "CREATE TABLE IF NOT EXISTS $DATABASE_NAME.motions(motion_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT  ,car_id INT NOT NULL ,owner_name VARCHAR(30),total_price INT NOT NULL,paid INT NOT NULL,is_cash BOOLEAN NOT NULL,check_id INT,description VARCHAR(100) NOT NULL,date DATE NOT NULL)";

if ($_dbx->query($motions_table_sql) === FALSE) {
    echo "Table not created: motions " . $_dbx->error;
}


#######   batteries  #####
$batteries_table_sql = "CREATE TABLE IF NOT EXISTS $DATABASE_NAME.batteries(battery_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT ,amber INT NOT NULL ,company_name VARCHAR(30),amount INT NOT NULL,description VARCHAR(100) NOT NULL,expire_date DATE NOT NULL)";

if ($_dbx->query($batteries_table_sql) === FALSE) {
    echo "Table not created: batteries " . $_dbx->error;
}


?>