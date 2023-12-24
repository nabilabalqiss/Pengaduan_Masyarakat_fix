<?php

$db_host = "tiduapnl.com";
$db_user = "u901156130_masyarakat";
$db_pass = "PengaduanMasyarakat1111";
$db_name = "u901156130_masyarakat";

try {
    //create PDO connection
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch(PDOException $e) {
    //show error
    die("Terjadi masalah: " . $e->getMessage());
}
