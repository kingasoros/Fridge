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
        <main class="cont_2">
          <h4 class="mb-3">ADDING RECIPES</h4>
            <form class="needs-validation" action="rec_add_check.php" novalidate method="post">

              <?php if(isset($_GET['error'])) {?>
                <p class="error"><?php echo $_GET['error']; ?></p>
               <?php } ?>    
    
               <?php if(isset($_GET['success'])) {?>
                   <p class="success"><?php echo $_GET['success']; ?></p>
               <?php } ?>
              <div class="row g-3">
                <div class="col-sm-12">
                  <label for="foodName" class="form-label">Food name</label>
                  <input type="text" name="food_name" class="form-control" id="foodName" placeholder="Soup" required>
                </div>

                <div class="col-sm-12">
                  <label for="yourName" class="form-label">Your name</label>
                  <input type="text" name="your_name" class="form-control" id="yourName" placeholder="Emese"  required>
                </div>
          
                <div class="col-sm-12">
                  <label for="time" class="form-label">Cook time:</label>
                  <input type="text" name="time" class="form-control" id="time" placeholder="30 Minutes" required>
                </div>

                <div class="col-sm-12">
                  <label for="price" class="form-label">Relative price (in dinar):</label>
                  <input type="text" name="price" class="form-control" id="price" placeholder="1500" required>
                </div>

                <div class="col-sm-12">
                  <label for="serv" class="form-label">Serves:</label>
                  <input type="text" name="servings" class="form-control" id="serv" placeholder="10 Servings" required>
                </div>

                <div class="input-group mb-3">
                  <label for="food_photo" class="form-label col-sm-12">Upload a picture of the food:</label>
                  <input type="file" name="food_photo" class="form-control" id="food_photo">
                </div>

                <div class="input-group mb-3">
                <label for="ingredients" class="form-label col-sm-12">Ingredients:</label>
                
                <button class="btn btn-outline-secondary butt_2" type="button" id="button-addon1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg>
                </button>
                <input type="text" name="ingredients_rec[]" class="form-control" id="ingredients" placeholder="Add an ingredient." aria-label="Example text with button addon" aria-describedby="button-addon1">
                <!-- Hozzáadott mező az összetevő mennyiségéhez -->
                <input type="text" name="ingredient_quantity[]" class="form-control" id="ingredient_quantity" placeholder="Quantity" aria-label="Example text with button addon" aria-describedby="button-addon1">
                <input type="hidden" name="ingredientsArray" id="ingredientsArray">
                </div>
                <div id="ingredientsList"></div>

                <div class="form-floating">
                  <textarea class="form-control" placeholder="About the recipes" name="prep" id="floatingTextarea2" style="height: 100px"></textarea>
                  <label for="floatingTextarea2">Preparation</label>
                </div>
                <input type="hidden" name="ingredientsArray" id="ingredientsArray">
                <button class="w-100 btn btn-primary btn-lg butt_2" type="submit">Upload</button>
              </div>
            </form>

            <script>
            // Az ingredientsArray tömb inicializálása
            let ingredientsArray = [];

            // Gomb kattintás eseménykezelő
            document.getElementById('button-addon1').addEventListener('click', function() {
                // Beírt értékek lekérése
                let ingredient = document.getElementById('ingredients').value;
                let quantity = document.getElementById('ingredient_quantity').value;

                // Objektum létrehozása az aktuális összetevőhöz és mennyiségéhez
                let ingredientObj = {
                    ingredient: ingredient,
                    quantity: quantity
                };

                // Hozzáadás az ingredientsArray tömbhöz
                ingredientsArray.push(ingredientObj);

                // Az összetevők listájának megjelenítése
                displayIngredients();
            });

            // A hozzáadott összetevők listájának megjelenítése
            function displayIngredients() {
                let ingredientsListContainer = document.getElementById('ingredientsList');
                // Töröld az előző tartalmat, ha van
                ingredientsListContainer.innerHTML = '';

                // Végigiterálunk az ingredientsArray tömbön
                for (let i = 0; i < ingredientsArray.length; i++) {
                    let ingredient = ingredientsArray[i].ingredient;
                    let quantity = ingredientsArray[i].quantity;                  

                    // Létrehozzuk az új elemet az összetevőhöz és mennyiségéhez
                    let ingredientItem = document.createElement('div');
                    ingredientItem.textContent = quantity + ' ' + ingredient;

                    // Hozzáadjuk az új elemet az összetevők listájához
                    ingredientsListContainer.appendChild(ingredientItem);
                }
                document.getElementById('ingredientsArray').value = JSON.stringify(ingredientsArray);
            }

          </script>

</body>
</html>