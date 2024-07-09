<?php
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-type');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Content-Type: application/json');
// delete_column.php

require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);
$column_id = $data['id'];

$conn = getDB();
$sql = "DELETE FROM columns WHERE id = $column_id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => $conn->error]);
}

$conn->close();
?>