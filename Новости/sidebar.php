<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <!--Для Internet Explorer: использовать последнюю доступную версию движка рендиринга страницы-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/sidebar.css">
</head>
<body>
    <!--Подключение php-->
	<?php
        $connection = mysqli_connect('127.0.0.1','root','','test_db');  //индификатор соединения
        if ($connection == false){  //Проверка подключения
	        echo 'Не удалось подключиться к БД!<br/>';  
	        echo mysqli_connect_error();  //Вывод описания ошибки
	        exit(); //Остановить выполнение скрипта
        }
    ?>

    <div class="all_event">
        <div class="h22">События</div>
            <!--Запрос на все статьи-->
            <?php
                $events = mysqli_query($connection, "SELECT * FROM `events` ORDER BY `data` LIMIT 3");
            ?>
            <?php
                while ($event = mysqli_fetch_assoc($events)){
            ?>
            <a href = "events.php?id=<?php echo $event['id'];?>">
                <div class="event">
                    <div class="date_event">
                        <div class = "day"><?php echo $event['day']?></div>
                        <div class = "mounth"><?php echo $event['mounth']?></div>
                    </div>
                    <div class="information">
                        <div class="title_event"><?php echo $event['title']?></div>
                        <!--<div class="text_event"><?php 
                        //$str = $event['description']; 
                        //echo mb_substr($str, 0, mb_strrpos(mb_substr($str, 0, 60, 'utf-8'), ' ', 'utf-8'), 'utf-8');?> ...</div>-->
                    </div>
                </div>
            </a>
            <?php
                }
            ?>
    </div>

    <div class = "all_news">    
        <div class="h22">Новости</div>
            <!--Запрос на все статьи-->
            <?php
                $news = mysqli_query($connection, "SELECT * FROM `news` ORDER BY `id` DESC");
            ?>

            <!--Тут содержатся все новости-->
            <?php
                while ($new = mysqli_fetch_assoc($news)){
            ?>
            <a href = "articals.php?id=<?php echo $new['id'];?>">
                <div class = "new">
                    <div class = "img_new" style = "background-image: url(img/<?php echo $new['img']; ?>); background-size: cover;" alt = "<?php echo $new['img']; ?>"></div>
                    <div class = "title_new"><?php echo $new['title']; ?></div>
                </div>
            </a>
            <?php
                }
            ?>
    </div>
</body>
</html>
