<?php

require 'db_conn.php';

if (isset($_GET['token'])) { // Checks if 'token' parameter is set.
    $token = $_GET['token']; // Retrieves the token from the URL.
    $is_admin = isset($_GET['admin']) ? 1 : 0; // Checks if 'admin' parameter is set.

    $sql = "SELECT * FROM profil WHERE activation_token = '$token'"; // SQL query to find a row with the provided token.

    $result = mysqli_query($conn, $sql); // Executes the query.

    if (mysqli_num_rows($result) > 0) { // Checks if a matching row is found.

        $row = mysqli_fetch_assoc($result); // Fetches the row.
        $userId = $row['profil_id']; // Retrieves user ID.
        $sqlUpdate = "UPDATE profil SET activated = 1, admin = $is_admin WHERE profil_id = $userId "; // Updates activation status and admin status.

        if (mysqli_query($conn, $sqlUpdate)) { // Executes the update query.

            header("Location: ../index.php"); // Redirects upon successful activation.
            exit();
        } else {
            header("Location: activation_error.php"); // Redirects to error page on update failure.
            exit();
        }
    } else {

        header("Location: activation_error.php"); // Redirects to error page if no matching token found.
        exit();
    }
} else {

    header("Location: activation_error.php"); // Redirects to error page if 'token' parameter is missing.
    exit();
}
?>
