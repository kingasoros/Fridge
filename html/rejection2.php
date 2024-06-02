<?php

require 'db_conn.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];


    $sql = "SELECT * FROM receipt WHERE activation_token = '$token'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $receiptId = $row['receipt_id'];
        $sqlUpdate = "UPDATE receipt SET activated = 0 WHERE receipt_id = $userId ";
        if (mysqli_query($conn, $sqlUpdate)) {
            header("Location: ../index.php");
            exit();
        } else {
            header("Location: rejection_error.php");
            exit();
        }
    } else {
        header("Location: rejection_error.php");
        exit();
    }
} else {
    header("Location: rejection_error.php");
    exit();
}
?>
