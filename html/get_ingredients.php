<?php
// Adatbázis kapcsolódás
include "db_conn.php";

// Lekérjük az összes összetevőt az adatbázisból
$sql = "SELECT name FROM ingrediens";
$result = mysqli_query($conn, $sql);

// Ellenőrizzük, hogy van-e eredmény
if (mysqli_num_rows($result) > 0) {
    $ingredients = array();
    // Végigiterálunk az eredményen és hozzáadjuk az összetevőket az $ingredients tömbhöz
    while ($row = mysqli_fetch_assoc($result)) {
        $ingredients[] = $row['name'];
    }
    // Visszaadjuk az összetevők listáját JSON formátumban
    echo json_encode($ingredients);
} else {
    // Ha nincs eredmény, üres tömböt adunk vissza
    echo json_encode([]);
}

// Adatbázis kapcsolat bezárása
mysqli_close($conn);
?>
