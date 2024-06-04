<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказы</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
<header>
    <div class="toolbar">
        <a href="product.php">продукция</a>
        <a href="about_me.html">о нас</a>
        <a href="index.html">главная</a>
        <a href="contacts.php">контакты</a>
        <a href="blog.php">блог</a>
        <a href="profile.php">аккаунт</a>
    </div>
</header>

<div class="content">
    <img src="img/logo_light.svg" alt="">    
    <p class="title_page">мои заказы</p>

<?php
session_start();

if (!isset($_SESSION['UserID'])) {
    header("Location: auth.php");
    exit();
}

include 'config.php';

$userID = $_SESSION['UserID'];

$sqlOrders = "
    SELECT Orders.OrderID, Products.Name AS ProductName, Orders.Quantity, Orders.OrderDate, Orders.OrderStatus
    FROM Orders
    JOIN Products ON Orders.ProductID = Products.ProductID
    WHERE Orders.UserID = ?
    ORDER BY Orders.OrderDate DESC
";

$stmt = $conn->prepare($sqlOrders);
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<div class='orders_list'>";
    echo "<table>";
    echo "<tr><th>Код</th><th>Продукт</th><th>Количество</th><th>Дата заказа</th><th>Статус</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['OrderID']) . "</td>";
        echo "<td>" . htmlspecialchars($row['ProductName']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Quantity']) . "</td>";
        echo "<td>" . htmlspecialchars($row['OrderDate']) . "</td>";
        echo "<td>" . htmlspecialchars($row['OrderStatus']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "<p>У вас нет заказов.</p>";
}

$stmt->close();
$conn->close();
?>
</div>

</body>
</html>
