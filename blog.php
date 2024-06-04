<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Блог</title>    
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
    <img src="img/logo_light.svg" alt="">    
    <p class="title_page">блог</p>
    
    <div class="blog_container">
        <?php
        // Подключение к базе данных
        include 'config.php';
        // Запрос на получение записей блога с сортировкой по убыванию даты
        $sql = "SELECT Title, PostDate, Content FROM BlogPosts ORDER BY PostDate DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Вывод данных каждой строки
            while($row = $result->fetch_assoc()) {
                echo '<div class="blog_block">';
                echo '<p class="title_blog">' . htmlspecialchars($row['Title']) . '</p>';
                echo '<p class="date_blog">' . htmlspecialchars($row['PostDate']) . '</p>';
                echo '<hr class="blog_hr">';
                echo '<p class="blog_content">' . nl2br(htmlspecialchars($row['Content'])) . '</p>';
                echo '</div>';
            }
        } else {
            echo "постов пока нет";
        }
        $conn->close();
        ?>
    </div>
</div>
</body>
</html>
