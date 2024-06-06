<?php
// Including the database connection file
require "db_conn.php";

// Checking if the 'q' parameter is set in the URL and not empty
if (isset($_GET['q']) && !empty($_GET['q'])) {
    // Getting the search input from the URL
    $searchInput = $_GET['q'];
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 'default_page';

    // Query to search for ingredients with names similar to the search input
    $sql = "SELECT * FROM receipt WHERE food_name LIKE ?";
    $stmt = $conn->prepare($sql);

    // Preparing the statement and executing it
    if ($stmt) {
        $search = "%" . $searchInput . "%";
        $stmt->bind_param("s", $search);
        $stmt->execute();

        // Getting the result set
        $result = $stmt->get_result();

        // Checking if there are any matching results
        if ($result->num_rows > 0) {
            // Looping through the results
            while ($row = $result->fetch_assoc()) {
                $food = $row['food_name'];
                
                // Query to get the receipt ID for the current food name
                $sql2 = "SELECT receipt_id FROM receipt WHERE food_name=?";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->bind_param("s", $food);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                $row2 = $result2->fetch_assoc();
                $receipt_id = $row2['receipt_id'];

                // Constructing the URL based on the current page
                $url = '';
                switch ($currentPage) {
                    case 'index':
                        $url = 'index.php';
                        break;
                    case 'sign_up':
                        $url = 'sign_up.php';
                        break;
                    case 'receipt_edit':
                        $url = 'receipt_edit.php';
                        break;
                    case 'rec':
                        $url = 'rec.php';
                        break;
                    case 'rec_food':
                        $url = 'rec_food.php';
                        break;
                    case 'rec_add':
                        $url = 'rec_add.php';
                        break; 
                    case 'profile':
                        $url = 'profile.php';
                        break;   
                    case 'fridge':
                        $url = 'fridge.php';
                        break; 
                    case 'adm':
                        $url = 'adm.php';
                        break; 
                    default:
                        $url = 'rec_food.php';
                        break;
                }

                // Displaying the search results with hyperlinks to the corresponding recipe pages
                echo "<a href='" . $url . "?receipt_id=" . $receipt_id . "'>" . $row["food_name"] . "</a><br>";
            }
        } else {
            // If no matching results found
            echo "No results found";
        }
    } else {
        // Error message if there was an issue preparing the query
        echo "An error occurred while preparing the query";
    }
} else {
    // If no search value is provided
    echo "No search value received";
}
?>
