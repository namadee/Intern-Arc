<?php

$sname = "localhost";
$username = "root";
$password = "";
$db_name = "test-db";

$conn = mysqli_connect($sname , $username, $password, $db_name);

if(!$conn){
    echo "connection failed";
}