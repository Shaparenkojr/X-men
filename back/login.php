<?php
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-type');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Content-Type: application/json');

// Подключение к БД
require_once ('db.php');
$conn = getDB();

// Получение данных POST
$data = json_decode(file_get_contents('php://input'), true);
$login = isset($data['login']) ? $data['login'] : '';
$pass = isset($data['password']) ? $data['password'] : '';

$response = [
    'success' => true,
    'user_found' => true,
];

if (empty($login) || empty($pass)) {
    $response['success'] = false;
    $error = (empty($login)) ? 'login' : 'password';
    $response['empty_data'] = $error;
} else {
    $sql = "SELECT * FROM `users` WHERE login = ? AND pass = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $login, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response['login'] = $row['login'];
        $response['user_id'] = (int)$row['user_id']; // Приводим к целочисленному типу
        $response['success'] = true;
        $response['user_found'] = true;
    } else {
        $response['success'] = false;
        $response['user_found'] = false;
        $response['error'] = "Неверные учетные данные";
    }
    
    // Если нужно отправить user_id, добавляем его в ответ
    if ($response['success']) {
        $response['user_id'] = (int)$row['user_id'];
    }

    $stmt->close();
}

echo json_encode($response);

$conn->close();
?>
