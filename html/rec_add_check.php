<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Start session
session_start();

// Include database connection
include "db_conn.php";

// Function to generate activation token
function generateActivationToken() {
    return bin2hex(random_bytes(16));
}

// Check if form data is submitted
if (
    isset($_POST['food_name']) && isset($_POST['your_name']) &&
    isset($_POST['time']) && isset($_POST['price']) &&
    isset($_POST['servings']) && isset($_POST['prep']) &&
    isset($_POST['ingredients']) && isset($_POST['quantities']) && 
    isset($_POST['categories'])
) {

    // Function to validate input data
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validate form data
    $food_name = validate($_POST['food_name']);
    $your_name = validate($_POST['your_name']);
    $time = validate($_POST['time']);
    $price = validate($_POST['price']);
    $servings = validate($_POST['servings']);
    $prep = validate($_POST['prep']);
    $ingredients = $_POST['ingredients'];
    $quantities = $_POST['quantities'];
$categories = $_POST['categories'];
// Validate form fields
if (empty($food_name) || empty($your_name) || empty($time) || 
    empty($price) || empty($servings) || empty($prep) || empty($categories)) {
    header("Location: rec_add.php?error=All fields are required.");
    exit();
} else if (empty($ingredients)) {
    header("Location: rec_add.php?error=Ingredients are required.");
    exit();
} else if (empty($quantities)) {
    header("Location: rec_add.php?error=Quantities are required.");
    exit();
} else {
    // Check if receipt name already exists
    $sql = "SELECT * FROM receipt WHERE food_name = '$food_name'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        header("Location: rec_add.php?error=The receipt name is taken, try another.");
        exit();
    } else {
        // Generate activation token
        $activationToken = generateActivationToken();

        if ($_FILES['food_photo']["error"] > 0) {
            header("Location: rec_add.php?error=Something went wrong during file upload!");
            exit();
        } else {
            if (is_uploaded_file($_FILES['food_photo']['tmp_name'])) {
                $file_name = $_FILES['food_photo']["name"];
                $file_temp = $_FILES["food_photo"]["tmp_name"];
                
                if (!exif_imagetype($file_temp)) {
                    header("Location: rec_add.php?error=File is not a picture!");
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
                        // success
                    } else {
                        header("Location: rec_add.php?error=Error moving the uploaded file.");
                        exit();
                    }
                } else {
                    header("Location: rec_add.php?error=File with this name already exists!");
                    exit();
                }
            }
        }

        // Insert receipt data into database
        $sql2 = "INSERT INTO receipt (img, paragraph, price, food_name, your_name, time, servings, activation_token, categories) VALUES
            ('$new_file_name', '$prep', '$price', '$food_name', '$your_name', '$time', '$servings', '$activationToken', '$categories')";
        $result2 = mysqli_query($conn, $sql2);

        if ($result2) {
            $receipt_id = mysqli_insert_id($conn);

            // Insert ingredients into database
            foreach ($ingredients as $key => $ingredient) {
                $ingredient = validate($ingredient);
                $quantity = validate($quantities[$key]);

                // Check if ingredient exists
                $check_sql = "SELECT ingrediens_id FROM ingrediens WHERE name = '$ingredient'";
                $result3 = mysqli_query($conn, $check_sql);

                if ($result3 && mysqli_num_rows($result3) > 0) {
                    $row = mysqli_fetch_assoc($result3);
                    $ingredient_id = $row['ingrediens_id'];

                    // Insert receipt-ingredient relation into database
                    $sql4 = "INSERT INTO receipt_ingredient (receipt_id, ingrediens_id, quantity) VALUES ('$receipt_id', '$ingredient_id', '$quantity')";
                    $result4 = mysqli_query($conn, $sql4);
                    if (!$result4) {
                        header("Location: rec_add.php?error=Error while inserting receipt ingredients: " . mysqli_error($conn));
                        exit();
                    }
                } else {
                    header("Location: rec_add.php?error=Cannot find ingredient ID for '$ingredient'. Go to Fridge and first add that ingredient.");
                    exit();
                }
            }

            // Send email for receipt confirmation
            $activationLink = 'http://localhost/fridge_projekt/html/activate2.php?token=' . $activationToken;
            $rejectionLink = 'http://localhost/fridge_projekt/html/rejection2.php?token=' . $activationToken . '&action=reject';

            $message = "
                <p>Please confirm this receipt:</p>
                <p><strong>Receipt Details:</strong></p>
                <p>Food Name: $food_name</p>
                <p>Your Name: $your_name</p>
                <p>Time: $time</p>
                <p>Price: $price</p>
                <p>Servings: $servings</p>
                <p>Preparation: $prep</p>
                <p>Ingredients:</p>
                <ul>";

            foreach ($ingredients as $key => $ingredient) {
                $quantity = $quantities[$key];
                $message .= "<li>$ingredient: $quantity</li>";
            }

            $message .= "
                </ul>
                <p>
                    <a href='$activationLink'>Accept</a>
                    <a href='$rejectionLink'>Reject</a>
                </p>
            ";
            
            $admin_email = 'kingasoros@gmail.com'; // Specify admin email here
            sendEmail($admin_email, 'Confirmation of receipt', $message, true);

            header("Location: rec_add.php?success=The confirmation email is sent to admin.");
            exit();
        } else {
            header("Location: rec_add.php?error=Unknown error occurred while inserting receipt: " . mysqli_error($conn));
            exit();
        }
    }
}
} else {
    header("Location: rec_add.php?error=Must be pushed out.");
    exit();
    }
    
    // Function to send email
    function sendEmail($email, $subject, $message, $message_format) {
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0;  // Turn off SMTP debug output                      
        $mail->isSMTP();                                            
        $mail->Host = 'mail.gt.stud.vts.su.ac.rs';                    
        $mail->SMTPAuth = true;                                   
        $mail->Username = 'gt';                     
        $mail->Password = 'Z37CtWKv0E6M0XM';                               
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;                                    
    
        $mail->setFrom('gt@gt.stud.vts.su.ac.rs', 'Mailer');
        $mail->addAddress($email); // Dynamic recipient email 
    
        // Set email message format
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
    } catch (Exception $e) {
        header("Location: rec_add.php?error=Something is wrong: " . $mail->ErrorInfo);
        exit();
    }
    }    