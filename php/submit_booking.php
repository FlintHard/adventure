<?php
// Параметры подключения к базе данных
$dsn = "mysql:host=localhost;dbname=adventure_guide;charset=utf8"; 
$username = "root";
$password = "";

// Создаем соединение с БД
try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $tour = htmlspecialchars(trim($_POST["tour"]));

    // Проверка данных перед выполнением запроса
    if (empty($name) || empty($email) || empty($tour)) {
        die("Ошибка: Все поля должны быть заполнены.");
    }

    // Подготовка и выполнение SQL-запроса
    $stmt = $conn->prepare("INSERT INTO bookings (name, email, tour) VALUES (:name, :email, :tour)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':tour', $tour);

    try {
        $stmt->execute();
        echo "Данные успешно отправлены!";
    } catch (PDOException $e) {
        echo "Ошибка при выполнении запроса: " . $e->getMessage();
    }
}

// Закрываем соединение
$conn = null;
?>
