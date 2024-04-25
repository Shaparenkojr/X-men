<?php

require_once('db.php');

$login = $_POST['login'];
$pass = $_POST['pass'];

if(empty($login) || empty($pass))
{
    echo "Заполните все поля";
} else {
    $sql = "SELECT * FROM `users` WHERE login = '$login' AND pass = '$pass' ";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0)
    {
        // while ($row = $result->fetch_assoc()){
            $row = $result->fetch_assoc();
            echo "Добро пожаловать ". $row['login'];
            // }
        } else {
            echo "Нет такого пользователя";
        }
    }
    
    
    // В данном примере просто возвращаем успешный ответ в формате JSON
$response = [
    'success' => true,
    'message' => 'Вход выполнен успешно!',
    'userData' => [
        'login' => $login
        ]
    ];
    $data = json_decode(file_get_contents('php://input'), true);
    print_r($data);
    // Возвращаем ответ в формате JSON
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    echo json_encode($data);
    
    // Возвращаем ошибку, если запрос не был POST
    http_response_code(405); // Метод не разрешен
    echo json_encode(['error' => 'Метод не разрешен']);
    
?>