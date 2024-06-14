<?php

require "db_conn.php";
session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>SIGN UP</title>
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
                  <?php }}}?>
                </ul>
              </li>
            </ul>

            <script src=../script2.js></script>

            <?php  if(isset($_SESSION['last_name']) && isset($_SESSION['phone_numb']) &&
                isset($_SESSION['user_name']) && isset($_SESSION['first_name']) &&
                isset($_SESSION['email'])){ ?>

            <form class="d-flex" action="search_ing.php" method="get">
                <input type="text" id="searchInput" onkeyup="showResult(this.value)" placeholder="Search...">
                <input type="hidden" id="currentPage" value="current_page_name"> <!-- Add this line -->
                <div id="livesearch"></div>
            </form>

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
        <?php } ?>
      </div>
    </div>
      </nav>

      <div class="container">
    <main class="cont_2">
        <h4 class="mb-3">SIGN UP</h4>
        <!-- Display error message if present -->
        <?php if(isset($_GET['error'])) {?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>    
        <!-- Display success message if present -->
        <?php if(isset($_GET['success'])) {?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>
        <form class="needs-validation" action="sign_up_check.php" enctype="multipart/form-data" novalidate method="post">
            <div class="row g-3">
                <div class="col-sm-6">
                    <label for="f_name" class="form-label">First name</label>
                    <!-- Populate input field with value if available -->
                    <?php if(isset($_GET['f_name'])) {?>
                        <input type="text" class="form-control" name="f_name" id="f_name" placeholder="Example" value="<?php echo $_GET['f_name'];?>"><br>
                    <?php }else{ ?> 
                        <input type="text" class="form-control" name="f_name" id="f_name" placeholder="Example"><br>
                    <?php } ?>
                </div>
                <div class="col-sm-6">
                    <label for="l_name" class="form-label">Last name</label>
                    <!-- Populate input field with value if available -->
                    <?php if(isset($_GET['l_name'])) {?>
                        <input type="text" class="form-control" name="l_name" id="l_name" placeholder="Example" value="<?php echo $_GET['l_name'];?>"><br>
                    <?php }else{ ?> 
                        <input type="text" class="form-control" name="l_name" id="l_name" placeholder="Example"><br>
                    <?php } ?>
                </div>
            </div>
            <div class="col-12">
                <label for="uname" class="form-label">Username</label>
                <div class="input-group has-validation">
                    <!-- Populate input field with value if available -->
                    <?php if(isset($_GET['uname'])) {?>
                        <input type="text" class="form-control" name="uname" id="uname" placeholder="Example.123" value="<?php echo $_GET['uname'];?>"><br>
                    <?php }else{ ?> 
                        <input type="text" class="form-control" name="uname" id="uname" placeholder="Example.123"><br>
                    <?php } ?>
                </div>
            </div>
            <div class="col-12">
                <label for="phone" class="form-label">Phone</label>
                <div class="input-group has-validation">
                    <input type="text" name="phone_numb" class="form-control" id="phone" placeholder="0600000000" required>
                </div>
            </div>
            <div class="col-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
            </div><br>
            <div class="input-group mb-3">
                  <label for="user_photo" class="form-label col-sm-12">Upload a picture of yourself:</label>
                  <input type="file" name="user_photo" class="form-control" id="user_photo"> <!-- Input field for uploading food photo -->
                </div>
            <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="pass" class="form-control" id="password" placeholder="example.123">
            </div>
            <div class="col-12">
                <label for="re_password" class="form-label">Password</label>
                <input type="password" name="re_pass" class="form-control" id="re_password" placeholder="example.123">
            </div>
            <hr class="my-4">
            <button class="w-100 btn btn-primary btn-lg butt_2" type="submit">Registration</button>
            <a href="sign_in.php" class="ca">Already have an account?</a>
        </form>
    </main>
</div>

    </body>
</html>
