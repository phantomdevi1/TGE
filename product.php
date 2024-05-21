<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Продукция</title>    
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
    </div>
    </header>
<div class="content">
    <img src="img/logo_light.svg" alt="">    
    <p class="title_page">продукция</p>

    <div class="product_container">
    <?php
            include 'config.php';

            // Запрос на получение данных о продуктах
            $sql = "SELECT ProductID, ImagePath, Name, Description FROM Products";
            $result = $conn->query($sql);

            // Проверка наличия результатов
            if ($result->num_rows > 0) {
                // Вывод данных каждой строки
                while($row = $result->fetch_assoc()) {
                    echo '<div class="product_card">';
                    echo '<p class="product_title">' . htmlspecialchars($row['Name']) . '</p>';
                    echo '<hr class="product_hr">';
                    echo '<div class="product_text-container">';
                    echo '<img class="img_product" src="' . htmlspecialchars($row['ImagePath']) . '" alt="">';
                    echo '<p class="product_content">' . nl2br(htmlspecialchars($row['Description'])) . '</p>';
                    echo '</div>';
                    echo '<hr class="product_hr">';
                    echo ' <a class="buy_now-btn" href="contacts.php#callback">купить'. " " . htmlspecialchars($row['Name']) . '</a>';
                    echo '</div>';
                }
            } else {
                echo "продукции пока не добвалено";
            }
            $conn->close();
            ?>

    </div>
</div>
</body>
</html>