<?php
$severname = "localhost";
$username = "root";
$password = "";
$dbname = "registerUser";

$conn = mysqli_connect($server, $username, $password, $dbname);

if (!$conn) {
    die("Ошибка: " . mysqli_connect_error());
} else {
    echo "Подключение успешно установлено";
}
// mysqli_close($conn);
?>
