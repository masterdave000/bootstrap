<?php
session_start();
date_default_timezone_set('Asia/Manila');
define('SITEURL', 'http://localhost/obos/');
$localhost = 'localhost:3308';
$db_name = 'inspection';
$username = 'root';
$password = 'Bilaosrrmmmjg02311_';


$dsn = "mysql:host=$localhost;dbname=$db_name;charset=UTF8;";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
