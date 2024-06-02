<?php

require "db_conn.php";

if (isset($_POST['receipt_id'])) {
    $receipt_id = $_POST['receipt_id'];

    $delete_ingredients_query = "DELETE FROM receipt_ingredient WHERE receipt_id = ?";
    $stmt = $conn->prepare($delete_ingredients_query);
    $stmt->bind_param("i", $receipt_id);

    if ($stmt->execute()) {
        $delete_receipt_query = "DELETE FROM receipt WHERE receipt_id = ?";
        $stmt = $conn->prepare($delete_receipt_query);
        $stmt->bind_param("i", $receipt_id);

        if ($stmt->execute()) {
            header("Location:rec.php?success=Succesfully deleted.");
            exit();
        } else {
            header("Location:rec.php?error=Error with deleting.");
            exit();
        }
    } else {
        header("Location:rec.php?error=Error with deleting.");
        exit();;
    }

    $stmt->close();
}

$conn->close();
?>
