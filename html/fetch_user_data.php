<?php
include 'db_conn.php';

session_start();

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'errors' => ['No user is logged in']]);
    exit();
}

$email = $_SESSION['email'];

// Készítsd el az SQL lekérdezést helyettesítőkkel a biztonságosabb adatbázis lekérdezés érdekében
$sql = "SELECT user_name, first_name, last_name, phone_numb FROM profil WHERE email = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(['status' => 'error', 'errors' => ['Failed to prepare statement']]);
    exit();
}

// Kötjük az email változót a prepared statementhez
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(['status' => 'success', 'data' => $row]);
} else {
    echo json_encode(['status' => 'error', 'errors' => ['User not found']]);
}

$stmt->close();
$conn->close();
?>
