<?php
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-type');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Content-Type: application/json');

require_once ('db.php');

$data = json_decode(file_get_contents('php://input'), true);

$login = $data['login'];
$password = $data['password'];
$email = $data['email'];

$response = [
    'success' => true,
    'user_found' => true,
];

if (empty($login) || empty($password) || empty($email)) {
    $response['success'] = false;
    $response['error'] = 'empty_data';
} else {

    $sql = "INSERT INTO users (login, pass, email) VALUES ('$login', '$password', '$email')";

    if ($conn->query($sql) === TRUE) {
        $response["message"] = "Успешная регистрация";
    } else {
        $response['success'] = false;
        $response["message"] = "Ошибка: " . $conn->error;
    }
}

// Возвращаем ответ в формате JSON
echo json_encode($response);