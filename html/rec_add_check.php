<?php
session_start();
include "db_conn.php";

if (
    isset($_POST['food_name']) && isset($_POST['your_name']) &&
    isset($_POST['time']) && isset($_POST['price']) &&
    isset($_POST['servings']) && isset($_POST['prep']) &&
    isset($_POST['ingredients']) && isset($_POST['quantities'])
) {

    function validate($data)
    {
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

    if (
        empty($food_name) || empty($your_name) || empty($time) || 
        empty($price) || empty($servings) || empty($prep)
    ) {
        header("Location:rec_add.php?error=All fields are required.");
        exit();
    } else if (empty($ingredients)) {
        header("Location:rec_add.php?error=ingredients are required.");
        exit();
    } else if (empty($quantities)) {
        header("Location:rec_add.php?error=quantities are required.");
        exit();
    } else {
        $sql = "SELECT * FROM receipt WHERE food_name = '$food_name' ";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location:rec_add.php?error=The receipt name is taken try another.");
            exit();
        } else {
            $sql2 = "INSERT INTO receipt (paragraph, price, food_name, your_name, time, servings) VALUES
                ('$prep', '$price','$food_name','$your_name','$time','$servings')";

            $result2 = mysqli_query($conn, $sql2);

            if ($result2) {
                $receipt_id = mysqli_insert_id($conn);

                foreach ($ingredients as $key => $ingredient) {
                    $ingredient = validate($ingredient);
                    $quantity = validate($quantities[$key]);

                    
                    $check_sql = "SELECT ingrediens_id FROM ingrediens WHERE name = '$ingredient'";
                    $result3 = mysqli_query($conn, $check_sql);

                    if ($result3 && mysqli_num_rows($result3) > 0) {
                        $row = mysqli_fetch_assoc($result3);
                        $ingredient_id = $row['ingrediens_id'];

                        $sql4 = "INSERT INTO receipt_ingredient (receipt_id, ingrediens_id, quantity) VALUES ('$receipt_id', '$ingredient_id', '$quantity')";
                        $result4 = mysqli_query($conn, $sql4);
                        if ($result4) {
                            header("Location:rec_add.php?success=Everything is okay.");
                            exit();
                        }header("Location:rec_add.php?error=Error while inserting receipt ingredients." . mysqli_error($conn));
                        exit();
                    } else {
                        header("Location:rec_add.php?error=Cannot find ingredient ID for '$ingredient'.");
                        exit();
                    }
                }
            } else {
                header("Location:rec_add.php?error=Unknown error occurred.");
                exit();
            }
        }
    }
} else {
    header("Location:rec_add.php?error=Must be pushed out.");
    exit();
}
