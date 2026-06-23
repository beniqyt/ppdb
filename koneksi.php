<?php

$host = "mysql.railway.internal";
$user = "root";
$pass = "BklAAlluoHBiUGQnFmntJsRsgClOpMHp";
$db   = "railway";
$port = 3306;

$conn = mysqli_connect(
    $host,
    $user,
    $pass,
    $db,
    $port
);

if(!$conn){
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>
