<?php
define("DB_HOST","localhost");
define("DB_NAME","db_ipwija_jaya");

try{
    $conn = new PDO("mysql:host=".DB_HOST.";db_name=".DB_NAME."user","password");
    echo "Berhasil Terhubung ke ". DB_NAME;
}catch(PDOException $e){
    echo "Gagal: ". $e->getMessage();
}

?>