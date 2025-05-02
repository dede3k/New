<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $to = "websiteadilzhan@gmail.com"; // Укажи свой email
    $subject = "Новое сообщение от пользователя";
    $body = "Имя: $firstname\nФамилия: $lastname\nEmail: $email\nСообщение:\n$message";

    if (mail($to, $subject, $body)) {
        echo "Сообщение отправлено!";
    } else {
        echo "Ошибка отправки!";
    }
}
?>