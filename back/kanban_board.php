<?php
function get_connection()
{
    $severname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kanban_board";
    $conn = new PDO($severname, $username, $password, $dbname);
    return $conn;
}

function save_task($type, $task, $id)
{
    $conn = get_connection();
    if ($id) {
        $sql = "UPDATE kaban_board SET `task`=? WHERE id=?"; // create sql
        $query = $conn->prepare($sql); // prepare
        $query->execute([$task, $id]); // execute
        return $id;
    } else {
        $sql = "INSERT INTO kaban_board(`task`,`type`) VALUES (?,?)"; // create sql
        $query = $conn->prepare($sql); // prepare
        $query->execute([$task, $type]); // execute
        return $conn->lastInsertId();
    }
}