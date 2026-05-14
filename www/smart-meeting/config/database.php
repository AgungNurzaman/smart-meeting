<?php

$host = "db";
$user = "smartuser";
$pass = "smart123";
$db   = "db_office_smart";

$conn = mysqli_connect(
    $host,
    $user,
    $pass,
    $db
);

if(!$conn){

    die(
        "Koneksi gagal : "
        . mysqli_connect_error()
    );

}

?>