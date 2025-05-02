<?php
session_start(); // Сессия должна начинаться до любого вывода

require_once('db.php');

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "RegisterUsers";

// Подключение к БД
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    exit("Ошибка подключения: " . $conn->connect_error);
}

// Получаем данные и убираем пробелы
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// Проверяем ввод
if (empty($email) || empty($password)) {
    exit("Қате: Барлық өрістерді толтырыңыз!");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Қате: Почта дұрыс емес!");
}

// Проверка почты в базе
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    exit("Ошибка подготовки запроса: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user || !isset($user['password'])) {
    exit("Қате: Пайдаланушы табылмады!");
}

// Проверка пароля
if (password_verify($password, $user['password'])) {
    $_SESSION['username'] = $user['username'];

    // Перенаправление после успешного входа
    header("Location: dashboard.php");
    exit();
} else {
    echo "Қате: Почта немесе құпия сөз дұрыс емес!";
}

// Закрытие соединения
$stmt->close();
$conn->close();
?>