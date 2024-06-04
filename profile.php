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
        <a href="profile.php">аккаунт</a>
    </div>
</header>
<?php
session_start();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: auth.php");
    exit();
}

if (!isset($_SESSION['UserID'])) {
    header("Location: auth.php"); 
    exit();
}

include 'config.php';

$userID = $_SESSION['UserID'];

$sqlEmail = "SELECT Email FROM Users WHERE UserID = ?";
$stmtEmail = $conn->prepare($sqlEmail);
$stmtEmail->bind_param("i", $userID);
$stmtEmail->execute();
$stmtEmail->bind_result($email);
$stmtEmail->fetch();
$stmtEmail->close();

$sqlName = "SELECT Username FROM Users WHERE UserID = ?";
$stmtName = $conn->prepare($sqlName);
$stmtName->bind_param("i", $userID);
$stmtName->execute();
$stmtName->bind_result($name);
$stmtName->fetch();
$stmtName->close();

$conn->close();
?>

<div class="content">
    <img src="img/logo_light.svg" alt="">    
    <p class="title_page">профиль</p>
    <div class="hello_block">
        <p class="hello_text">Добро пожаловать,  <?php echo htmlspecialchars($name) ?? "Unknown"; ?></p>
    </div>
    <div class="user_info_block">
        <p>mail: <?php echo htmlspecialchars($email) ?? "Unknown"; ?></p>
    </div>
    <form action="" method="post" style="display:inline;">
            <button type="submit" name="logout" class="logout_button">выход</button>
        </form>
</div>
</body>
</html>