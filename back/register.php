<?php
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-type');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Content-Type: application/json');

require_once ('db.php');

// Получаем данные из запроса
$data = json_decode(file_get_contents('php://input'), true);

// Извлекаем данные
$login = $data['login'];
$password = $data['password'];
$email = $data['email'];

// Подготавливаем ответ
$response = [
    'success' => true,
    'user_found' => true,
];

// Формируем SQL-запрос
$sql = "INSERT INTO `users` (login, pass, email) VALUES ('$login', '$password', '$email')";

// Выполняем запрос
$result = $conn->query($sql);

// Проверяем результат запроса
if ($result === TRUE) {
    // Запрос выполнен успешно
    $response['message'] = 'Пользователь успешно добавлен.';
} else {
    // Произошла ошибка при выполнении запроса
    $response['success'] = false;
    $response['error'] = 'Ошибка: ' . $conn->error;
}

// Возвращаем ответ в формате JSON
echo json_encode($response);
?>