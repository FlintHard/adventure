<?php
// Подключение к базе данных
$dsn = "mysql:host=localhost;dbname=adventure_guide;charset=utf8"; 
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Получение всех отзывов из базы данных
$sql = "SELECT username, comment FROM reviews ORDER BY id DESC"; // Сортировка по id, чтобы новые отзывы отображались первыми
$stmt = $pdo->query($sql);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Возвращаем отзывы в формате JSON
header('Content-Type: application/json');
echo json_encode($reviews);
?>
