<?php

require 'db_conn.php'; 

if (isset($_GET['token'])) { // Checks for 'token' parameter.

    $token = $_GET['token']; // Gets token from URL.

    $sql = "SELECT * FROM receipt WHERE activation_token = '$token'"; // SQL to find receipt by token.

    $result = mysqli_query($conn, $sql); // Executes query.

    if (mysqli_num_rows($result) > 0) { // Checks if receipt found.

        $row = mysqli_fetch_assoc($result); // Fetches row.
        $receiptId = $row['receipt_id']; // Gets receipt ID.
        $sqlUpdate = "UPDATE receipt SET activated = 1 WHERE receipt_id = $receiptId "; // Updates activation status.

        if (mysqli_query($conn, $sqlUpdate)) { // Executes update query.

            header("Location: ../index.php"); // Redirects on success.
            exit();
        } else {

            header("Location: activation_error.php"); // Redirects to error page on failure.
            exit();
        }
    } else {

        header("Location: activation_error.php"); // Redirects to error page if no receipt found.
        exit();
    }
} else {

    header("Location: activation_error.php"); // Redirects to error page if 'token' parameter is missing.
    exit();
}
?>
