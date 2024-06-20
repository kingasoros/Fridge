<?php

require "db_conn.php";

if (isset($_POST['id']) && isset($_POST['rating'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id = validate($_POST['id']);
    $rate = validate($_POST['rating']);

    if (empty($id) || empty($rate)) {
        header("Location:rec.php?error=Error.");
        exit();
    } else {
     
        $sql = "SELECT rate,rate_count FROM rate WHERE receipt_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $pre_rate = $row['rate'];
            $rate_count = $row['rate_count'];

            // Calculate the new average rate
            $new_rate = ($pre_rate*$rate_count);
            $new_rate += $rate;
            $rate_count+=1;
            $new_rate/=$rate_count;

            // Update the rate in the database
            $sql_update = "UPDATE rate SET rate = ? WHERE receipt_id = ?";
            $stmt_update = mysqli_prepare($conn, $sql_update);
            mysqli_stmt_bind_param($stmt_update, "di", $new_rate, $id);
            $result_update = mysqli_stmt_execute($stmt_update);

            if (!$result_update) {
                header("Location:rec.php?error=Error.");
                exit();
            } 

            $sql_update = "UPDATE rate SET rate_count = ? WHERE receipt_id = ?";
            $stmt_update = mysqli_prepare($conn, $sql_update);
            mysqli_stmt_bind_param($stmt_update, "di", $rate_count, $id);
            $result_update = mysqli_stmt_execute($stmt_update);

            if (!$result_update) {
                header("Location:rec.php?error=Error.");
                exit();
            } 

            header("Location:rec.php?success=Success.");
                exit();
        } else {
            $sql2 = "INSERT INTO rate (receipt_id, rate) VALUES (?, ?)";
            $stmt2 = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmt2, "id", $id, $rate);
            $result2 = mysqli_stmt_execute($stmt2);

            if ($result2) {
                header("Location:rec.php?success=Success.");
                exit();
            } else {
                header("Location:rec.php?error=Error.");
                exit();
            }
        }
    }

} else {
    header("Location:rec.php?error=Unknown error occurred.");
    exit();
}
?>
