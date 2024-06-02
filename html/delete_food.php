<?php

require "db_conn.php"; 

if (isset($_POST['receipt_id'])) { // Checks if receipt ID is set.
    $receipt_id = $_POST['receipt_id']; // Retrieves receipt ID from POST data.

    // Deletes ingredients associated with the receipt.
    $delete_ingredients_query = "DELETE FROM receipt_ingredient WHERE receipt_id = ?";
    $stmt = $conn->prepare($delete_ingredients_query);
    $stmt->bind_param("i", $receipt_id);

    if ($stmt->execute()) { // Executes deletion query.

        // Deletes the receipt itself.
        $delete_receipt_query = "DELETE FROM receipt WHERE receipt_id = ?";
        $stmt = $conn->prepare($delete_receipt_query);
        $stmt->bind_param("i", $receipt_id);

        if ($stmt->execute()) { // Executes deletion query.

            header("Location:rec.php?success=Succesfully deleted."); // Redirects on successful deletion.
            exit();
        } else {
            header("Location:rec.php?error=Error with deleting."); // Redirects on deletion error.
            exit();
        }
    } else {
        header("Location:rec.php?error=Error with deleting."); // Redirects on deletion error.
        exit();
    }

    $stmt->close(); // Closes the prepared statement.
}

$conn->close(); // Closes the database connection.
?>
