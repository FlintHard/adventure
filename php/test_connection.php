<?php
// Настройки подключения к базе данных
$dsn = "mysql:host=localhost;dbname=adventure_guide;charset=utf8";
$username = "root"; // Замените на ваше имя пользователя
$password = ""; // Замените на ваш пароль

try {
    // Попытка подключения к базе данных
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Если подключение прошло успешно
    echo "Подключение к базе данных успешно!";
} catch (PDOException $e) {
    // Если возникла ошибка при подключении
    echo "Ошибка подключения: " . $e->getMessage();
}
?>
