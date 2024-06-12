<?php
session_start();

include 'config.php';

$userID = $_SESSION['UserID'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
</head>
<body>
    <div class="index_logo_block">
        <img src="img/logo.svg" alt="">
    </div>
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
        <p class="title_page_index">магазин в каждом городе области</p>
        <img src="img/map.svg" alt="" class="index_map">
        <div class="history_block">
            <p class="title_history">наша история</p>
            <p class="history_content">
                В 1901 году была запущена в эксплуатацию первая в Твери городская электростанция общего пользования.
                 Ее мощность составляла 920 кВт. Она обеспечивала электроснабжение трамваев и водопровода, освещение
                  домов городской знати, ряда центральных улиц города.
                <br>
                <br>
                Это событие стало началом становления всей энергосистемы Верхневолжья. Отделить в этой системе единственный ручеёк,
                 от которого берёт начало “ТГЭ”, невозможно. Хроника исторических событий с многочисленными реорганизациями,
                  переименованиями приведёт нас к конторе «СветоГор», которая обеспечивала электроприборами всю областную столицу
                   в 50-60-е годы двадцатого века. Организация просуществовала до семидесятых годов — своего переименования в «ГрадоСвет».
                    В 1983 году контора получила новое название «ПЭС» , а 1987 год принёс реорганизацию и новое имя — Калининский межрайонный
                    магазин городских электроприбороа «КалиноСвет».
                    <br>
                    <br>
                В 1995 году, руководство компании “КалиноСвет” изменилось. Вместе с новым руководством, пришло и новое название, так хорошо закрепившееся в головах Тверичан.
                    <br>
                    <br>
                И таким образом компания “ТГЭ” уже с 1931 года обеспечивает Тверичей надёжной, домашней бытовой техникой
            </p>          
        </div>
        <div class="boss_block">
            <p class="boss_title">наше руководство</p>
            <img src="img/bisnessmen.svg" alt="" class="boss_img">
            <p class="boss_status">
                владелец холдинга
                <br>
                Алексей Вольцман
            </p>
            <img src="img/director.svg" alt="" class="boss_img">
            <p class="boss_status">
                директор холдинга
                <br>
                Владимир Пиотровский
            </p>            
        </div>
        <div class="joing_block">
            <p class="title_history">присоединяйся к “ТГЭ”</p>
            <a class="open_catalog_index" href="">открыть каталог</a>
            <img src="img/logo_light.svg" alt="">
        </div>
        
    </div>
</body>
</html>