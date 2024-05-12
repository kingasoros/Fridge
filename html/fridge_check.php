<?php

session_start();
include "db_conn.php";


if(isset($_POST['ingredientName']) && isset($_POST['ingredientQuantity'])){


    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
   
    $ing_name = validate($_POST['ingredientName']);
    $ing_quantity = validate($_POST['ingredientQuantity']);


    if(empty($ing_name)) {
        header("Location:fridge.php?error=Ingredient Name is required. ");
        exit();
    }else if(empty($ing_quantity)){
        header("Location:fridge.php?error=Ingredient Quantity is required.");
        exit();
    }else{
        $sql="SELECT * FROM ingrediens WHERE name = '$ing_name' && quantity ='$ing_quantity'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) >0){
            header("Location:sign_up.php?error=This ingredient is deposited in this amount.");
            exit();
        } else {
            $sql2="INSERT INTO ingrediens (name, quantity) VALUES ('$ing_name', '$ing_quantity')";

            if (mysqli_query($conn, $sql2)) {
                header("Location: fridge.php?success=Success");
                exit();
            } else {
                header("Location: fridge.php?error=Error inserting data");
                exit();
            }
        }

    }
}header("Location:fridge.php");
        exit();