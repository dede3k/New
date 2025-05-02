<?php
    session_start();
    require_once('db.php');

    // Проверка подключения
    if (!$conn) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    // Получение данных
    $login = trim($_POST['username'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password'] ?? '');
    $repeat_password = trim($_POST['repeat_password'] ?? '');

    // Проверяем переданные данные
    var_dump($login, $email, $password, $repeat_password);

    // Проверка, что поля не пустые
    if (empty($login) || empty($email) || empty($password) || empty($repeat_password)) {
        die("Ошибка: Все поля должны быть заполнены.");
    }

    // Проверка email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Ошибка: Неверный формат email.");
    }

    // Проверка совпадения паролей
    if ($password !== $repeat_password) {
        die("Ошибка: Пароли не совпадают!");
    }

    // Проверка существования email
    $check_email_query = "SELECT id FROM users WHERE email = ?";
    $stmt_check = $conn->prepare($check_email_query);
    if ($stmt_check) {
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();
        if ($result_check->num_rows > 0) {
            die("Ошибка: Пользователь с таким email уже существует!");
        }
        $stmt_check->close();
    } else {
        die("Ошибка подготовки запроса: " . $conn->error);
    }

    // Хеширование пароля
    $hashed_pass = password_hash($password, PASSWORD_BCRYPT);

    // Вставка данных в базу
    $sql = "INSERT INTO users (login, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sss", $login, $hashed_pass, $email);

        if ($stmt->execute()) {
            echo "Пользователь успешно зарегистрирован!";
        } else {
            echo "Ошибка при регистрации: " . $stmt->error;
        }

        $stmt->close();
    } else {
        die("Ошибка подготовки запроса: " . $conn->error);
    }

    // Закрытие соединения
    $conn->close();
?>