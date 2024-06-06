<?php
require "db_conn.php";

if (
    isset($_POST['food_name']) && isset($_POST['your_name']) &&
    isset($_POST['time']) && isset($_POST['price']) &&
    isset($_POST['servings']) && isset($_POST['prep']) &&
    isset($_POST['ingredients']) && isset($_POST['quantities']) &&
    isset($_POST['receipt_id'])
) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $food_name = validate($_POST['food_name']);
    $your_name = validate($_POST['your_name']);
    $time = validate($_POST['time']);
    $price = validate($_POST['price']);
    $servings = validate($_POST['servings']);
    $prep = validate($_POST['prep']);
    $ingredients = $_POST['ingredients'];
    $quantities = $_POST['quantities'];
    $receipt_id = $_POST['receipt_id'];


    $sql = "SELECT * FROM receipt WHERE receipt_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $receipt_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        if (
            $row['food_name'] != $food_name ||
            $row['your_name'] != $your_name ||
            $row['time'] != $time ||
            $row['price'] != $price ||
            $row['servings'] != $servings ||
            $row['prep'] != $prep 
          
        ) {
            
            $sql_update = "UPDATE receipt SET food_name=?, your_name=?, time=?, price=?, servings=?, paragraph=? WHERE receipt_id=?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("ssssisi", $food_name, $your_name, $time, $price, $servings, $prep, $receipt_id);
            $stmt_update->execute();
 
            header("Location:receipt_edit.php?success=Saved.&receipt_id=$receipt_id");
            exit();
        } else {
   
            header("Location:receipt_edit.php");
            exit();
        }
    } else {
        header("Location:receipt_edit.php?error=Invalid receipt ID.");
        exit();
    }
} else {
    header("Location:receipt_edit.php?error=All fields are required.");
    exit();
}
?>