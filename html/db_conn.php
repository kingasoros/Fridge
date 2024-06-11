<?php
    // Defines database connection parameters.
    define("DB", [
        'HOST' => 'localhost',
        'USER' => 'root',
        'PASSWORD' => '',
        'NAME' => 'fridge'
    ]);
    
    // Establishes mysqli connection.
    $conn = mysqli_connect(DB['HOST'], DB['USER'], DB['PASSWORD'], DB['NAME']);
    
    // Tries establishing PDO connection with UTF-8 encoding.
    try {
        $pdo = new PDO("mysql:host=" . DB['HOST'] . ";dbname=" . DB['NAME'],
            DB['USER'], DB['PASSWORD'],
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"]);
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage()); // Exits with error message if connection fails.
    }

    $actions = ['login', 'register', 'forget'];

    $messages = [
        0 => 'No direct access!',
        1 => 'Unknown user!',
        2 => 'User with this name already exists, choose another one!',
        3 => 'Check your email to active your account!',
        4 => 'Fill all the fields!',
        5 => 'You are logged out!!',
        6 => 'Your account is activated, you can login now!',
        7 => 'Passwords are not equal!',
        8 => 'Format of e-mail address is not valid!',
        9 => 'Password is too short! It must be minimum 8 characters long!',
        10 => 'Password is not enough strong! (min 8 characters, at least 1 lowercase character, 1 uppercase character, 1 number, and 1 special character',
        11 => 'Something went wrong with mail server. We will try to send email later!',
        12 => 'Your account is already activated!',
        13 => 'If you have account on our site, email with instructions for reset password is sent to you.',
        14 => 'Something went wrong with server.',
        15 => 'Token or other data are invalid!',
        16 => 'Your new password is set and you can <a href="index.php" class="text-white">login</a>'
    ];

    $emailMessages = [
        'register' => [
            'subject' => 'Register on web site',
            'altBody' => 'This is the body in plain text for non-HTML mail clients'
        ],
        'forget' => [
            'subject' => 'Forgotten password - create new password',
            'altBody' => 'This is the body in plain text for non-HTML mail clients'
        ]
    ];
    ?>
