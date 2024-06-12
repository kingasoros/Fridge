<?php
require_once 'db_conn.php';

session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>SIGN IN</title>
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
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="adm.php">ADMINISTRATION</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" action="search_ing.php" method="get">
                <input type="text" id="searchInput" onkeyup="showResult(this.value)" placeholder="Search...">
                <input type="hidden" id="currentPage" value="current_page_name">
                <div id="livesearch"></div>
            </form>
            <script src="../script2.js"></script>
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
    <main class="cont_3">
        <h4 class="mb-3">SIGN IN</h4>
        <form class="needs-validation" novalidate action="login.php" method="post">
            <div class="row g-3">
                <div class="col-12">
                    <!-- Display error message if present -->
                    <?php if(isset($_GET['error'])) {?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>    
                    <!-- Display success message if present -->
                    <?php if(isset($_GET['success'])) {?>
                        <p class="success"><?php echo $_GET['success']; ?></p>
                    <?php } ?>
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text">@</span>
                        <input type="text" name="uname" class="form-control" id="username" placeholder="Username" required>
                    </div>
                </div>
                <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="pass" class="form-control" id="password" placeholder="example.123">
                </div>
                <hr class="my-4">
                <button class="w-100 btn btn-primary btn-lg butt_2" type="submit">Sign in</button>
                <a href="sign_up.php" class="ca">Create an account.</a>
            </div>
        </form>

        <!-- <a href="#" id="fl">Have you forgotten your password?</a>
        
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="forget" id="forgetForm" style="display: none;">
              <div class="pt-3">
                  <label for="forgetEmail" class="form-label">E-mail</label>
                  <input type="text" class="form-control" id="forgetEmail" placeholder="Enter your e-mail address" name="email" required>
                  <small></small>
              </div>
              <div class="pt-3">
                  <input type="hidden" name="action" value="forget">
                  <button type="submit" class="btn btn-primary">Reset password</button>
              </div>
          </form>
          </div>
        <script>
        if (fl !== null) {
          fl.addEventListener('click', function (e) {
              let forgetForm = document.querySelector('#forgetForm');
      
              if (forgetForm.style.display !== "block") {
                  forgetForm.style.display = "block";
                  this.textContent = 'Hide form.';
              } else {
                  forgetForm.style.display = "none";
                  this.textContent = 'Have you forgotten your password?';
              }
      
              e.preventDefault();
          });
      }
      </script> -->
      
    </main>
</div>
</body>
</html>
