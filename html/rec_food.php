<?php


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
            <strong><?php if(isset($_SESSION['user_name'])) { echo $_SESSION['user_name']; }?></strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="fridge.php">Fridge</a></li>
            <li><a class="dropdown-item" href="rec_add.php">Adding recipes</a></li>
            <li><a class="dropdown-item" href="profile.html">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="sign_out.php">Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col order-md-6 receipt_body">
        <h1><?php echo $food_name; ?></h1>
        <img class="img_2" src="../images/carrot_cake.webp">
        <div class="col order-md-6">
          <p>Cook time: <?php echo $time; ?> Minutes</p>
          <p>Serves: <?php echo $servings; ?> serves</p>
          <p>Price: <?php echo $price; ?>din</p>
        </div>
        <br><br><br>
        <h2>Ingrediens</h2>
        <br>
        <ul class="rec_ingrediens_list">
          <?php foreach($ingrediens_names as $key => $ingrediens) { ?>
            <li><?php echo $quantities[$key] . ' ' . $ingrediens; ?></li>
          <?php } ?>
        </ul>
        <br><br><br>
        <h2>Preparation</h2>
        <p><?php echo $paragraph; ?></p><br><br>
      </div>
    </div>
  </div>
</body>
</html>

