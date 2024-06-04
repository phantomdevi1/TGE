<?php
session_start();

include 'config.php';

function isAuthenticated() {
    return isset($_SESSION['UserID']);
}


if (!isAuthenticated()) {
    header("Location: auth.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
<header>
        <div class="toolbar">
            <a href="product.php">продукция</a>
            <a href="about_me.php">о нас</a>
            <a href="index.php">главная</a>
            <a href="contacts.php">контакты</a>
            <a href="blog.php">блог</a>
            <a href="profile.php">аккаунт</a>
        </div>
    </header>
<div class="content">
    <img src="img/logo_light.svg" alt="Logo">    
    <p class="title_page">Оформление заказа</p>
    <?php
        $product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

        if ($product_id > 0) {

            $sql = "SELECT ProductID, ImagePath, Name, Description FROM Products WHERE ProductID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
            $stmt->close();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user_id = $_SESSION['UserID'];
            $product_id = $_POST['product_id'];
            $quantity = intval($_POST['quantity']);

            $sql = "INSERT INTO Orders (UserID, ProductID, Quantity, OrderDate, OrderStatus) VALUES (?, ?, ?, NOW(), 'в обработке')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iii", $user_id, $product_id, $quantity);

            if ($stmt->execute()) {
                echo "<p class='order_true'>Заказ успешно оформлен!</p>";
            } else {
                echo "Ой-ой, что-то пошло не так...";
            }

            $stmt->close();
        }

        $conn->close();
        ?>

    <?php if (isset($product)): ?>
        <div class="product_details">
            <h2><?php echo htmlspecialchars($product['Name']); ?></h2>
            <img class="order_img" src="<?php echo htmlspecialchars($product['ImagePath']); ?>" alt="Product Image">            
            <p class="order_description"><?php echo nl2br(htmlspecialchars($product['Description'])); ?></p>
            <form class="order_form" action="" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['ProductID']; ?>">
                <label for="quantity">Количество:</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1" required>
                <button type="submit">Оформить заказ</button>
            </form>
        </div>
    <?php else: ?>
        <p>Продукт не найден.</p>
    <?php endif; ?>
</div>
</body>
</html>
