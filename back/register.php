<?php
require_once('db.php');
$email = $_POST['email'];
$login = $_POST['login'];
$pass = $_POST['pass'];

if (empty($email)  || empty($login) || empty($pass)){
    echo "Заполните все поля";
}  else{
    
    $sql = "INSERT INTO `users` (email, login, pass) VALUES ('$email', '$login', '$pass')";
    if ($conn -> query($sql) === TRUE) {
        echo "Успешная регистрация";
    }
    else{
        echo "Ошибка". $conn -> error;
    }



}
