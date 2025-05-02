<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "RegisterUsers";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка подключения
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    } else {
        echo "Успешное подключение!";
    }
?>
