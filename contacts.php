<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>    
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
        <a href="auth.php">аккаунт</a>
    </div>
</header>

<div class="content">
    <img src="img/logo_light.svg" alt="">    
    <p class="title_page">контакты</p>
    <div class="contacts-container">
        <div class="info_contacts_block">
            <p class="title_contacts">Данные для связи</p>
            <a href="tel:+7(4822)78-70-50" class="phone_contacts">+7(4822) 78-70-50</a>
            <a href="tel:+7(4822)78-70-30" class="phone_contacts">+7(4822) 78-70-30</a>
        </div>
        <div class="info_contacts_block">
            <p class="title_contacts">Центр обслуживания клиентов</p>
            <a href="tel:+7(4822)34-26-64 " class="phone_contacts">+7(4822) 34-26-64</a>
            <a href="tel:+7(4822)66-60-80" class="phone_contacts">+7(4822) 66-60-80</a>
            <a href="tel:+7(4822)78-70-55" class="phone_contacts">+7(4822) 78-70-55</a>
        </div>
         
        <div class="socseti_contacts_blocks">
            <p class="title_contacts">Соцсети</p>
            <a href="https://vk.com/official_tge"><img src="img/vkpng.png" alt="" width="100px"></a>
            <a href="https://t.me/tvergorelektro_official"><img src="img/tgpng.png" alt="" width="100px"></a>
        </div>

        <div class="callback_contacts_block" id="callback">
            <p class="callback_title">
                Остались вопросы?
                <br>
                Закажите обратный звонок!
            </p>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                include 'config.php';

                $name = trim($_POST['name']);
                $phone = trim($_POST['phone']);

                if (empty($name) || empty($phone)) {
                    echo "<script>alert('Пожалуйста, заполните все поля.');</script>";
                } else {
                    $requestTime = date("Y-m-d H:i:s"); 

                    $sql = "INSERT INTO CallbackRequests (Name, PhoneNumber, RequestTime)
                    VALUES ('$name', '$phone', '$requestTime')";

                    if ($conn->query($sql) === TRUE) {
                        echo "Ваш запрос успешно отправлен!";
                    } else {
                        echo "Ошибка: " . $sql . "<br>" . $conn->error;
                    }

                    $conn->close();
                }
            }
            ?>
            <form method="post" class="callback_form" onsubmit="return validateForm()">
                <input type="text" name="name" id="name" class="input_callback_text" placeholder="Ваше имя" >
                <input type="text" name="phone" id="phone" class="input_callback_text" placeholder="Ваш номер телефона" >
                <input type="submit" value="Запросить звонок" class="callback_btn">
            </form>
        </div>
    </div>
    <iframe class="contacts_map" src="https://yandex.ru/map-widget/v1/?um=constructor%3A736836f85e3d3aef65dbcb26d467ae161a518a5013e2c002e26af49005b45eb1&amp;source=constructor" frameborder="0"></iframe>

</div>

<script>
function validateForm() {
    var name = document.getElementById('name').value.trim();
    var phone = document.getElementById('phone').value.trim();

    if (name === "" || phone === "") {
        alert('Пожалуйста, введите ваше имя и номер телефона.');
        return false;
    }
    return true;
}
</script>
</body>
</html>
