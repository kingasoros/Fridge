<?php
// Including the database connection file
require 'db_conn.php';

// Checking if the token is set in the URL parameters
if (isset($_GET['token'])) {
    // Getting the token value
    $token = $_GET['token'];

    // Query to select user profile with the given activation token
    $sql = "SELECT * FROM profil WHERE activation_token = '$token'";

    // Executing the query
    $result = mysqli_query($conn, $sql);

    // Checking if there is a result
    if (mysqli_num_rows($result) > 0) {
        // Fetching the user profile data
        $row = mysqli_fetch_assoc($result);
        $userId = $row['profil_id'];
        
        // Query to update the user profile status to activated
        $sqlUpdate = "UPDATE profil SET activated = 0 WHERE profil_id = $userId ";

        // Executing the update query
        if (mysqli_query($conn, $sqlUpdate)) {
            // Redirecting to the home page after successful activation
            header("Location: ../index.php");
            exit();
        } else {
            // Redirecting to an error page in case of update failure
            header("Location: rejection_error.php");
            exit();
        }
    } else {
        // Redirecting to an error page if no matching token found
        header("Location: rejection_error.php");
        exit();
    }
} else {
    // Redirecting to an error page if token is not set in the URL parameters
    header("Location: rejection_error.php");
    exit();
}

