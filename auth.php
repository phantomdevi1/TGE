<?php
session_start();

include 'config.php'; // Подключение к базе данных

$auth_error = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT UserID, Password, isAdmin FROM Users WHERE Username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Сравнение введенного пароля с хешированным паролем из базы данных
        if (password_verify($password, $row['Password'])) {
            $_SESSION['UserID'] = $row['UserID']; 
            if ($row['isAdmin']) {
                header("Location: profile_admin.php");
            } else {
                header("Location: profile.php");
            }
            exit; 
        } else {
            $auth_error = "Неверный логин или пароль.";
        }
    } else {
        $auth_error = "Неверный логин или пароль.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
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
        <a href="#">аккаунт</a>
    </div>
</header>
<div class="content">
    <div class="auth_block">
        <p class="auth_title">Авторизация</p>
        <form action="" method="post" class="auth_form">
            <?php if ($auth_error): ?>
                <div class="auth_error"><?php echo $auth_error; ?></div>
            <?php endif; ?>
            <input class="auth_input_login" type="text" name="username" placeholder="Логин" required>
            <input class="auth_input_password" type="password" name="password" placeholder="Пароль" required>
            <input class="auth_btn" type="submit" name="submit" value="Войти">
            <a href="registration.php" class="registr_href">Зарегистрироваться</a>
        </form>
    </div>
</div>
</body>
</html>
