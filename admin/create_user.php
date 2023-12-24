<?php
require_once("Connet.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["divisi"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $divisi = $_POST["divisi"];

    $sql = "INSERT INTO admin (username, password, divisi) VALUES (:username, :password, :divisi)";
    $stmt = $db->prepare($sql);
    $stmt->bind_Param(':username', $username);
    $stmt->bind_Param(':password', $password);
    $stmt->bind_Param(':divisi', $divisi);

    if ($stmt->execute()) {
        header("Location: menu.php"); 
        exit();
    } else {
        echo "Error creating user.";
    }
}
?>
