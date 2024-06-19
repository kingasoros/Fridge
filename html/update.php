<?php
session_start();

// Database connection
require "db_conn.php";

// Query to fetch categories from receipt table
$query = "SELECT receipt_id, categories FROM receipt ORDER BY categories ASC";
$result = $conn->query($query);

if (!$result) {
die("Query failed: " . $conn->error);
}

// Query to fetch ingredients from ingredients table
$query2 = "SELECT ingrediens_id, name FROM ingrediens ORDER BY name ASC";
$result2 = $conn->query($query2);

if (!$result2) {
die("Query failed: " . $conn->error);
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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="rec.php">RECIPES</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="sign_in.php" id="navbarDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        SIGN IN
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="sign_in.php">SIGN IN</a></li>
                        <li><a class="dropdown-item" href="sign_up.php">REGISTRATION</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="adm.php">ADMINISTRATION</a></li>
                        <li><a class="dropdown-item" href="update.php">UPDATE DATA</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" action="search_ing.php" method="get">
                <input type="text" id="searchInput" onkeyup="showResult(this.value)" placeholder="Search...">
                <input type="hidden" id="currentPage" value="current_page_name"> <!-- Add this line -->
                <div id="livesearch"></div>
            </form>

        <script src="../script2.js"></script>

        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
               id="dropdownUser1"
               data-bs-toggle="dropdown" aria-expanded="false">
                <img src="images/<?php if (isset($_SESSION['img'])) {
                    echo htmlspecialchars($_SESSION['img']);
                } ?>" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong><?php if (isset($_SESSION['user_name'])) {
                        echo $_SESSION['user_name'];
                    } ?></strong>
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
        <!-- Display error message if present -->
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php } ?>
        <!-- Display success message if present -->
        <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo htmlspecialchars($_GET['success']); ?></p>
        <?php } ?>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Category</th>
            <th scope="col">Handle</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $rowNumber = 1;
        while ($row = $result->fetch_assoc()) {
            $category = htmlspecialchars($row['categories']);
            $id = htmlspecialchars($row['receipt_id']);
            echo '<tr>';
            echo '<th scope="row">' . $rowNumber . '</th>';
            echo '<td contenteditable="true">' . $category . '</td>';
            echo '<td>
                    <form class="action-form" action="update_check.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="' . $id . '">
                        <input type="hidden" name="category" value="' . $category . '">
                        <button type="submit" name="action" value="update" class="btn btn-warning">Update</button>
                        <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
                    </form>
                  </td>';
            echo '</tr>';
            $rowNumber++;
        }
        ?>
        </tbody>
    </table>
    
</main>
</div>
<div class="container">
    <main class="cont_2">
        <table class="table table-striped">
            <thead>
                <small class="small_print">(Only ingredients that are not on the receipt can be deleted.<br> In this case, the recipe must be deleted first.)</small>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ingredient</th>
                <th scope="col">Handle</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $rowNumber = 1;
            while ($row2 = $result2->fetch_assoc()) {
                $ingredient = htmlspecialchars($row2['name']);
                $id = htmlspecialchars($row2['ingrediens_id']);
                echo '<tr>';
                echo '<th scope="row">' . $rowNumber . '</th>';
                echo '<td contenteditable="true">' . $ingredient . '</td>';
                echo '<td>
                        <form class="action-form" action="update2_check.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="' . $id . '">
                            <input type="hidden" name="ingrediens" value="' . $ingredient . '">
                            <button type="submit" name="action" value="update_ingrediens" class="btn btn-warning">Update</button>
                            <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
                        </form>
                      </td>';
                echo '</tr>';
                $rowNumber++;
            }
            ?>
            </tbody>
        </table>
    </main>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('.action-form');
        forms.forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(form);
                const action = form.querySelector('button[type="submit"]:focus').value;
                const id = form.querySelector('input[name="id"]').value;
                let data = `id=${id}&action=${action}`;
                const editableCell = form.closest('tr').querySelector('[contenteditable="true"]');

                if (action === 'update') {
                    const newValue = editableCell.innerText.trim();
                    data += `&category=${encodeURIComponent(newValue)}`;
                } else if (action === 'update_ingrediens') {
                    const newValue = editableCell.innerText.trim();
                    data += `&ingrediens=${encodeURIComponent(newValue)}`;
                }

                const url = form.getAttribute('action');

                const xhr = new XMLHttpRequest();
                xhr.open('POST', url);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        try {
                            const response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                alert(response.message);
                                if (action === 'delete') {
                                    window.location.reload(); // Oldal frissítése törlés után
                                }
                            } else {
                                alert('Operation failed: ' + response.message);
                            }
                        } catch (error) {
                            console.error('JSON parsing error:', error);
                            alert('Error: Invalid JSON response');
                        }
                    } else {
                        alert('Request failed. Status: ' + xhr.status);
                    }
                };
                xhr.onerror = function() {
                    alert('Request failed. Please try again later.');
                };
                xhr.send(data);
            });
        });
    });
</script>
</body>
</html>