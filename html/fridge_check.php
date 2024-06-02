<?php

session_start();
include "db_conn.php";


if(isset($_POST['ingredientName'])){


    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
   
    $ing_name = validate($_POST['ingredientName']);


    if(empty($ing_name)) {
        header("Location:fridge.php?error=Ingredient Name is required. ");
        exit();
    }else {
        $sql="SELECT * FROM ingrediens WHERE name = '$ing_name'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) >0){
            header("Location:fridge.php?error=This ingredient is deposited.");
            exit();
        } else {
            $sql2="INSERT INTO ingrediens (name) VALUES ('$ing_name')";

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