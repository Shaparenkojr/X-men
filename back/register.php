<?php
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-type');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Content-Type: application/json');

require_once('db.php');
$conn = getDB();

// Получаем данные из запроса
$data = json_decode(file_get_contents('php://input'), true);

// Логируем полученные данные для отладки
error_log('Received registration data: ' . print_r($data, true));

// Извлекаем данные
$login = isset($data['login']) ? $data['login'] : '';
$password = isset($data['password']) ? $data['password'] : '';
$email = isset($data['email']) ? $data['email'] : '';

// Подготавливаем ответ
$response = [
    'success' => false,
    'user_registr' => false,
];

if (empty($login) || empty($password) || empty($email)) {
    $response['error'] = 'Необходимо заполнить все поля';
} else {
    // Формируем SQL-запрос с использованием подготовленных выражений
    $sql = "INSERT INTO `users` (login, pass, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        $response['error'] = "Ошибка подготовки SQL-запроса: " . $conn->error;
    } else {
        $stmt->bind_param("sss", $login, $password, $email);
        $result = $stmt->execute();

        if ($result) {
            $response['success'] = true;
            $response['user_registr'] = true;
            $response['message'] = 'Пользователь успешно добавлен.';
        } else {
            $response['error'] = 'Ошибка: ' . $stmt->error;
        }

        $stmt->close();
    }
}

// Возвращаем ответ в формате JSON
echo json_encode($response);
error_log(print_r($response, true)); // Логирование ответа для отладки

$conn->close();
?>
