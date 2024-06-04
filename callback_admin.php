<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заявки на звонок</title>
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
    <img src="img/logo_light.svg" alt="Logo" class="logo">    
    <p class="title_page">заявки на звонок</p>

    <table class="table_callback">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Номер телефона</th>
                <th>Дата и время заявки</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'config.php'; 
            $sql = "SELECT RequestID, Name, PhoneNumber, RequestTime FROM CallbackRequests";
            $result = $conn->query($sql);
            $conn->close();
            ?>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['PhoneNumber']; ?></td>
                        <td><?php echo $row['RequestTime']; ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Нет заявок</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
