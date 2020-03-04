<?php

// mysql 연동 관련
$servername = "localhost";
$username = "ming";
$password = "bluechip1";
$dbname = "DiceShot";

$connect = mysqli_connect($servername, $username, $password, $dbname);
if ($connect->connect_error) {
    die('MySQL Connection failed : ' . $connect->connect_error);
}

?>