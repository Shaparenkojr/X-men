<?php
header('Content-Type: application/json');
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$title = $data['title'];

$conn = getDB();
$sql = "UPDATE columns SET title = '$title' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => $conn->error]);
}

$conn->close();
?>