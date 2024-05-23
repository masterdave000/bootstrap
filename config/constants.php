<?php
session_start();
date_default_timezone_set('Asia/Manila');
define('SITEURL', '/');
$localhost = 'localhost';
$db_name = 'inspection';
$username = 'root';
$password = '';


$dsn = "mysql:host=$localhost;dbname=$db_name;charset=UTF8;";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
