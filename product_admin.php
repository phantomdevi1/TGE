<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление продукции</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
<header>
    <div class="toolbar">
        <a href="order.php">заказы</a>
        <a href="blog_admin.php">блог</a>
        <a href="product_admin.php">продукция</a>
        <a href="callback_admin.php">заявки</a>
        <a href="profile_admin.php">аккаунт</a>
    </div>
</header>
<div class="content">
    <img src="img/logo_light.svg" alt="Logo" class="logo">    
    <p class="title_page">добавление продукции</p>


    <form class="product_admin_form" action="" method="post" enctype="multipart/form-data">
        <label for="name">Название:</label>
        <input type="text" id="name" name="name" required>

        <label for="description">Описание:</label>
        <textarea id="description" name="description" required></textarea><br>

        <label for="image">Изображение:</label>
        <input type="file" id="image" name="image" required>

        <input type="submit" name="submit" value="Добавить продукт" class="submit_product_admin">
    </form>

    <?php
    include 'config.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $imagePath = 'img/product/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

        $sql = "INSERT INTO Products (Name, Description, ImagePath) VALUES ('$name', '$description', '$imagePath')";
        if ($conn->query($sql) === TRUE) {
            echo "Новая продукция добавлена успешно!";
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <table class="table_products">
        <thead>
            <tr>
                <th>Изображение</th>
                <th>Название</th>
                <th>Описание</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT ProductID, ImagePath, Name, Description FROM Products";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><img src='" . $row['ImagePath'] . "' alt='" . $row['Name'] . "' width='100'></td>";
                    echo "<td>" . $row['Name'] . "</td>";
                    echo "<td>" . $row['Description'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Нет продукции</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
