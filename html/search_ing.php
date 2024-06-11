<?php
// Including the database connection file
require "db_conn.php";

// Checking if the 'q' parameter is set in the URL and not empty
if (isset($_GET['q']) && !empty($_GET['q'])) {
    // Getting the search input from the URL
    $searchInput = $_GET['q'];

    // Query to search for ingredients with names similar to the search input
    $sql = "SELECT * FROM ingrediens WHERE name LIKE ?";
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
                $food = $row['name'];
                
                // Displaying the search results with hyperlinks to the corresponding recipe pages
                echo "<a href='fridge.php?recipes_id=" . $row['ingrediens_id'] . "'>" . $row["name"] . "</a><br>";
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
