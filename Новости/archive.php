    <!--Подключение php-->
	<?php
        $connection = mysqli_connect('127.0.0.1','root','','test_db');  //индификатор соединения
        if ($connection == false){  //Проверка подключения
	        echo 'Не удалось подключиться к БД!<br/>';  
	        echo mysqli_connect_error();  //Вывод описания ошибки
	        exit(); //Остановить выполнение скрипта
        }
    ?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
    <!--Для Internet Explorer: использовать последнюю доступную версию движка рендиринга страницы-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style/archive.css">
	<title>Все новости</title>

    <script>

    </script>
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
        <div class="container">
        <div class = "title">&lt;h1&gt;&#8203;ВСЕ НОВОСТИ&#8203;&lt;/h1&gt;</div>
        <!--Тут содержатся все новости-->
        <div class="main">
       
            <!--Запрос на все статьи-->
            <?php
                $per_page=4;
                $page=1;
                if(isset($_GET['page'])){
                    $page = (int)  $_GET['page'];
                }

                $total_count_q = mysqli_query($connection, "SELECT count(`id`) as `total_count` FROM `news`");
                $total_count = mysqli_fetch_assoc($total_count_q);
                $total_count = $total_count['total_count'];

                $total_pages = ceil($total_count / $per_page);
                if ($page <= 1 || $page > $total_pages){
                    $page = 1;
                }

                $offset = ($per_page * $page) - $per_page;

                $news = mysqli_query($connection, "SELECT * FROM `news` ORDER BY `id` DESC  LIMIT $offset, $per_page");
                
                $news_exist = false;

                while ($new = mysqli_fetch_assoc($news)){
            ?>
            <a href = "articals.php?id=<?php echo $new['id'];?>">
                <div class="new" style = "background-image: url(img/<?php echo $new['img']; ?>); background-repeat: no-repeat; background-size: cover;" alt = "<?php echo $new['img']; ?>">
                    <div class="card">
                        <div class="wrapper">
                            <div class = "teg" ></div>
                            <div class="data">
                                <?php echo $new['date']; ?>
                            </div>
                        </div>

                        <div class="text">
                        <?php echo $new['title']; ?>
                        </div>
                    </div>
                </div>
            </a>

            <?php } ?>

        </div>

            <div class="paginator">

            <?php
                if ($news_exist == false){
                    if($page > 1){
                        echo '<div class="pag">';
                        echo '<a href="/archive.php?page='.($page - 1).'">&larr;</a>';
                        echo '</div>';
                    }

                    
                    for ($i = 1; $i <= $total_pages; $i++) { 
                        echo '<div class="numbers">';
                        if($i == $page){
                            echo '<a href="/archive.php?page='.($i).'" class="acct">'.($i).'</a>';
                        }
                        else{
                            echo '<a href="/archive.php?page='.($i).'" >'.($i).'</a>';
                        }
                        echo '</div>';
                    }
                    

                    if($page < $total_pages){
                        echo '<div class="pag">';
                        echo '<a href="/archive.php?page='.($page + 1).'">&rarr;</a>';
                        echo '</div>';
                    }  

                }
            ?>

            </div>
    </div>
</body>
</html>