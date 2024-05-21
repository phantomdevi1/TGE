

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
        <a href="order.php">заказы</a>
        <a href="blog_admin.php">блог</a>
        <a href="product_admin.html">продукция</a>
        <a href="profile_admin.php">аккаунт</a>
    </div>
</header>
<div class="content">
    <img src="img/logo_light.svg" alt="">    
    <p class="title_page">добавить блог</p>
    <div class="content_blog">
    <?php
        session_start();

        include 'config.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['title']) && isset($_POST['date']) && isset($_POST['content'])) {
                $title = $_POST['title'];
                $date = $_POST['date'];
                $content = $_POST['content'];

                // Проверка на пустые поля
                if (empty($title) || empty($date) || empty($content)) {
                    echo "<p class='error'>Пожалуйста, заполните все поля.</p>";
                } else {
                    // Добавление в базу данных
                    $sql = "INSERT INTO BlogPosts (Title, PostDate, Content, CreatedAt) VALUES (?, ?, ?, NOW())";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $title, $date, $content);
                    
                    if ($stmt->execute()) {
                        echo "<p class='blog_success'>Пост успешно опубликован.</p>";
                    } else {
                        echo "<p class='blog_error'>Ошибка при добавлении в базу данных: </p>";
                    }

                    $stmt->close();
                }
            }
        }
    ?>
        <form method="post" class="new_blog_form">
            <input type="text" name="title" placeholder="Заголовок" required class="title_blog_input">
            <input type="date" name="date" required class="date_blog_input">
            <textarea name="content" placeholder="Содержание" required class="blog_textarea"></textarea>
            <input type="submit" value="Опубликовать" class="push_new_blog">
        </form>
    </div>
</div>
</body>
</html>
