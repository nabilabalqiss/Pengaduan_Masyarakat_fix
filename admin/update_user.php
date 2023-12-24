<?php
require_once("Connet.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"]) && isset($_POST["new_password"])) {
    $user_id = $_POST["user_id"];
    $new_password = $_POST["new_password"];

    $sql = "UPDATE admin SET password = :new_password WHERE id = :user_id";
    $stmt = $db->prepare($sql);
    $stmt->bind_Param(':new_password', $new_password);
    $stmt->bind_Param(':user_id', $user_id);

    if ($stmt->execute()) {
        header("Location: menu.php"); // Redirect after successful update
        exit();
    } else {
        echo "Error updating user.";
    }
}
?>
