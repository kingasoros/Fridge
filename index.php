<?php

require "html/db_conn.php";
session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>WP_SeresKinga</title>
        <meta charset="UTF-8">
        <meta name="description" content="This website was created for a school.">
        <meta name="author" content="Kinga">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php">HOME</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="html/rec.php">RECIPES</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="html/sign_in.php" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  SIGN IN
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="html/sign_in.php">SIGN IN</a></li>
                  <li><a class="dropdown-item" href="html/sign_up.php">REGISTRATION</a></li>
                  <?php 
                      if (isset($_SESSION['email'])) {
                          $email = $_SESSION['email'];
                          
                          $sql = "SELECT admin FROM profil WHERE email = '$email'";
                          $result = mysqli_query($conn, $sql);
                          
                          if ($result && mysqli_num_rows($result) > 0) {
                              $row = mysqli_fetch_assoc($result);
                              
                              if ($row['admin'] == 1) { 
                      ?>
                                  <li><hr class="dropdown-divider"></li>
                                  <li><a class="dropdown-item" href="html/adm.php">ADMINISTRATION</a></li>
                                  <li><a class="dropdown-item" href="html/update.php">UPDATE DATA</a></li>
                      <?php 
                              }
                          }
                      }
                      ?>

                </ul>
              </li>
            </ul>

            <script src=script2.js></script>
            
            <?php  if(isset($_SESSION['last_name']) && isset($_SESSION['phone_numb']) &&
                isset($_SESSION['user_name']) && isset($_SESSION['first_name']) &&
                isset($_SESSION['email'])){ ?>
            <form class="d-flex" action="search_ing.php" method="get">
                <input type="text" id="searchInput" onkeyup="showResult(this.value)" placeholder="Search...">
                <input type="hidden" id="currentPage" value="index"> <!-- Add this line -->
                <div id="livesearch"></div>
            </form>

          <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" 
          data-bs-toggle="dropdown" aria-expanded="false">
            <img src="html/images/<?php if (isset($_SESSION['img'])) { echo htmlspecialchars($_SESSION['img']); } ?>" alt="" width="32" height="32" class="rounded-circle me-2">
            <strong><?php if(isset($_SESSION['user_name'])) { echo $_SESSION['user_name']; }?></strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="html/fridge.php">Fridge</a></li>
            <li><a class="dropdown-item" href="html/rec_add.php">Adding recipes</a></li>
            <li><a class="dropdown-item" href="html/profile.php">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="html/sign_out.php">Sign out</a></li>
          </ul>
        </div>
        <?php } ?>
      </div>
      </div>
    </nav>
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light cont">
    <!-- Introduction Section -->
    <div class="col-md-5 p-lg-5 mx-auto my-5 text-center">
        <h1 class="display-4 fw-normal">RECIPES</h1>
        <p class="lead fw-normal">Recipes based on what you have in your fridge.</p>
        <a class="btn btn-outline-secondary" href="html/rec.php">Are you interested?</a>
    </div>
    <div class="product-device shadow-sm d-none d-md-block"></div>
    <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
</div>

<!-- Testimonial Section -->
<div class="container marketing">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4 media">
            <p class="m_img"></p>
            <h2 class="fw-normal">Kinga</h2>
            <p>It's a daily question for me: What should I cook for lunch today? This website helped me a lot. I hope you will find it useful too!</p>
            <p><a class="btn btn-secondary" href="html/sign_up.php">Let's start! &raquo;</a></p>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>

<hr>

<!-- Featurette Section 1 -->
<div class="row featurette">
    <div class="col-md-6">
        <h2 class="featurette-heading fw-normal lh-1">Would you like to quickly find a recipe based on what's in your fridge?</h2>
        <p class="lead">You are at the right place!</p>
    </div>
    <div class="col-md-5">
        <img class="start_img" src="html/images/fridge.jpg">
    </div>
</div>

<hr>

<!-- Featurette Section 2 -->
<div class="row featurette">
    <div class="col-md-6 col-sm-12 order-md-2">
        <h2 class="featurette-heading fw-normal lh-1">Don't have time to cook all the time, but do you like to save recipes for later?</h2>
        <p class="lead">This is also possible.</p>
    </div>
    <div class="col-md-6 col-sm-12 order-md-1">
        <img class="start_img" src="html/images/cook.jpg">
    </div>
</div>

<hr>

<!-- Featurette Section 3 -->
<div class="row featurette">
    <div class="col-md-6">
        <h2 class="featurette-heading fw-normal lh-1">Are you full of ideas?</h2>
        <p class="lead">Register and share your recipes with us!</p>
    </div>
    <div class="col-md-5">
        <img class="start_img" src="html/images/recipes.jpg">
    </div>
</div>

    </body>
</html>