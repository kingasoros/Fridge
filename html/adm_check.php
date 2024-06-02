<?php
session_start();

include "db_conn.php"; // Includes database connection.

$ingredientsArray = json_decode($_POST['ingredientsArray']); // Decodes JSON data.

if(isset ($_POST['food_name']) && isset ($_POST['your_name']) && 
isset ($_POST['time']) && isset ($_POST['price']) &&
isset ($_POST['servings']) && isset ($_POST['prep'])){

    function validate($data){ // Function to sanitize input data.
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validation of form fields.
    $food_name = validate($_POST['food_name']);
    $your_name = validate($_POST['your_name']);
    $time = validate($_POST['time']);
    $price = validate($_POST['price']); 
    $servings = validate($_POST['servings']);
    $prep = validate($_POST['prep']);

    if(empty($food_name) || empty($your_name) || empty($time) || empty($price) || empty($servings) || empty($prep)){
        header("Location:adm.php?error=All fields are required."); // Redirects if any field is empty.
        exit();
    } else {

        $sql="SELECT * FROM receipt WHERE food_name = '$food_name' "; // Checks if receipt name already exists.
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) >0){
            header("Location:adm.php?error=The receipt name is taken try another."); // Redirects if receipt name is already taken.
            exit();
        } else {

            // Inserts new receipt into database.
            $sql2="INSERT INTO receipt (img, paragraph, price, food_name, your_name, time, servings) VALUES
                ('$food_photo', '$prep', '$price','$food_name','$your_name','$time','$servings')";

            $result2 = mysqli_query($conn, $sql2);

            if($result2){
                $receipt_id = mysqli_insert_id($conn);

                // Inserts ingredients of the receipt into database.
                foreach($ingredientsArray as $ingredient) {
                    $ingredient_id = $ingredient->ingredient_id;
                    $sql3 = "INSERT INTO receipt_ingredient (receipt_id, ingredient_id) VALUES ('$receipt_id', '$ingredient_id')";
                    mysqli_query($conn, $sql3);
                }

                header("Location:adm.php?success=Your receipt has been created successfully."); // Redirects on successful creation.
                exit();
            } else {
                header("Location:adm.php?error=Unknown error occurred."); // Redirects if unknown error occurs.
                exit();
            }
        }
    }
}else {
    header("Location:adm.php?error=Must be pushed out."); // Redirects if conditions not met.
    exit();
}
?>
