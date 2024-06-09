<?php
header('Content-Type: application/json');
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

$description = $data['description'];
$color = $data['color'];
$column_id = $data['column_id'];

$conn = getDB();
$sql = "INSERT INTO cards (description, color, column_id) VALUES ('$description', '$color', $column_id)";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["id" => $conn->insert_id, "success" => true]);
} else {
    echo json_encode(["error" => $conn->error]);
}

$conn->close();
?>