<?php
// Including database connection
include 'db_conn.php';

// Starting session
session_start();

// Checking if user is logged in
if (!isset($_SESSION['email'])) {
    // Returning error response if no user is logged in
    echo json_encode(['status' => 'error', 'errors' => ['No user is logged in']]);
    exit();
}

// Getting user email from session
$email = $_SESSION['email'];

// Retrieving data from request body
$data = json_decode(file_get_contents('php://input'), true);

// Extracting data fields
$user_name = $data['user_name'];
$first_name = $data['first_name'];
$last_name = $data['last_name'];
$phone_numb = $data['phone_numb'];

// SQL query to select user information based on email
$sql = "SELECT user_name, first_name, last_name, phone_numb FROM profil WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

// Checking if user exists
if ($result->num_rows > 0) {
    // Fetching user data
    $row = $result->fetch_assoc();
    $update_needed = false;
    $update_fields = [];

    // Checking for changes in user data
    if ($row['user_name'] !== $user_name) {
        $update_fields['user_name'] = $user_name;
        $update_needed = true;
    }
    if ($row['first_name'] !== $first_name) {
        $update_fields['first_name'] = $first_name;
        $update_needed = true;
    }
    if ($row['last_name'] !== $last_name) {
        $update_fields['last_name'] = $last_name;
        $update_needed = true;
    }
    if ($row['phone_numb'] !== $phone_numb) {
        $update_fields['phone_numb'] = $phone_numb;
        $update_needed = true;
    }

    // Updating user data if changes are needed
    if ($update_needed) {
        $set_clause = [];
        $params = [];
        $types = '';

        // Building SET clause for SQL update
        foreach ($update_fields as $key => $value) {
            $set_clause[] = "$key = ?";
            $params[] = $value;
            $types .= 's';
        }

        // Adding email as parameter for WHERE clause
        $params[] = $email;

        // Constructing SQL update query
        $sql = "UPDATE profil SET " . implode(', ', $set_clause) . " WHERE email = ?";
        $stmt = $conn->prepare($sql);

        // Binding parameters and executing the update query
        $stmt->bind_param($types . 's', ...$params);
        if ($stmt->execute()) {
            // Returning success response if profile is updated successfully
            echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully']);
        } else {
            // Returning error response if update fails
            echo json_encode(['status' => 'error', 'errors' => ['Failed to update profile']]);
        }
    } else {
        // Returning success response if no changes are needed
        echo json_encode(['status' => 'success', 'message' => 'No changes needed']);
    }
} else {
    // Returning error response if user is not found
    echo json_encode(['status' => 'error', 'errors' => ['User not found']]);
}

// Closing prepared statement and database connection
$stmt->close();
$conn->close();
?>
