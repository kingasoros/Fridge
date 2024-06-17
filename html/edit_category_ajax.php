<?php
session_start();
require "db_conn.php";

if (isset($_POST['category'])) {
    $old_category_name = $_POST['category'];
    // Ide jönne a kategória módosításának logikája a $old_category_name alapján

    // Példa: módosítjuk a kategória nevét a szerver oldalon
    $new_category_name = 'Új Kategória Név'; // Itt ténylegesen módosítanád a kategória nevét

    // Szimuláljuk az AJAX választ JSON formátumban
    $response = array(
        'success' => true,
        'new_category_name' => $new_category_name
    );

    echo json_encode($response);
    exit();
} else {
    // Ha nincs megadva kategória, hibaüzenetet küldünk vissza
    $response = array('success' => false);
    echo json_encode($response);
    exit();
}
?>
