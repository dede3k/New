<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST["name"]);
        $surname = htmlspecialchars($_POST["surname"]);
        $email = htmlspecialchars($_POST["email"]);
        $message = htmlspecialchars($_POST["message"]);

        // Логика обработки данных (например, запись в базу данных)
        echo "<h2>Форма успешно отправлена!</h2>";
        echo "<p><strong>Аты:</strong> $name</p>";
        echo "<p><strong>Жөні:</strong> $surname</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Хабар:</strong> $message</p>";

        // Можно добавить отправку email с помощью mail()
    }
?>