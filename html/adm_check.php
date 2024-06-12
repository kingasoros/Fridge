<?php
require "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action == 'activate') {
        $activated = 1;
    } else if ($action == 'reject') {
        $activated = 0;
    }

    $stmt = $conn->prepare("UPDATE `profil` SET `activated` = $activated WHERE `profil_id` = $id");

    if ($stmt->execute()) {
        header("Location: adm.php?success=Status updated successfully.");
    } else {
        header("Location: adm.php?error=Failed to update status.");
    }

    $stmt->close();
    $conn->close();
}
?>
