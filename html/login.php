<?php

session_start();
include "db_conn.php";


if(isset ($_POST['uname']) && isset ($_POST['pass'])){
    
    // Function to sanitize input data.
    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Sanitizes username and password.
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['pass']);

    // Checks if username is empty.
    if(empty($uname)){
        header("Location:sign_in.php?error=User Name is required."); // Redirects with error if username is empty.
        exit();
    } else if(empty($pass)){ // Checks if password is empty.
        header("Location:sign_in.php?error=Password is required."); // Redirects with error if password is empty.
        exit();
    } else {

        $pass = md5($pass); // Encrypts the password.

        // SQL query to check username and password in the database.
        $sql="SELECT* FROM profil WHERE user_name = '$uname' AND password='$pass'";
        $result = mysqli_query($conn, $sql);

        // Checks if there is exactly one row returned.
        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            // Checks if username and password match.
            if($row['user_name'] === $uname && $row['password'] === $pass){
                // Sets session variables.
                $_SESSION['profil_id'] = $row['profil_id'];
                $_SESSION['last_name'] = $row['last_name'];
                $_SESSION['phone_numb'] = $row['phone_numb'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['img'] = $row['img'];
                // Redirects to profile page.
                header("Location:profile.php");
                exit();  
            } else {
                // Redirects with error for incorrect username or password.
                header("Location:sign_in.php?error=Incorrect User Name or Password.");
                exit();
            }  
        } else {
            // Redirects with error for incorrect username or password.
            header("Location:sign_in.php?error=Incorrect User Name or Password.");
            exit();
        }
    }
} else {
    header("Location:sign_in.php"); // Redirects to sign in page if username and password are not set.
    exit();
}

