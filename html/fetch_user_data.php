<?php
include 'db_conn.php'; 

session_start(); 

if (!isset($_SESSION['email'])) { // Checks if user is logged in.
    echo json_encode(['status' => 'error', 'errors' => ['No user is logged in']]); // Responds with error if no user is logged in.
    exit();
}

$email = $_SESSION['email']; // Retrieves email from session.

$sql = "SELECT user_name, first_name, last_name, phone_numb FROM profil WHERE email = ?"; // SQL to select user data.
$stmt = $conn->prepare($sql); // Prepares the SQL statement.

if ($stmt === false) {
    echo json_encode(['status' => 'error', 'errors' => ['Failed to prepare statement']]); // Responds with error if preparing statement fails.
    exit();
}

$stmt->bind_param('s', $email); // Binds parameters.
$stmt->execute(); // Executes the prepared statement.
$result = $stmt->get_result(); // Gets result from executed statement.

if ($result->num_rows > 0) { // Checks if user is found.
    $row = $result->fetch_assoc(); // Fetches user data.
    echo json_encode(['status' => 'success', 'data' => $row]); // Responds with success and user data.
} else {
    echo json_encode(['status' => 'error', 'errors' => ['User not found']]); // Responds with error if user is not found.
}

$stmt->close(); 
$conn->close(); 
?>
