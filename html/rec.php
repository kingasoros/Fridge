<?php

session_start();
require "db_conn.php";

// Query to fetch all required data from the receipt table
$query = "SELECT food_name, time, receipt_id, img FROM receipt";
$result = $conn->query($query);

$food_names = array();
$times = array();
$ids = array();
$imgs = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $food_names[] = $row['food_name'];
        $times[] = $row['time'];
        $ids[] = $row['receipt_id'];
        $imgs[] = $row['img'];
    }
}

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

    <main>
        <div class="album py-5 bg-body-tertiary">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php foreach($food_names as $key => $food_name) {
                        $time = $times[$key];
                        $id = $ids[$key];
                        $img = $imgs[$key];
                        
                    ?>
                    <div class="col">
                        <div class="card shadow-sm">
                         <!-- <?php echo '<img class="card_imgs" alt="Recipe Image" src="data:image/jpg;base64,'.base64_encode($img).'" />';?> -->
                            <img class="card_imgs" src="../images/spinach_pasta.webp" alt="Recipe Image">
                            <div class="card-body">
                                <p class="card-text"><?php echo htmlspecialchars($food_name); ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <form method="get" action="rec_food.php">
                                            <input type="hidden" name="receipt_id" value="<?php echo $id; ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">View</button>
                                        </form>
                                        <form method="get" action="receipt_edit.php">
                                            <input type="hidden" name="receipt_id" value="<?php echo $id; ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Edit</button>
                                        </form>
                                        <form method="post" action="delete_food.php">
                                            <input type="hidden" name="receipt_id" value="<?php echo $id; ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Delete</button>
                                        </form>
                                    </div>
                                    <small class="text-body-secondary"><?php echo htmlspecialchars($time); ?> mins</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>

    <footer class="text-body-secondary py-5">
        <div class="container">
            <p class="float-end mb-1">
                <a href="#">Back to top</a>
            </p>
        </div>
    </footer>

    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
   </script>
   <script src=../script2.js></script>
</body>
</html>

