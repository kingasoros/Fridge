<?php

session_start(); 

include "db_conn.php"; 

if(isset($_POST['ingredientName'])){ // Checks if ingredient name is set.

    function validate($data){ // Function to sanitize input data.
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
   
    $ing_name = validate($_POST['ingredientName']); // Sanitizes ingredient name.

    if(empty($ing_name)) { // Checks if ingredient name is empty.
        header("Location:fridge.php?error=Ingredient Name is required. "); // Redirects with error if ingredient name is empty.
        exit();
    } else {
        $sql="SELECT * FROM ingrediens WHERE name = '$ing_name'"; // SQL to check if ingredient already exists.
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) >0){ // Checks if ingredient already exists.
            header("Location:fridge.php?error=This ingredient is deposited."); // Redirects with error if ingredient already exists.
            exit();
        } else {
            $sql2="INSERT INTO ingrediens (name) VALUES ('$ing_name')"; // Inserts new ingredient into database.

            if (mysqli_query($conn, $sql2)) { // Executes insert query.
                header("Location: fridge.php?success=Success"); // Redirects on successful insertion.
                exit();
            } else {
                header("Location: fridge.php?error=Error inserting data"); // Redirects on insertion error.
                exit();
            }
        }
    }
}

header("Location:fridge.php"); 
exit();
?>
