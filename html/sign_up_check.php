<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start();
include "db_conn.php";

function generateActivationToken() {
    return bin2hex(random_bytes(16));
}

if (isset($_POST['f_name']) && isset($_POST['l_name']) && 
    isset($_POST['uname']) && isset($_POST['phone_numb']) &&
    isset($_POST['email']) && isset($_POST['pass']) && 
    isset($_POST['re_pass'])) {
    
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data); // Note: `stripcslashes` was corrected to `stripslashes`
        $data = htmlspecialchars($data);
        return $data;
    }

    $f_name = validate($_POST['f_name']);
    $l_name = validate($_POST['l_name']);
    $uname = validate($_POST['uname']);
    $phone_numb = $_POST['phone_numb'];
    $email = validate($_POST['email']);
    $pass = validate($_POST['pass']);
    $re_pass = validate($_POST['re_pass']);

    if (empty($f_name) || empty($l_name) || empty($uname) || empty($phone_numb) || empty($email) || empty($pass) || empty($re_pass)) {
        // Redirect if any field is empty
        header("Location:sign_up.php?error=All fields are required.");
        exit();
    } else if ($pass !== $re_pass) {
        // Redirect if passwords don't match
        header("Location:sign_up.php?error=The confirmation password does not match.");
        exit();
    } else {
        // Encrypt password
        $pass = md5($pass);
    
        // Check if email is already registered
        $sql = "SELECT * FROM profil WHERE email = '$email' ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // Redirect if email is already registered
            header("Location:sign_up.php?error=The email is taken try another.");
            exit();
        } else {
            // Generate activation token
            $activationToken = generateActivationToken();
    
            
            if ($_FILES['user_photo']["error"] > 0) {
                header("Location:sign_up.php?error=Something went wrong during file upload!");
                exit();
            } else {
                if (is_uploaded_file($_FILES['user_photo']['tmp_name'])) {
                    $file_name = $_FILES['user_photo']["name"];
                    $file_temp = $_FILES["user_photo"]["tmp_name"];
                    
                    if (!exif_imagetype($file_temp)) {
                        header("Location:sign_up.php?error=File is not a picture!");
                        exit();
                    }
                    
                    $ext_temp = explode(".", $file_name);
                    $extension = end($ext_temp);
                    $new_file_name = date("YmdHis") . ".$extension";
                    
                    $directory = "images";
                    $upload = "$directory/$new_file_name";
                    
                    if (!is_dir($directory)) {
                        mkdir($directory);
                    }
                    
                    if (!file_exists($upload)) {
                        if (move_uploaded_file($file_temp, $upload)) {
                            //success
                        } else {
                            header("Location:sign_up.php?error=Error moving the uploaded file.");
                            exit();
                        }
                    } else {
                        header("Location:sign_up.php?error=File with this name already exists!");
                        exit();
                    }
                }
            }
            
            // Insert user data into database
            $sql2 = "INSERT INTO profil (password, last_name, phone_numb, user_name, first_name, email, activation_token, forgotten_password_token, img, admin) VALUES ('$pass', '$l_name', '$phone_numb','$uname','$f_name','$email','$activationToken','0', '$new_file_name','0')";
            $result2 = mysqli_query($conn, $sql2);
    
            // $sensitivity=$_POST['free'];

            // $sql3 = "SELECT profil_id FROM profil WHERE email=$email";
            // $result3 = mysqli_query($conn, $sql3);

            // if ($result3) {
            //     $row = mysqli_fetch_assoc($result3);
            //     $id = $row['profil_id'];
                
            //     echo "Profil ID: " . $id;
            // switch($sensitivity){
            //     case gluten:
            //         $sql4 = "INSERT INTO sensitivity (gluten_free, lactose_free, profil_id, sugar_free) VALUES ('1', '0', '$id','0')";
            //         $result4 = mysqli_query($conn, $sql4);
            //         break;
            //     case lactose:
            //         $sql4 = "INSERT INTO sensitivity (gluten_free, lactose_free, profil_id, sugar_free) VALUES ('0', '1', '$id','0')";
            //         $result4 = mysqli_query($conn, $sql4);
            //         break;
            //     case sugar:
            //         $sql4 = "INSERT INTO sensitivity (gluten_free, lactose_free, profil_id, sugar_free) VALUES ('0', '0', '$id','1')";
            //         $result4 = mysqli_query($conn, $sql4);
            //         break;
            //     default:
            //         $sql4 = "INSERT INTO sensitivity (gluten_free, lactose_free, profil_id, sugar_free) VALUES ('0', '0', '$id','0')";
            //         $result4 = mysqli_query($conn, $sql4);
            //         break;
            // }
            // }

            if ($result2) {
                // Send activation email
                $activationLink = 'http://localhost/fridge_projekt/html/activate.php?token=' . $activationToken;
                $activationAdminLink = 'http://localhost/fridge_projekt/html/activate.php?token=' . $activationToken . '&admin=1';
                $message = "
                    <p>Please confirm this registration:</p>
                    <p>{$uname} email: {$email}</p><br>
                    <p>
                        <a href='{$activationLink}'>Elfogadás</a><br>
                        <a href='{$activationAdminLink}'>Elfogadás(admin)</a><br>
                        <a href='http://localhost/fridge_projekt/html/rejection.php?token={$activationToken}&action=reject'>Elutasítás</a>
                    </p>
                ";

                sendEmail($email, 'Confirmation of registration', $message, true);
                // Redirect if successful registration
                header("Location:sign_up.php?success=Your account has been created successfully.");
                exit();
            } else {
                // Redirect if unknown error occurred
                header("Location:sign_up.php?error=Unknown error occurred.");
                exit();
            } 
        }
    }
    // Redirect if not all fields are provided
} else {
    header("Location:sign_up.php");
    exit();
}
    
// Function to send activation email
function sendEmail($email, $subject, $message, $message_format) {
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
        $mail->isSMTP();                                            
        $mail->Host = 'mail.gt.stud.vts.su.ac.rs';                    
        $mail->SMTPAuth = true;                                   
        $mail->Username = 'gt';                     
        $mail->Password = 'Z37CtWKv0E6M0XM';                               
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;                                    
    
        // Sender and recipient
        $mail->setFrom('gt@gt.stud.vts.su.ac.rs', 'Mailer');
        $mail->addAddress('kingasoros@gmail.com', 'User'); 

        // Message format
        if ($message_format) {
            $mail->isHTML(true);                                    
            $mail->Subject = $subject;                      
            $mail->Body = $message;                            
        } else {
            $mail->Subject = $subject;                      
            $mail->Body = $message;                            
        }

        // Send email
        $mail->send();
        // Redirect if email sent successfully
        header("Location:sign_up.php?success=Confirmation Message is sent for admin successfully!");
        exit();
    } catch (Exception $e) {
        // Redirect if an error occurred while sending email
        header("Location:sign_up.php?error=Something is wrong.");
        exit();
    }
}

?>
