<?php
include 'db_conn.php';

session_start();

if (!isset($_SESSION['email'])) {
    echo json_encode(['status' => 'error', 'errors' => ['No user is logged in']]);
    exit();
}

$email = $_SESSION['email'];
$data = json_decode(file_get_contents('php://input'), true);

$user_name = $data['user_name'];
$first_name = $data['first_name'];
$last_name = $data['last_name'];
$phone_numb = $data['phone_numb'];

$sql = "SELECT user_name, first_name, last_name, phone_numb FROM profil WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $update_needed = false;
    $update_fields = [];

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

    if ($update_needed) {
        $set_clause = [];
        $params = [];
        $types = '';

        foreach ($update_fields as $key => $value) {
            $set_clause[] = "$key = ?";
            $params[] = $value;
            $types .= 's';
        }

        $params[] = $email;

        $sql = "UPDATE profil SET " . implode(', ', $set_clause) . " WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types . 's', ...$params);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'errors' => ['Failed to update profile']]);
        }
    } else {
        echo json_encode(['status' => 'success', 'message' => 'No changes needed']);
    }
} else {
    echo json_encode(['status' => 'error', 'errors' => ['User not found']]);
}

$stmt->close();
$conn->close();
?>
