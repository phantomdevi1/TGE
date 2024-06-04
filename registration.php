<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
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
    <div class="auth_block">
        <p class="auth_title">Регистрация</p>
        <form action="" method="post" class="auth_form">
        <?php
            include 'config.php'; // Подключение к базе данных

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
                $username = $_POST['username'] ?? '';
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';

                if (empty($username) || empty($email) || empty($password)) {
                    echo "<p class='error'>Пожалуйста, заполните все поля.</p>";
                } else {
                    // Проверяем, существует ли пользователь с таким именем или почтой
                    $check_sql = "SELECT UserID FROM Users WHERE Username = ? OR Email = ?";
                    $check_stmt = $conn->prepare($check_sql);
                    $check_stmt->bind_param("ss", $username, $email);
                    $check_stmt->execute();
                    $check_stmt->store_result();

                    if ($check_stmt->num_rows > 0) {
                        echo "<p class='error'>Пользователь с таким логином или почтой уже существует.</p>";
                    } else {
                        // Добавляем пользователя в базу данных
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $insert_sql = "INSERT INTO Users (Username, Password, Email, isAdmin) VALUES (?, ?, ?, 0)";
                        $insert_stmt = $conn->prepare($insert_sql);
                        $insert_stmt->bind_param("sss", $username, $hashed_password, $email);

                        if ($insert_stmt->execute()) {
                            echo "<p class='success'>Регистрация прошла успешно.</p>";
                        } else {
                            echo "<p class='error'>Ошибка при регистрации.</p>";
                        }
                        $check_stmt->close();
                        $insert_stmt->close();
                    }
                    
                }
            }
        ?>


            <input class="auth_input_login" type="text" name="username" placeholder="Логин">
            <input class="auth_input_login" type="email" name="email" placeholder="Почта">
            <input class="auth_input_password" type="password" name="password" placeholder="Пароль">
            <input class="auth_btn" type="submit" name="register" value="Зарегистрироваться">
            <a href="auth.php" class="registr_href">Войти</a>
        </form>
    </div>
</div>

</body>
</html>
