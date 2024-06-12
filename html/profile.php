<?php

session_start();

if(isset($_SESSION['last_name']) && isset($_SESSION['phone_numb']) &&
   isset($_SESSION['user_name']) && isset($_SESSION['first_name']) &&
   isset($_SESSION['email'])){
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>PROFILE</title>
    <meta charset="UTF-8">
    <meta name="description" content="This website was created for a school.">
    <meta name="author" content="Kinga">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../script.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">HOME</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="rec.php">RECIPES</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="sign_in.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            SIGN IN
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="sign_in.php">SIGN IN</a></li>
                            <li><a class="dropdown-item" href="sign_up.php">REGISTRATION</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="adm.php">ADMINISTRATION</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" action="search_ing.php" method="get">
                    <input type="text" id="searchInput" onkeyup="showResult(this.value)" placeholder="Search...">
                    <input type="hidden" id="currentPage" value="current_page_name"> <!-- Add this line -->
                    <div id="livesearch"></div>
                </form>

            <script src=../script2.js></script>
            
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" 
                    data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../images/me.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong><?php if(isset($_SESSION['user_name'])) { echo $_SESSION['user_name']; }?></strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="fridge.php">Fridge</a></li>
                        <li><a class="dropdown-item" href="rec_add.php">Adding recipes</a></li>
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="sign_out.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="container">
    <!-- Container for user profile information -->
    <div class="row profile_things">
        <!-- Column for profile image -->
        <div class="col-md-6">
            <img class="profile_img" src="../images/me.jpg">
        </div>
        <!-- Column for profile data -->
        <div class="col-md-6 datas">
            <!-- List group for user data -->
            <ul class="list-group mb-3 item-list">
                <!-- User name -->
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">User name</h6>
                    </div>
                    <!-- Display user name -->
                    <span class="text-muted" contenteditable="true" id="u_name"><?php echo $_SESSION['user_name'];?></span>
                </li>
                <!-- First name -->
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">First name</h6>
                    </div>
                    <!-- Display first name -->
                    <span class="text-muted" contenteditable="true" id="f_name"><?php echo $_SESSION['first_name'];?></span>
                </li>
                <!-- Last name -->
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Last Name</h6>
                    </div>
                    <!-- Display last name -->
                    <span class="text-muted" contenteditable="true" id="l_name"><?php echo $_SESSION['last_name'];?></span>
                </li>
                <!-- Phone number -->
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Phone number</h6>
                    </div>
                    <!-- Display phone number -->
                    <span class="text-muted" contenteditable="true" id="phone"><?php echo $_SESSION['phone_numb'];?></span>
                </li>
                <!-- Buttons for editing and logging out -->
                <li class="list-group-item">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn_edit" id="submit" type="submit">Edit</button>
                        <a class="btn btn-primary btn_edit" href="logout.php" type="button">LOGOUT</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Section for liked recipes -->
<h1 class="liked_header">Liked recipes</h1>
<div class="cards">
    <div class="wrapper"> 
        <!-- Navigation arrows -->
        <i id="left" class="fa-solid fas fa-angle-left">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
                <path d="M10 12.796V3.204L4.519 8zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753"/>
            </svg>
        </i> 
        <!-- Carousel for liked recipes -->
        <ul class="carousel"> 
            <!-- Individual recipe cards -->
            <?php
            require "db_conn.php";

            // Lekérdezés végrehajtása
            $query = "SELECT * FROM `receipt` WHERE likes = 1";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $food_name = $row['food_name'];
                    $time = $row['time'];
                    $img = $row['img'];

                    // HTML kód módosítása a recept adataival
                    echo '<li class="card">';
                    echo '<div class="img"><img src="images/' . $img .'" alt="" draggable="false"> </div>';
                    echo '<div class="card-body">';
                    echo '<p class="card-text">' . $food_name . '</p>';
                    echo '<div class="d-flex justify-content-between align-items-center">';
                    echo '<div class="btn-group">';
                    echo '<a type="button" class="btn btn-sm btn-outline-secondary" href="rec_food.html">View</a>';
                    echo '<button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>';
                    echo '</div>';
                    echo '<small class="text-body-secondary">' . $time . '</small>';
                    echo '</div>';
                    echo '</div>';
                    echo '</li>';
                }
            } else {
                echo "No liked recipes found.";
            }
            $conn->close();
            ?>
            <!-- Repeat the above structure for each recipe card -->
        </ul> 
        <!-- Navigation arrows -->
        <i id="right" class="fa-solid fas fa-angle-right">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-caret-right" viewBox="0 0 16 16">
                <path d="M6 12.796V3.204L11.481 8zM6.659 13.549l5.48-4.796a1 1 0 0 0 0-1.506l-5.48-4.796A1 1 0 0 0 5 3.204v9.592a1 1 0 0 0 1.659.753z"/>
            </svg>
        </i> 
    </div>
</div>


    <script src="../ajax.js"></script>
</body>
</html>
<?php } ?>
