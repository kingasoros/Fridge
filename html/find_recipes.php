<?php 
session_start();
include "db_conn.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ingredients'])) {
    $selectedIngredients = $_POST['ingredients'];
    $ingredientIds = [];

    foreach ($selectedIngredients as $ingredientName) {
        $stmt = $conn->prepare("SELECT ingrediens_id FROM ingrediens WHERE name = ?");
        if ($stmt === false) {
            die("Error preparing the statement: " . $conn->error);
        }
        $stmt->bind_param('s', $ingredientName);
        $stmt->execute();
        $stmt->bind_result($id);
        while ($stmt->fetch()) {
            $ingredientIds[] = $id;
        }
        $stmt->close();
    }

    $numSelectedIngredients = count($ingredientIds);
    $selectedIngredientsPlaceholders = implode(',', array_fill(0, $numSelectedIngredients, '?'));

    $sql = "SELECT r.receipt_id, r.food_name, COUNT(ri.ingrediens_id) AS num_ingredients
           FROM receipt r
           LEFT JOIN receipt_ingredient ri ON r.receipt_id = ri.receipt_id
           WHERE ri.ingrediens_id IN ($selectedIngredientsPlaceholders)
           GROUP BY r.receipt_id
           HAVING COUNT(ri.ingrediens_id) >= (SELECT COUNT(*) FROM receipt_ingredient WHERE receipt_id = r.receipt_id) - 2";

    $stmt = $conn->prepare($sql);

    $types = str_repeat('i', $numSelectedIngredients);
    if (!$stmt->bind_param($types, ...$ingredientIds)) {
        die("Error binding parameters: " . $stmt->error);
    }

    if (!$stmt->execute()) {
        die("Error executing the statement: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $recipes = [];
    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $recipes[] = [
                    'receipt_id' => $row['receipt_id'],
                    'food_name' => $row['food_name']
                ];
            }
        }
    } else {
        die("Error getting the result set: " . $stmt->error);
    }

    if (!empty($recipes)) {
        $encodedRecipes = urlencode(json_encode($recipes));
        header("Location: fridge.php?recipes=$encodedRecipes");
        exit();
    } else {
        header("Location: fridge.php?message=No matching recipes found.");
        exit();
    }
} else {
    header("Location: fridge.php?message=No ingredients selected.");
    exit();
}

