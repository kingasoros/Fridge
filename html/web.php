<?php
session_start();
require_once "db_conn.php";
require_once "functions_def.php";

$password = "";
$passwordConfirm = "";
$firstname = "";
$lastname = "";
$email = "";
$action = "";

$referer = $_SERVER['HTTP_REFERER'];

$action = $_POST["action"];

if ($action != "" and in_array($action, $actions) and strpos($referer, SITE) !== false) {
    switch ($action) {
        case "login":
            // login logic here
            break;

        case "register":
            // registration logic here
            break;

        case "forget":
            $email = trim($_POST["email"]);
            if (!empty($email) and getUserData($pdo, 'id_user', 'email', $email)) {
                $token = createToken(20);
                if ($token) {
                    setForgottenToken($pdo, $email, $token);
                    $id_user = getUserData($pdo, 'id_user', 'email', $email);
                    try {
                        $body = "To start the process of changing password, visit <a href='" . SITE . "reset_password.php?token=$token'>this link</a>.";
                        sendEmail($pdo, $email, $emailMessages['forget'], $body, $id_user);
                        redirection('index.php?f=13');
                    }
                    catch (Exception $e) {
                        error_log("****************************************");
                        error_log($e->getMessage());
                        error_log("file:" . $e->getFile() . " line:" . $e->getLine());
                        redirection("index.php?f=11");
                    }
                } else {
                    redirection('index.php?f=14');
                }
            } else {
                redirection('index.php?f=13');
            }
            break;

        default:
            redirection('index.php?l=0');
            break;
    }

} else {
    redirection('index.php?l=0');
}

