<!-- This PHP script handles session management and database connection. -->
<?php
session_start();
include "db_conn.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>FRIDGE</title>
    <meta charset="UTF-8">
    <meta name="description" content="This website was created for a school.">
    <meta name="author" content="Kinga">
    <!-- External CSS stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- External JavaScript library -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- External CSS stylesheet -->
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<!-- Navigation bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Home link -->
        <a class="navbar-brand" href="../index.php">HOME</a>
        <!-- Navbar toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar collapse -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Recipes link -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="rec.php">RECIPES</a>
                </li>
                <!-- Sign in dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="sign_in.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        SIGN IN
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <!-- Sign in and registration links -->
                        <li><a class="dropdown-item" href="sign_in.php">SIGN IN</a></li>
                        <li><a class="dropdown-item" href="sign_up.php">REGISTRATION</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <!-- Administration link -->
                        <li><a class="dropdown-item" href="adm.php">ADMINISTRATION</a></li>
                    </ul>
                </li>
            </ul>
            <!-- Search form -->
            <form class="d-flex" action="search.php" method="get">
                <input class="form-control me-2" type="text" id="searchInput" placeholder="Search" aria-label="Search" onkeyup="showResult(this.value)">
                <div id="livesearch"></div>
            </form>

            <script src=../script2.js></script>
            
            <!-- User dropdown -->
            <div class="dropdown">
                <!-- Dropdown toggle -->
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" 
                data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- User image and name -->
                    <img src="../images/me.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong><?php if(isset($_SESSION['user_name'])) { echo $_SESSION['user_name']; }?></strong>
                </a>
                <!-- Dropdown menu -->
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <!-- User-related links -->
                    <li><a class="dropdown-item" href="fridge.php">Fridge</a></li>
                    <li><a class="dropdown-item" href="rec_add.php">Adding recipes</a></li>
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <!-- Sign out link -->
                    <li><a class="dropdown-item" href="sign_out.php">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="conatiner">
    <div class="row">
        <!-- Ingredient form -->
        <div class="ingredients-title box col-md-6">
            <h1 class="fridge_header">WHAT'S IN YOUR FRIDGE?</h1>
            <form class="ingrediens" id="ingredientForm" action="fridge_check.php" novalidate method="post">
                <!-- Error message -->
                <?php if(isset($_GET['error'])) {?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>    
                <!-- Success message -->
                <?php if(isset($_GET['success'])) {?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
                <!-- Ingredient input field -->
                <label for="ingredientName">INGREDIENT NAME:</label>
                <input type="text" id="ingredientName" name="ingredientName" required>
                <button type="submit" class="button submit" onclick="addIngredient()">Add</button>
            </form>
            <!-- Search input field -->
            <h2 class="ing_title" >Search Ingredients</h2>
            <input type="text" id="searchInput" oninput="searchIngredients()" placeholder="Search...">
            <!-- Search results container -->
            <div id="searchResults"></div>        
            <!-- Ingredients list -->
            <h2 class="ing_title">Ingredients List</h2>
            <div id="ingredientsList">
                <!-- PHP to fetch ingredients from database -->
                <?php
                // $sql = "SELECT * FROM ingrediens";
                // $result = mysqli_query($conn, $sql);
                // if (mysqli_num_rows($result) > 0) {
                //     while ($row = mysqli_fetch_assoc($result)) {
                //         echo "<div class='ingredient' id='{$row['name']}_div'>";
                //         echo "<input type='checkbox' id='{$row['name']}' name='{$row['name']}' value='{$row['name']}'onclick='moveChecked(this)'>";
                //         echo "<label for='{$row['name']}'>{$row['name']} - {$row['quantity']}</label>";
                //         echo "</div>";
                //     }
                // } else {
                //     echo "No ingredients found.";
                // }
                ?>
            </div>
        </div>
        <!-- Selected ingredients container -->
        <div class="box box_2">
            <!-- Check if any ingredient is selected -->
            <?php if (empty($_POST['ingredient'])) {?>
            <!-- Message for no selected ingredients -->
            <p class="checked-ingredients-title">Your Ingredients</p>
            <div class="Empty" id="selectedIngredients">
                <p id="noIngredientsMsg">You don't have any selected ingredients.</p>
            </div>
            <!-- PHP loop for selected ingredients -->
            <?php } else {?>
                <!-- Message for selected ingredients -->
                <p class="checked-ingredients-title">Your Selected Ingredients</p>
                <div class="NotEmpty" id="selectedIngredients">
                    <!-- Loop through selected ingredients -->
                    <?php foreach ($_POST['ingredient'] as $ingredient):?>
                        <div class="selected-ingredient">
                            <!-- Display selected ingredient -->
                            <p><?php echo $ingredient;?></p>
                        </div>
                    <?php endforeach;?>
                </div>
            <?php }?>
            <!-- Clear all ingredients button -->
            <button type="submit" class="remove button submit" onclick="clearAllIngredients()">Clear All</button>
            <!-- Find recipes button -->
            <div class="button submit" onclick="findRecipes()">
                <span class="button">Find Recipes</span>
            </div>
        </div>
    </div>
</div>
<!-- External JavaScript file -->
<script src="../script2.js"></script>
</body>
</html>
