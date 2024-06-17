<?php
require "db_conn.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recipe_id'])) {
    $recipe_id = $_POST['recipe_id'];

    // Update the 'likes' value in the database
    $query = "UPDATE receipt SET likes = 0 WHERE receipt_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>
