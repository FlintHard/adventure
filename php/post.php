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

// Проверка, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы и экранирование специальных символов
    $username = trim($_POST['username']);
    $comment = trim($_POST['comment']);

    // Проверка на корректность всех данных
    if (empty($username) || empty($comment)) {
        die(json_encode(['error' => 'Все поля обязательны для заполнения.']));
    }

    // Подготовленный запрос для вставки данных в базу
    $sql = "INSERT INTO reviews (username, comment) VALUES (:username, :comment)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':comment' => $comment
        ]);

        // Получение всех имеющихся отзывов из базы данных
        $sqlSelect = "SELECT * FROM reviews ORDER BY id DESC"; // При неорбходимости, изменить ORDER BY на нужное поле
        $stmtSelect = $pdo->prepare($sqlSelect);
        $stmtSelect->execute();
        $reviews = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);

        // Возвращаем JSON с отзывами
        header('Content-Type: application/json');
        echo json_encode($reviews);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Ошибка: ' . $e->getMessage()]);
    }
}
?>
