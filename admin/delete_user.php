<?php
require_once("Connet.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
    $user_id = $_POST["user_id"];

    $sql = "DELETE FROM admin WHERE id = :user_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);

    if ($stmt->execute()) {
        header("Location: menu.php"); // Redirect after successful deletion
        exit();
    } else {
        echo "Error deleting user.";
    }
}
?>
