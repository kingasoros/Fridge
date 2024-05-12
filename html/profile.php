<?php

session_start();

if(isset($_SESSION['last_name']) && isset($_SESSION['phone_numb']) &&
   isset($_SESSION['user_name']) && isset($_SESSION['first_name']) &&
   isset($_SESSION['email'])){ ?>

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
    

<div class="container">
    <div class="row profile_things">
        <div class="col-md-6">
            <img class="profile_img" src="../images/me.jpg">
        </div>
        <div class="col-md-6 datas">
            <ul class="list-group mb-3 item-list">
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">User name</h6>
                    </div>
                    <span class="text-muted" contenteditable="true"><?php echo $_SESSION['user_name'];?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">First name</h6>
                    </div>
                    <span class="text-muted" contenteditable="true"><?php echo $_SESSION['first_name'];?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Last Name</h6>
                    </div>
                    <span class="text-muted" contenteditable="true"><?php echo $_SESSION['last_name'];?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Phone number</h6>
                    </div>
                    <span class="text-muted" contenteditable="true"><?php echo $_SESSION['phone_numb'];?></span>
                </li>

                <li class="list-group-item ">
                    <div class="d-grid gap-2">
                        <a class="btn btn-primary btn_edit" href="logout.php" type="button">LOGOUT</a>
                        
                    </div>
                </li>
            </ul>
            <button class="btn btn-primary btn_edit" onclick="saveChanges()" type="button">Save Changes</button>
            <!-- <button id="frissitoGomb" class="save">Edit</button> -->
        </div>
    </div>
</div>


      <h1 class="liked_header">Liked recipes</h1>
      <div class="cards">
        <div class="wrapper"> 
          <i id="left" class="fa-solid  fas fa-angle-left"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
            <path d="M10 12.796V3.204L4.519 8zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753"/>
          </svg></i> 
          <ul class="carousel"> 
              <li class="card"> 
                  <div class="img"><img src="../images/spinach_pasta.webp" alt="" draggable="false"> </div> 
                  <div class="card-body">
                    <p class="card-text">Easy Slow-Cooker Sun-Dried Tomato & Spinach Pasta.</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a type="button" class="btn btn-sm btn-outline-secondary" href="rec_food.html">View</a>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                      </div>
                      <small class="text-body-secondary">9 mins</small>
                    </div>
                  </div> 
              </li> 
              <li class="card"> 
                  <div class="img"><img src="../images/alf_chick.webp" alt="" draggable="false"> </div> 
                  <div class="card-body">
                    <p class="card-text">The Easiest Chicken Alfredo & Broccoli Rice Casserole.</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a type="button" class="btn btn-sm btn-outline-secondary" href="rec_food.html">View</a>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                      </div>
                      <small class="text-body-secondary">9 mins</small>
                    </div>
                  </div> 
              </li> 
              <li class="card"> 
                  <div class="img"><img src="../images/chili_bean.webp" alt="" draggable="false"> </div> 
                  <div class="card-body">
                    <p class="card-text">Slow-Cooker Three-Bean Chili Mac.</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a type="button" class="btn btn-sm btn-outline-secondary" href="rec_food.html">View</a>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                      </div>
                      <small class="text-body-secondary">9 mins</small>
                    </div>
                  </div>
              </li> 
              <li class="card"> 
                  <div class="img"><img src="../images/carrot_cake.webp" alt="" draggable="false"> </div> 
                  <div class="card-body">
                    <p class="card-text">Carrot Cake Baked Oatmeal.</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a type="button" class="btn btn-sm btn-outline-secondary" href="rec_food.html">View</a>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                      </div>
                      <small class="text-body-secondary">9 mins</small>
                    </div>
                  </div>
              </li> 
              <li class="card"> 
                  <div class="img"><img src="../images/salmon.webp" alt="" draggable="false"> </div> 
                  <div class="card-body">
                    <p class="card-text">Quick Sheet-Pan Salmon with Crispy Quinoa.</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a type="button" class="btn btn-sm btn-outline-secondary" href="rec_food.html">View</a>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                      </div>
                      <small class="text-body-secondary">9 mins</small>
                    </div>
                  </div>
              </li> 
              <li class="card"> 
                  <div class="img"><img src="../images/cauliflower.webp" alt="" draggable="false"> </div> 
                  <div class="card-body">
                    <p class="card-text">Panko-Crusted Cauliflower Steaks.</p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a type="button" class="btn btn-sm btn-outline-secondary" href="rec_food.html">View</a>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                      </div>
                      <small class="text-body-secondary">9 mins</small>
                    </div>
                  </div>
              </li> 
          </ul> 
          <i id="right" class="fa-solid fas fa-angle-right"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-caret-right" viewBox="0 0 16 16">
            <path d="M6 12.796V3.204L11.481 8zm.659.753 5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753"/>
          </svg></i> 
      </div> 
      </div>
    
    </body>
</html>

<?php 
}else
    header("Location:index.php");
    exit();   
?>