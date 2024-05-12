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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="../index.html">HOME</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="rec.html">RECIPES</a>
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
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success butt_1" type="submit">Search</button>
            </form>
          <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" 
          data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../images/me.jpg" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong>Kinga</strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="fridge.php">Fridge</a></li>
            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="sign_out.php">Sign out</a></li>
          </ul>
        </div>
      </div>
      </div>
    </nav>

    <div class="conatiner">
        <div class="row">
            <div class="ingredients-title box col-md-6">
                <h1 class="fridge_header">WHAT'S IN YOUR FRIDGE?</h1>
                <form class="ingrediens" id="ingredientForm" action="fridge_check.php" novalidate method="post">

                    <?php if(isset($_GET['error'])) {?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>    

                    <?php if(isset($_GET['success'])) {?>
                        <p class="success"><?php echo $_GET['success']; ?></p>
                    <?php } ?>

                    <label for="ingredientName">INGREDIENT NAME:</label>
                    <input type="text" id="ingredientName" name="ingredientName" required>
                    <label for="ingredientQuantity">Quantity:</label>
                    <input type="text" id="ingredientQuantity" name="ingredientQuantity" required>
                    <button type="submit" class="button submit" onclick="addIngredient()">Add</button>
                </form>
        <h2 class="ing_title" >Search Ingredients</h2>
        <input type="text" id="searchInput" oninput="searchIngredients()" placeholder="Search...">
        <div id="searchResults">
            
        </div>        
        <h2 class="ing_title">Ingredients List</h2>
        <div id="ingredientsList">
                    <?php
                    // Lekérjük az összes hozzávalót az adatbázisból
                    $sql = "SELECT * FROM ingrediens";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='ingredient' id='{$row['name']}_div'>";
                            echo "<input type='checkbox' id='{$row['name']}' name='{$row['name']}' value='{$row['name']}'onclick='moveChecked(this)'>";
                            echo "<label for='{$row['name']}'>{$row['name']} - {$row['quantity']}</label>";
                            echo "</div>";
                        }
                    } else {
                        echo "No ingredients found.";
                    }
                    ?>
        </div>
    </div>
 

  <div class="box box_2">
    <?php if (empty($_POST['ingredient'])) {?>
        <p class="checked-ingredients-title">Your Ingredients</p>
        <div class="Empty" id="selectedIngredients">
            <p id="noIngredientsMsg">You don't have any selected ingredients.</p>
        </div>
    <?php } else {?>
        <p class="checked-ingredients-title">Your Selected Ingredients</p>
        <div class="NotEmpty" id="selectedIngredients">
            <?php foreach ($_POST['ingredient'] as $ingredient):?>
                <div class="selected-ingredient">
                    <p><?php echo $ingredient;?></p>
                </div>
            <?php endforeach;?>
        </div>
    <?php }?>
    <button type="submit" class="remove button submit" onclick="clearAllIngredients()">Clear All</button>
    <div class="button submit" onclick="findRecipes()">
    <span class="button">Find Recipes</span>

    </div>
</div>
<script>
    // Array to store added ingredients
let ingredients = [];

// Function to display ingredients
function displayIngredients() {
        let ingredientsList = document.getElementById("ingredientsList");
        ingredientsList.innerHTML = "";
        ingredients.forEach((ingredient, index) => {
            let div = document.createElement("div");
            div.className = "ingredient";
            div.innerHTML = `
                <input type="checkbox" id="ingredient${index}" name="ingredient${index}" value="${ingredient.name}">
                <label for="ingredient${index}">${ingredient.name} - ${ingredient.quantity}</label>
            `;
            ingredientsList.appendChild(div);
        });
    }

// Function to search ingredients
function searchIngredients() {
    let searchInput = document.getElementById("searchInput").value.toLowerCase();
    let searchResults = document.getElementById("searchResults");
    searchResults.innerHTML = "";
    let filteredIngredients = ingredients.filter(ingredient =>
        ingredient.name.toLowerCase().includes(searchInput)
    );
    filteredIngredients.forEach(ingredient => {
        let div = document.createElement("div");
        div.innerHTML = `${ingredient.name} - ${ingredient.quantity}`;
        searchResults.appendChild(div);
    });
}


function moveChecked(checkbox) {
    if (checkbox.checked) {
        let selectedIngredients = document.getElementById('selectedIngredients');
        let ingredientName = checkbox.value.split(' - ')[0];
        let ingredientParagraph = document.createElement('p');
        ingredientParagraph.textContent = ingredientName;
        selectedIngredients.appendChild(ingredientParagraph);
        checkbox.parentNode.style.display = 'none';

        // Ha van kiválasztott összetevő, akkor töröljük az üzenetet
        document.getElementById('noIngredientsMsg').style.display = 'none';
    } else {
        // Ha nincs kiválasztott összetevő, akkor jelenítjük meg az üzenetet
        document.getElementById('noIngredientsMsg').style.display = 'block';
        // Visszateszi az összetevőt az ingredientsList div-be
        let ingredientsList = document.getElementById('ingredientsList');
        let ingredientId = checkbox.id;
        let ingredientDiv = document.getElementById(ingredientId + "_div");
        if (ingredientDiv) {
            ingredientsList.appendChild
        }
      }
  }

function clearAllIngredients() {
    // Kiválasztjuk az összes kiválasztott összetevőt
    let selectedIngredients = document.querySelectorAll('.selected-ingredient');

    // Iterálunk az összetevőkön, és mindegyiket hozzáadjuk az ingredientsList-hez
    selectedIngredients.forEach(function(ingredient) {
        let ingredientName = ingredient.querySelector('p').textContent;
        let checkbox = document.querySelector(`input[value="${ingredientName}"]`);
        checkbox.checked = false; // Kiválasztott állapot törlése
        ingredient.remove(); // Eltávolítjuk az összetevőt a kiválasztottak közül
    });

    // Megjelenítjük az üzenetet, ha nincs kiválasztott összetevő
    document.getElementById('noIngredientsMsg').style.display = 'block';
}




</script>
</body>
</html>