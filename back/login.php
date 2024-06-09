<?php
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-type');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Content-Type: application/json');

// Подключение к БД
require_once ('db.php');

// Получение данных POST
$data = json_decode(file_get_contents('php://input'), true);
$login = $data['login'];
$pass = $data['password'];

$response = [
    'success' => true,
    'user_found' => true,
];

if (empty($login) || empty($pass)) {
    $response['success'] = false;
    $error = (empty($login)) ? 'login' : 'password';
    $response['empty_data'] = $error;
} else {
    $sql = "SELECT * FROM `users` WHERE login = '$login' AND pass = '$pass' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response['login'] = $row['login'];
        $response['user_id'] = $row['user_id']; // Добавлено возвращение user_id
    } else {
        // "Нет такого пользователя";
        $response['success'] = false;
        $response['user_found'] = false;
    }
}

// Возвращаем ответ в формате JSON
echo json_encode($response);

// Возвращаем ошибку, если запрос не был POST
// http_response_code(405); // Метод не разрешен
// echo json_encode(['error' => 'Метод не разрешен']);

?>
