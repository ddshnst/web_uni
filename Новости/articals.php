<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <!--Для Internet Explorer: использовать последнюю доступную версию движка рендиринга страницы-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новость</title>
    <link rel="stylesheet" href="style/articals.css">
</head>
<body>
    <header class="header">
        <div class="wrapper1">

            <div class="header_wrapper">
                <!--Логотип-->
                <div class="header_logo">

                    <a href="/">
                        <img src="img/ИКНТ_logo_h.svg" alt="IT институт" style="height: 24px;">
                    </a>
                </div>

                <!--Меню-->
                <nav class="header_nav">
                    <ul class="header_list">

                        <li class="header_items">
                            <a href="#!" class="header_link">ОБ ИНСТИТУТЕ</a>
                        </li>
                        <li class="header_items">
                            <a href="#!" class="header_link">АБИТУРИЕНТУ</a>
                        </li>
                        <li class="header_items">
                            <a href="#!" class="header_link">СТУДЕНТУ</a>
                        </li>
                        <li class="header_items">
                            <a href="#!" class="header_link">ПАРТНЕРУ</a>
                        </li>
                        <!--Поиск-->
                        <div class="group">
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                                <g>
                                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">

                                    </path>
                                </g>
                            </svg>
                            <input placeholder="Поиск" type="search" class="input">
                        </div>

                    </ul>
                    
                </nav>

            </div>
        </div>
    </header>


    <!--Подключение php-->
    <?php
    $connection = mysqli_connect('127.0.0.1','root','','test_db');  //индификатор соединения
    if ($connection == false){  //Проверка подключения
    echo 'Не удалось подключиться к БД!<br />';
    echo mysqli_connect_error();  //Вывод описания ошибки
    exit(); //Остановить выполнение скрипта
    }
    ?>
    <div class="main">
        
            <div style="width: 120px"><a href="archive.php"><div class="to_back">&larr; Назад</div></a></div>
        
    
        
        <div class="content">
            <?php
            $article = mysqli_query($connection, "SELECT * FROM `News` WHERE `id` = " . (int)$_GET['id']);

            if (mysqli_num_rows($article) <= 0){
            ?>
            <p>Статья не найдена</p>
            <?php
            } else{
            $art = mysqli_fetch_assoc($article);
            ?>
        
        
            <div class="container">
                <!--КАРТИНКА-->
                <div class="images" style="background-image: url(img/<?php echo $art['img'];?>); background-repeat: no-repeat; background-size: cover; alt = "<?php echo $art['img'];?>"">
				    </div>
                <!--Заголовок-->
                <div class = "h33"><?php echo $art['title'] ?>.</div>

                <!--Текст-->
                <div class="words"><?php echo $art['text'] ?></div>
            </div>

            <?php
            }
            ?>

        
            <div class="sidebar">
                <?php include "sidebar.php"?>
            </div>
        
        </div>
    </div>
</body>
</html>