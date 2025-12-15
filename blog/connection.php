<?php

$server = 'localhost';
$user = 'root';
$password = '';
$databaseName = 'myblog';
$port = 3306;
$conn = mysqli_connect($server, $user, $password, $databaseName, $port);
if (!$conn) {
    echo "Connection Failed";
}else{
    //echo "Connected Successfully";
}