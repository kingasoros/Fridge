<?php
require "db_conn.php";

if (isset($_GET['category'])) {
    $category = $_GET['category'];

    $delete_category_query = "DELETE FROM receipt WHERE categories = ?";
    $stmt = $conn->prepare($delete_category_query);
    $stmt->bind_param("s", $category);

    if ($stmt->execute()) {
        header("Location: rec.php?success=Successfully deleted category.");
        exit();
    } else {
        header("Location: rec.php?error=Error with category deleting.");
        exit();
    }

    $stmt->close();
} else {
    header("Location: rec.php?error=Error.");
    exit();
}

$conn->close();
?>
