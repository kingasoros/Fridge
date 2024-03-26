<?php

session_start();
include "db_conn.php";

if(isset ($_POST['f_name']) && isset ($_POST['l_name']) && 
isset ($_POST['uname']) && isset ($_POST['phone_numb']) &&
isset ($_POST['email']) && isset ($_POST['pass']) && 
isset ($_POST['re_pass'])){
    
    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

$f_name = validate($_POST['f_name']);
$l_name = validate($_POST['l_name']);

$uname = validate($_POST['uname']);
$phone_numb =$_POST['phone_numb'];
$email = validate($_POST['email']);

$pass = validate($_POST['pass']);
$re_pass = validate($_POST['re_pass']);

// $user_data= "first_name=". $f_name. "&last_name=". $l_name. "&user_name=". $uname. "&phone_numb=". $phone_numb. "&email=". $email;

if(empty($f_name)){
    header("Location:sign_up.php?error=First Name is required.");
    exit();
}else if(empty($l_name)){
    header("Location:sign_up.php?error=Last Name is required.");
    exit();
}else if(empty($uname)){
    header("Location:sign_up.php?error=User Name is required.");
    exit();
}else if(empty($phone_numb)){
    header("Location:sign_up.php?error=Phone Number is required.");
    exit();
}else if(empty($email)){
    header("Location:sign_up.php?error=Email is required.");
    exit();
}else if(empty($pass)){
    header("Location:sign_up.php?error=Password is required.");
    exit();
}else if(empty($re_pass)){
    header("Location:sign_up.php?error=Re Password is required.");
    exit();
}else if($pass !== $re_pass){
    header("Location:sign_up.php?error=The confirmation password does not match.");
    exit();
}else{

    $pass = md5($pass);
    
    $sql="SELECT* FROM profil WHERE user_name = '$uname' ";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) >0){
        header("Location:sign_up.php?error=The username is taken try another.");
        exit();
    }else{
        $sql2="INSERT INTO profil (password,last_name,phone_numb,user_name,first_name,email) VALUES
        ('$pass', '$l_name', '$phone_numb','$uname','$f_name','$email')";

        $result2 = mysqli_query($conn, $sql2);
        
        if($result2){
            header("Location:sign_up.php?success=Your account has been created succesfully.");
            exit();
        }else{
            header("Location:sign_up.php?error=unknown error occured.");
            exit();
        } 
    }
        
}

}else{
    header("Location:sign_up.php");
    exit();
}