<?php
require "db_conn.php"; 

if (isset($_POST['receipt_id'])) {
    $receipt_id = $_POST['receipt_id'];

    // Jelenlegi like érték lekérdezése
    $query = "SELECT likes FROM receipt WHERE receipt_id = '$receipt_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_likes = $row['likes'];

        // Új like érték beállítása
        $new_likes = ($current_likes == 0) ? 1 : 0;

        // Adatbázis frissítése az új like értékkel
        $update_query = "UPDATE receipt SET likes = '$new_likes' WHERE receipt_id = '$receipt_id'";
        if ($conn->query($update_query) === TRUE) {
            header("Location: rec.php?success=Like status updated successfully.");
        } else {
            header("Location: rec.php?error=Failed to update like status.");
        }
    } else {
        header("Location: rec.php?error=Invalid receipt ID.");
    }
    $conn->close();
} else {
    header("Location: rec.php?error=No receipt ID provided.");
}
?>
