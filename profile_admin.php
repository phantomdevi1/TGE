<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль администратора</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
<header>
    <div class="toolbar">
        <a href="order.php">заказы</a>
        <a href="blog_admin.php">блог</a>
        <a href="product_admin.html">продукция</a>
        <a href="profile_admin">аккаунт</a>
    </div>
</header>
<?php
session_start();

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
        <p class="hello_text">Добро пожаловать, администратор <?php echo $name ?? "Unknown"; ?></p>
    </div>
    <div class="user_info_block">
        <p>mail: <?php echo $email ?? "Unknown"; ?></p>
    </div>
</div>
</body>
</html>