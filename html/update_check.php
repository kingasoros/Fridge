<?php
require "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$id = $_POST['id'];
$action = $_POST['action'];

if ($action === 'update') {
    // Kategória frissítése
    $category = $_POST['category'];
    $query = "UPDATE receipt SET categories=? WHERE receipt_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $category, $id);
} elseif ($action === 'delete') {
    // Kategória törlése
    $query = "DELETE FROM receipt WHERE receipt_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
}

if ($stmt->execute()) {
    if ($action === 'update') {
        if ($stmt->affected_rows > 0) {
            // Sikeres frissítés esetén
            echo json_encode(['success' => true, 'message' => 'Update successful']);
        } else {
            // Sikertelen frissítés esetén
            echo json_encode(['success' => false, 'message' => 'Update failed']);
        }
    } elseif ($action === 'delete') {
        if ($stmt->affected_rows > 0) {
            // Sikeres törlés esetén
            echo json_encode(['success' => true, 'message' => 'Delete successful']);
        } else {
            // Sikertelen törlés esetén
            echo json_encode(['success' => false, 'message' => 'Delete failed']);
        }
    }
} else {
    // SQL hiba esetén
    echo json_encode(['success' => false, 'message' => $stmt->error]);
}
}
?>