<?php
require_once __DIR__ . '/vendor/autoload.php';

use Hashemi\CsvExport\CsvExport;

require_once "db_conn.php";

$receipts_query = "SELECT `receipt_id`, `img`, `paragraph`, `price`, `food_name`, `your_name`, `time`, `servings`, `activated`, `activation_token`, `activation_expire`, `categories`, `likes`, `yt` FROM receipt";
$result = $pdo->prepare($receipts_query);
$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);

$columns = ["receipt_id", "img", "paragraph", "price", "food_name", "your_name", "time", "servings", "activated", "activation_token", "activation_expire", "categories", "likes", "yt"];
$rows_t = [];

foreach ($rows as $key => $row){
   $rows_t[$key] = array_values($row);

}

(new CsvExport($columns, $rows_t, 'receipts.csv'))->download();