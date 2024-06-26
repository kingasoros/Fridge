<?php

session_start();
require "db_conn.php";

$ingrediens_names = [];
$quantities = [];

if(isset($_GET['receipt_id'])){
  $receipt_id = $_GET['receipt_id'];
}

// Lekérdezések
$food_name_query = "SELECT food_name FROM receipt WHERE receipt_id = '$receipt_id'";
$time_query = "SELECT time FROM receipt WHERE receipt_id = '$receipt_id'";
$price_query = "SELECT price FROM receipt WHERE receipt_id = '$receipt_id'";
$paragraph_query = "SELECT paragraph FROM receipt WHERE receipt_id = '$receipt_id'";
$name_query = "SELECT your_name FROM receipt WHERE receipt_id = '$receipt_id'";
$servings_query = "SELECT servings FROM receipt WHERE receipt_id = '$receipt_id'";
$img_query = "SELECT img FROM receipt WHERE receipt_id = '$receipt_id'";
$ingrediens_query = "SELECT i.name, ri.quantity FROM ingrediens i
                     JOIN receipt_ingredient ri ON i.ingrediens_id = ri.ingrediens_id
                     WHERE ri.receipt_id = '$receipt_id'";

// Eredmények lekérdezése
$food_name_result = $conn->query($food_name_query);
$time_result = $conn->query($time_query);
$price_result = $conn->query($price_query);
$paragraph_result = $conn->query($paragraph_query);
$name_result = $conn->query($name_query);
$servings_result = $conn->query($servings_query);
$img_result = $conn->query($img_query);
$ingrediens_result = $conn->query($ingrediens_query);

// Adatok feldolgozása
if ($food_name_result->num_rows > 0) {
  $row = $food_name_result->fetch_assoc();
  $food_name = $row['food_name'];
}

if ($time_result->num_rows > 0) {
  $row = $time_result->fetch_assoc();
  $time = $row['time'];
}

if ($price_result->num_rows > 0) {
  $row = $price_result->fetch_assoc();
  $price = $row['price'];
}

if ($paragraph_result->num_rows > 0) {
  $row = $paragraph_result->fetch_assoc();
  $paragraph = $row['paragraph'];
}

if ($name_result->num_rows > 0) {
  $row = $name_result->fetch_assoc();
  $name = $row['your_name'];
}

if ($servings_result->num_rows > 0) {
  $row = $servings_result->fetch_assoc();
  $servings = $row['servings'];
}

if ($img_result->num_rows > 0) {
  $row = $img_result->fetch_assoc();
  $img = $row['img'];
}

if ($ingrediens_result->num_rows > 0) {
  while($row = $ingrediens_result->fetch_assoc()) {
    $ingrediens_names[] = $row['name'];
    $quantities[] = $row['quantity'];
  }
}


?>

<!DOCTYPE html>
<html>
<head>
  <title>RECIPES</title>
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
    <div class="row">
      <div class="col order-md-6 receipt_body">
        <h1><?php echo $food_name; ?></h1> <!-- Displaying the name of the recipe -->
        <img class="img_2" src="images/<?php echo $img?>"> <!-- Displaying the image of the recipe -->
        <div class="col order-md-6">
          <p>Cook time: <?php echo $time; ?> Minutes</p> <!-- Displaying the cooking time -->
          <p>Serves: <?php echo $servings; ?> serves</p> <!-- Displaying the number of servings -->
          <p>Price: <?php echo $price; ?>din</p> <!-- Displaying the price -->
        </div>
        <br><br><br>
        <h2>Ingrediens</h2> <!-- Ingredients section heading -->
        <br>
        <ul class="rec_ingrediens_list">
          <?php foreach($ingrediens_names as $key => $ingrediens) { ?>
            <li><?php echo $quantities[$key] . ' ' . $ingrediens; ?></li> <!-- Displaying ingredients with their quantities -->
          <?php } ?>
        </ul>
        <br><br><br>
        <h2>Preparation</h2> <!-- Preparation section heading -->
        <p><?php echo $paragraph; ?></p><br><br> <!-- Displaying the preparation paragraph -->
        <?php $yt_query = "SELECT yt FROM receipt WHERE paragraph = '$paragraph'";
        $yt_result = $conn->query($yt_query); 
        if ($yt_result->num_rows > 0) {
          while ($row = $yt_result->fetch_assoc()) {
              // Check if YT link is not empty
              if (!empty($row['yt'])) {
                  echo '<iframe width="560" height="315" src="'.$row['yt'].'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share">';
              }
          }
      }?>
      </div>
    </div>
  </div>

</body>
</html>

