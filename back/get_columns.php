<?php
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-type');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Content-Type: application/json');
// get_columns.php

require 'db.php';

$conn = getDB();
$sql = "SELECT * FROM columns";
$result = $conn->query($sql);

$columns = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $column_id = $row['id'];
        $sql_cards = "SELECT * FROM card WHERE column_id = $column_id";
        $result_cards = $conn->query($sql_cards);

        $cards = [];
        if ($result_cards->num_rows > 0) {
            while($card_row = $result_cards->fetch_assoc()) {
                $cards[] = $card_row;
            }
        }

        $row['cards'] = $cards;
        $columns[] = $row;
    }
}

echo json_encode($columns);
$conn->close();
?>