<?php 
// create_column.php 
header('Access-Control-Allow-Methods: POST, GET'); 
header('Access-Control-Allow-Headers: Content-type'); 
header('Access-Control-Allow-Origin: http://localhost:3000'); 
header('Content-Type: application/json'); 
 
require 'db.php'; 
 
$data = json_decode(file_get_contents('php://input'), true); 
 
$title = $data['column_name']; 
// $user_id = $data['user_id'];
$color = json_encode(['#d9d9d9', '#d9d9d9', '#d9d9d9']); 
 
$conn = getDB(); 
$sql = "INSERT INTO `column` ( user_id, column_name, color) VALUES ('$title', '$color')"; 
 
if ($conn->query($sql) === TRUE) { 
    echo json_encode(["id" => $conn->insert_id]); 
} else { 
    echo json_encode(["error" => $conn->error]); 
} 
 
$conn->close(); 
?>