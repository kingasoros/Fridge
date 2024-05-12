<?php

// Db_conn.php hozzáadása
require 'db_conn.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Ellenőrizd az adatbázisban, hogy létezik-e a token és még érvényes-e
    $sql = "SELECT * FROM users WHERE activation_token = '$token' AND activation_expire > NOW()";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Token érvényes, frissítsd a felhasználó státuszát
        $row = mysqli_fetch_assoc($result);
        $userId = $row['id'];
        $sqlUpdate = "UPDATE profil SET activated = 1 WHERE id = $userId";
        if (mysqli_query($conn, $sqlUpdate)) {
            // Sikeres aktiváció, továbbítsd a felhasználót egy "sikeres aktiváció" oldalra
            header("Location: activation_success.php");
            exit();
        } else {
            // Hiba az adatbázis frissítésekor
            header("Location: activation_error.php");
            exit();
        }
    } else {
        // Érvénytelen vagy lejárt token
        header("Location: activation_error.php");
        exit();
    }
} else {
    // Ha nincs token az URL-ben
    header("Location: activation_error.php");
    exit();
}
