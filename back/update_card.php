<?php
header('

Content-Type: application/json');
require 'db.php';

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$title = $data['title'];
$description = $data['description'];

$conn = getDB();
$sql = "UPDATE cards SET title = '$title', description = '$description' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => $conn->error]);
}

$conn->close();
?>