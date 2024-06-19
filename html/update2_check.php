<?php
// update2_check.php

require "db_conn.php";

header('Content-Type: application/json'); // Beállítjuk a válasz típusát JSON-ra

$response = ['success' => false, 'message' => 'Unknown action']; // Alapértelmezett válasz, ha nem található megfelelő akció

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action === 'update_ingrediens') {
        // Hozzávaló nevének frissítése
        $ingrediens = $_POST['ingrediens'];
        $query = "UPDATE ingrediens SET name=? WHERE ingrediens_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $ingrediens, $id); // itt a második paraméter "i", nem "s"
    } elseif ($action === 'delete') {
        // Hozzávaló törlése
        $query = "DELETE FROM ingrediens WHERE ingrediens_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id); // itt "i", mert integer típusú az ingrediens_id
    }

    if ($stmt->execute()) {
        if ($action === 'update_ingrediens') {
            if ($stmt->affected_rows > 0) {
                // Sikeres frissítés esetén
                echo json_encode(['success' => true, 'message' => 'Ingredient update successful']);
            } else {
                // Sikertelen frissítés esetén
                echo json_encode(['success' => false, 'message' => 'Ingredient update failed']);
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
