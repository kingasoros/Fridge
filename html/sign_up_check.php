<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start();
include "db_conn.php";


if(isset ($_POST['f_name']) && isset ($_POST['l_name']) && 
isset ($_POST['uname']) && isset ($_POST['phone_numb']) &&
isset ($_POST['email']) && isset ($_POST['pass']) && 
isset ($_POST['re_pass'])){
    
    // Funkció a bemenetek ellenőrzésére
    function validate($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Bemenetek ellenőrzése és értékadás
    $f_name = validate($_POST['f_name']);
    $l_name = validate($_POST['l_name']);
    $uname = validate($_POST['uname']);
    $phone_numb = $_POST['phone_numb'];
    $email = validate($_POST['email']);
    $pass = validate($_POST['pass']);
    $re_pass = validate($_POST['re_pass']);

    // Ellenőrizzük, hogy minden adat meg van-e adva
    if(empty($f_name) || empty($l_name) || empty($uname) || empty($phone_numb) || empty($email) || empty($pass) || empty($re_pass)){
        header("Location:sign_up.php?error=All fields are required.");
        exit();
    } else if($pass !== $re_pass){
        header("Location:sign_up.php?error=The confirmation password does not match.");
        exit();
    } else {
        $pass = md5($pass);
    
        // Ellenőrizzük, hogy az e-mail cím foglalt-e már
        $sql="SELECT * FROM profil WHERE email = '$email' ";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) >0){
            header("Location:sign_up.php?error=The email is taken try another.");
            exit();
        } else {
            // Ha minden rendben van, akkor regisztráljuk a felhasználót
            $sql2="INSERT INTO profil (password, last_name, phone_numb, user_name, first_name, email) VALUES
            ('$pass', '$l_name', '$phone_numb','$uname','$f_name','$email')";

            $result2 = mysqli_query($conn, $sql2);

            $activationLink = 'http://yourwebsite.com/activate.php?token=' . $activationToken;
            $message = "Please confirm this registration: $activationLink";
            // Elküldjük az e-mailt a regisztrált felhasználónak
            sendEmail('kingasoros@gmail.com', 'Confirmation of registration', $message, false);

            if($result2){
                header("Location:sign_up.php?success=Your account has been created succesfully.");
                exit();
            } else {
                header("Location:sign_up.php?error=Unknown error occured.");
                exit();
            } 
        }
    }
} else {
    header("Location:sign_up.php");
    exit();
}

function generateActivationToken() {
    return bin2hex(random_bytes(16)); // Véletlenszerű hexadecimális string generálása
}

// Használat példa:
$activationToken = generateActivationToken();

// Funkció az e-mail küldésére
function sendEmail($email, $subject, $message, $message_format) {
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
        $mail->isSMTP();                                            
        $mail->Host = 'mail.gt.stud.vts.su.ac.rs';                    
        $mail->SMTPAuth = true;                                   
        $mail->Username = 'gt';                     
        $mail->Password = 'Z37CtWKv0E6M0XM';                               
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;                                    

        // Beállítjuk a feladó és a címzett e-mail címét
        $mail->setFrom('gt@gt.stud.vts.su.ac.rs', 'Mailer');
        $mail->addAddress($email, 'User');  

        // Az e-mail formátumát HTML-re állítjuk vagy nem
        if ($message_format) {
            $mail->isHTML(true);                                    
            $mail->Subject = $subject;                      
            $mail->Body = $message;                            
        } else {
            $mail->Subject = $subject;                      
            $mail->Body = $message;                            
        }

        // Elküldjük az e-mailt
        $mail->send();
        Header("Location:sign_up.php?success=Message is sent succesfully!");
        exit();
    } catch (Exception $e) {
        Header("Location:sign_up.php?error=Something is wrong.");
        exit();
    }
}
?>
