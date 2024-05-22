<?php
session_start();
include "db_conn.php";

if(isset ($_POST['food_name']) && isset($_POST['your_name']) &&
 isset($_POST['time']) && isset($_POST['price']) &&
 isset($_POST['servings']) && isset($_POST['prep'])&&
 isset($_POST['ingredientsArray'])) {

    function validate($data){
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
    $ingredientsArray = json_decode($_POST['ingredientsArray'], true);


    if(empty($food_name) || empty($your_name) || empty($time) || empty($price) || empty($servings) || empty($prep)){
        header("Location:rec_add.php?error=All fields are required.");
        exit();
    }else if(empty($food_name)){
        header("Location:rec_add.php?error=The array is required.");
        exit();
    }else{
        $sql="SELECT * FROM receipt WHERE food_name = '$food_name' ";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            header("Location:rec_add.php?error=The receipt name is taken try another.");
            exit();
        } else {
            $sql2="INSERT INTO receipt (paragraph, price, food_name, your_name, time, servings) VALUES
                ('$prep', '$price','$food_name','$your_name','$time','$servings')";

            $result2 = mysqli_query($conn, $sql2);

            if ($result2) {
                $receipt_id = mysqli_insert_id($conn);
                if (is_array($ingredientsArray) && count($ingredientsArray) > 0) {
                    foreach ($ingredientsArray as $ingredientObj) {
                        $ingredient_name = validate($ingredientObj['ingredient']);
                        $quantity = validate($ingredientObj['quantity']);

                        $check_sql = "SELECT * FROM ingredients WHERE name = '$ingredient_name'";
                        $result3 = mysqli_query($conn, $check_sql);

                        if ($result3 && mysqli_num_rows($result3) == 0) {
                            $insert_sql = "INSERT INTO ingredients(name) VALUES ('$ingredient_name')";
                            mysqli_query($conn, $insert_sql);
                            $ingredient_id = mysqli_insert_id($conn);
                        } else {
                            $ingredient_row = mysqli_fetch_assoc($result3);
                            $ingredient_id = $ingredient_row['id'];
                        }

                        $sql3 = "INSERT INTO receipt_ingredient (receipt_id, ingredient_id, ingredient_quantity) VALUES ('$receipt_id', '$ingredient_id', '$quantity')";
                        mysqli_query($conn, $sql3);
                    }
                } else {
                    header("Location:rec_add.php?error=Error with inputs.");
                    exit();
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
?>
