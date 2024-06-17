<?php
require "db_conn.php";

if (isset($_GET['ingredient_id'])) {
    $ingredient_id = $_GET['ingredient_id'];

    $delete_ingredients_query = "DELETE FROM ingrediens WHERE name = ?";
    $stmt = $conn->prepare($delete_ingredients_query);
    $stmt->bind_param("i", $ingredient_id);

    if ($stmt->execute()) {
        header("Location: fridge.php?success=Successfully deleted.");
        exit();
    } else {
        header("Location: fridge.php?error=Error with deleting.");
        exit();
    }

    $stmt->close();
} else {
    header("Location: fridge.php?error=Error.");
    exit();
}

$conn->close();
?>
