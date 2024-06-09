<?php
// header('Access-Control-Allow-Methods: POST, GET');
// header('Access-Control-Allow-Headers: Content-type');
// header('Access-Control-Allow-Origin: http://localhost:3000');
// header('Content-Type: application/json');

// require_once ('db.php');

// // Получение данных POST

// $req = json_decode(file_get_contents('php://input'), true);
// $do = $req["do"];

// // $card_name = $req['card_name'];
// // $card_text = $req['card_text'];
// // $color = $req['color'];

// // $response = [
// //     'success' => true,
// //     'user_found' => true,
// // ];

// if ($do == 'createAndReturnCol') {
//     $response = createAndReturnCol($req['data']);
//     json_encode($response);

// } else if ($coloumn_name == 'delcol') {
//     $sql = "DELETE FROM  `coloumn` WHERE `column_id` = ";
//     json_encode($response);

// }
// function createAndReturnCol($data)
// {
//     $user_id = $data['user_id'];

//     $sql = "INSERT INTO `coloumn` (user_id, coloumn_name, color) VALUES ($user_id, $coloumn_name, $color)";
//     return "SELECT * FROM Column WHERE col_id=id";
// }

// // Выполняем запрос
// $result = $conn->query($sql);

// // Проверяем результат запроса
// if ($result === TRUE) {
//     // Запрос выполнен успешно
//     $response['message'] = 'Название колонки успешно добавлено.';
// } else {
//     // Произошла ошибка при выполнении запроса
//     $response['success'] = false;
//     $response['error'] = 'Ошибка: ' . $conn->error;
// }





// if ($coloumn_name == 'createAndReturnCard') {
//     $response = createAndReturnCard($req['data']);
//     json_encode($response);

// } else if ($coloumn_name == 'delcol') {
//     $sql = "DELETE  FROM  `card` VALUES ($card_name)";


// }
// function createAndReturnCard($data)
// {
//     $user_id = $data['user_id'];
//     $sql = "INSERT INTO `card` (user_id, name, color) value ($user_id, $name, $color)";
//     return "SELECT * FROM Card WHERE card_id=id";
// }

// // Выполняем запрос
// $result = $conn->query($sql);

// // Проверяем результат запроса
// if ($result === TRUE) {
//     // Запрос выполнен успешно
//     $response['message'] = 'Название карты успешно добавлено.';
// } else {
//     // Произошла ошибка при выполнении запроса
//     $response['success'] = false;
//     $response['error'] = 'Ошибка: ' . $conn->error;
// }

// if ($coloumn_name == 'createAndReturnColor') {
//     $response = createAndReturnColor($req['data']);
//     json_encode($response);

// } else if ($coloumn_name == 'delcol') {
//     $sql = "DELETE FROM  `card` VALUES ($card_name)";


// }
// function createAndReturnColor($data)
// {
//     $user_id = $data['user_id'];
//     $sql = "INSERT INTO `color` (user_id, color_name, card_name) value ($user_id, $color_card, $card_column)";
//     return "SELECT * FROM Card WHERE card_id=id";
// }

// // Выполняем запрос
// $result = $conn->query($sql);

// // Проверяем результат запроса
// if ($result === TRUE) {
//     // Запрос выполнен успешно
//     $response['message'] = 'Название карты успешно добавлено.';
// } else {
//     // Произошла ошибка при выполнении запроса
//     $response['success'] = false;
//     $response['error'] = 'Ошибка: ' . $conn->error;
// }

// echo json_encode($response);



?>