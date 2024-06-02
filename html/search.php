<?php
require "db_conn.php";

if(isset($_GET['q']) && !empty($_GET['q'])) {
    $searchInput = $_GET['q'];
    
    $sql = "SELECT * FROM receipt WHERE food_name LIKE ?";
    $stmt = $conn->prepare($sql);
    
    if($stmt) {
        $search = "%" . $searchInput . "%";
        $stmt->bind_param("s", $search);
        $stmt->execute();
        
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $food = $row['food_name'];
                
                // Lekérdezzük a receipt_id-t is
                $sql2 = "SELECT receipt_id FROM receipt WHERE food_name=?";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param("s", $food);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                $row2 = $result2->fetch_assoc();
                $receipt_id = $row2['receipt_id'];

                // Átküldjük a receipt_id-t a rec_food.php oldalra
                echo "<a href='rec_food.php?receipt_id=" . $receipt_id . "'>" . $row["food_name"] . "</a><br>";
            }
        } else {
            echo "Nincs találat";
        }
    } else {
        echo "Hiba történt a lekérdezés előkészítésekor";
    }
} else {
    echo "Nem érkezett keresési érték";
}
?>
