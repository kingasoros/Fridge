<?php

include "db_conn.php";

// SQL query to select ingredient names.
$sql = "SELECT name FROM ingrediens";
$result = mysqli_query($conn, $sql);

// Checks if there are results.
if (mysqli_num_rows($result) > 0) {
    $ingredients = array(); // Initializes an array to store ingredient names.

    // Loops through the results and adds ingredient names to the array.
    while ($row = mysqli_fetch_assoc($result)) {
        $ingredients[] = $row['name'];
    }

    // Outputs JSON encoded array of ingredient names.
    echo json_encode($ingredients);
} else {
    // Outputs an empty JSON array if no ingredients are found.
    echo json_encode([]);
}

// Closes the database connection.
mysqli_close($conn);
?>

