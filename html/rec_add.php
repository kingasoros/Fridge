<?php
  
    require "db_conn.php";


    session_start();


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
                  <?php if (isset($_SESSION['email'])) {
                      $email = $_SESSION['email'];

                      $sql = "SELECT admin FROM profil WHERE email = '$email'";
                      $result = mysqli_query($conn, $sql);

                      if ($result && mysqli_num_rows($result) > 0) {
                          $row = mysqli_fetch_assoc($result);

                          if ($row['admin'] == 1) { ?>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="adm.php">ADMINISTRATION</a></li>
                  <li><a class="dropdown-item" href="update.php">UPDATE DATA</a></li>
                  <?php }}}?>
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
          <img src="images/<?php if (isset($_SESSION['img'])) { echo htmlspecialchars($_SESSION['img']); } ?>" alt="" width="32" height="32" class="rounded-circle me-2">
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
        <main class="cont_2">
          <h4 class="mb-3">ADDING RECIPES</h4> <!-- Title for adding recipes section -->
            <form class="needs-validation" action="rec_add_check.php" enctype="multipart/form-data" novalidate method="post"> <!-- Form for adding recipes -->

              <?php if(isset($_GET['error'])) {?>
                <p class="error"><?php echo $_GET['error']; ?></p> <!-- Display error messages if any -->
               <?php } ?>    
    
               <?php if(isset($_GET['success'])) {?>
                   <p class="success"><?php echo $_GET['success']; ?></p> <!-- Display success messages if any -->
               <?php } ?>
              <div class="row g-3">
                <div class="col-sm-12">
                  <label for="foodName" class="form-label">Food name</label>
                  <input type="text" name="food_name" class="form-control" id="foodName" placeholder="Soup" required> <!-- Input field for food name -->
                </div>

                <div class="col-sm-12">
                  <label for="yourName" class="form-label">Your name</label>
                  <input type="text" name="your_name" class="form-control" id="yourName" placeholder="Emese"  required> <!-- Input field for user name -->
                </div>

                <div class="col-sm-12">
                  <label for="categories" class="form-label">Category</label>
                  <input type="text" name="categories" class="form-control" id="categories" placeholder="Vegan"  required> <!-- Input field for user name -->
                </div>
          
                <div class="col-sm-12">
                  <label for="time" class="form-label">Cook time:</label>
                  <input type="text" name="time" class="form-control" id="time" placeholder="30 Minutes" required> <!-- Input field for cook time -->
                </div>

                <div class="col-sm-12">
                  <label for="price" class="form-label">Relative price (in dinar):</label>
                  <input type="text" name="price" class="form-control" id="price" placeholder="1500" required> <!-- Input field for price -->
                </div>

                <div class="col-sm-12">
                  <label for="serv" class="form-label">Serves:</label>
                  <input type="text" name="servings" class="form-control" id="serv" placeholder="10 Servings" required> <!-- Input field for servings -->
                </div>

                <div class="input-group mb-3">
                  <label for="food_photo" class="form-label col-sm-12">Upload a picture of the food:</label>
                  <input type="file" name="food_photo" class="form-control" id="food_photo"> <!-- Input field for uploading food photo -->
                </div>

                <div class="input-group" id="ingredients">
                <button type="button" class="btn btn-primary btn-sm add_btn" onclick="addEntry();"><span class="glyphicon glyphicon-plus"></span>+</button> <!-- Button to add ingredient -->
                  <div class="form-group ing_in">
                    <label for="ingredientName" class="form-label">Ingredient</label>
                    <input type="text" id="ingredientName" name="ingredients[]" placeholder="Enter ingredient here..." class="form-control" required="required"/> <!-- Input field for ingredient -->
                  </div>
                  <div class="form-group ms-2 ing_in">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="text" id="quantity" name="quantities[]" placeholder="Enter quantity here..." class="form-control" required="required"/> <!-- Input field for quantity -->
                  </div>
                  
               </div>
        
               </div>
               <br><br>
                <div class="form-floating">
                  <textarea class="form-control" placeholder="About the recipes" name="prep" id="floatingTextarea2" style="height: 100px"></textarea>
                  <label for="floatingTextarea2">Preparation</label> <!-- Text area for preparation -->
                </div>
                <br><br>
                <button class="w-100 btn btn-primary btn-lg butt_2" type="submit">Upload</button> <!-- Upload button -->
                </div>
            </form>

            


            <script src="../script2.js"></script>


          


</body>
</html>
