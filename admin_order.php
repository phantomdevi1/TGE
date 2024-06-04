<?php
session_start();

if (!isset($_SESSION['UserID'])) {
    header("Location: auth.php");
    exit();
}

include 'config.php';

$sqlOrders = "
    SELECT Orders.OrderID, Orders.ProductID, Products.Name AS ProductName, Orders.Quantity, Orders.OrderDate, Orders.OrderStatus
    FROM Orders
    JOIN Products ON Orders.ProductID = Products.ProductID
    ORDER BY Orders.OrderDate DESC
";

$result = $conn->query($sqlOrders);

?>

<!DOCTYPE html>
<html lang="en">
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
        <a href="admin_order.php">заказы</a>
        <a href="blog_admin.php">блог</a>
        <a href="product_admin.php">продукция</a>
        <a href="callback_admin.php">заявки</a>
        <a href="profile_admin.php">аккаунт</a>
    </div>
</header>

<div class="content">
    <img src="img/logo_light.svg" alt="">    
    <p class="title_page">заказы</p>

<?php if ($result->num_rows > 0): ?>
    <div class='orders_list'>
        <table>
            <tr><th>Код</th><th>Название товара</th><th>Количество</th><th>Дата заказа</th><th>Статус</th></tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['OrderID']); ?></td>
                    <td><?php echo htmlspecialchars($row['ProductName']); ?></td>
                    <td><?php echo htmlspecialchars($row['Quantity']); ?></td>
                    <td><?php echo htmlspecialchars($row['OrderDate']); ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($row['OrderID']); ?>">
                            <select name="order_status">
                                <option value="в обработке" <?php echo ($row['OrderStatus'] == 'в обработке') ? 'selected' : ''; ?>>в обработке</option>
                                <option value="отказ" <?php echo ($row['OrderStatus'] == 'отказ') ? 'selected' : ''; ?>>отказ</option>
                                <option value="в пути" <?php echo ($row['OrderStatus'] == 'в пути') ? 'selected' : ''; ?>>в пути</option>
                                <option value="доставлен" <?php echo ($row['OrderStatus'] == 'доставлен') ? 'selected' : ''; ?>>доставлен</option>
                                <option value="выдан" <?php echo ($row['OrderStatus'] == 'выдан') ? 'selected' : ''; ?>>выдан</option>
                            </select>
                            <button type="submit">Сохранить</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
<?php else: ?>
    <p>У вас нет заказов.</p>
<?php endif; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $sqlUpdate = "UPDATE Orders SET OrderStatus = ? WHERE OrderID = ?";
    $stmt = $conn->prepare($sqlUpdate);
    $stmt->bind_param("si", $order_status, $order_id);
    $stmt->execute();
    $stmt->close();

    // Redirect to prevent form resubmission on page refresh
    header("Location: admin_order.php");
    exit();
}

$conn->close();
?>
</div>

</body>
</html>
