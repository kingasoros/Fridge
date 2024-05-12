<?php

// Db_conn.php hozzáadása
require 'db_conn.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Ellenőrizd az adatbázisban, hogy létezik-e a token és még érvényes-e
    $sql = "SELECT * FROM profil WHERE activation_token = '$token'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Token érvényes, frissítsd a felhasználó státuszát
        $row = mysqli_fetch_assoc($result);
        $userId = $row['profil_id'];
        $sqlUpdate = "UPDATE profil SET activated = 0 WHERE profil_id = $userId ";
        if (mysqli_query($conn, $sqlUpdate)) {
            // Sikeres aktiváció, továbbítsd a felhasználót egy "sikeres aktiváció" oldalra
            header("Location: ../index.html");
            exit();
        } else {
            // Hiba az adatbázis frissítésekor
            // header("Location: activation_error1.php");
            // exit();
            header("Location: rejection_error.php");
            exit();
        }
    } else {
        // Érvénytelen vagy lejárt token
        header("Location: rejection_error.php");
        exit();
    }
} else {
    // Ha nincs token az URL-ben
    header("Location: rejection_error.php");
    exit();
}
?>
