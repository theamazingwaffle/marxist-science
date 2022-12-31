<?php
require '../secrets.php';
require '../lib/auth.php';

$dbconn = pg_connect("password=$db_pass");
if (!check_auth($dbconn)) {
    setcookie('next_page', '/publish.php', time()+3600, "/");
    header("Location: /login.php");
    pg_close($dbconn);
    exit;
}
pg_close($dbconn);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <title>Наука Марксизм</title>
  </head>
  <body>
    <nav class="main-navbar">
      <div class="navbar-inner">
        <a href="#" class="logo">
          <img src="img/nm-logo.png">
        </a>
        <ul class="navbar-menu">
          <li><a href="/articles.php">Статьи</a></li>
          <li><a href="#">Кружки</a></li>
          <li><a href="#">Архив</a></li>
        </ul>
        <form id="search">
          <input type="text" placeholder="Поиск">
        </form>
        <!-- <a href="#"><span class="material-symbols-outlined menu">menu</span></a> -->
      </div>
    </nav>
    <div class="content">
      <section class="write-article">
        <h1>Написать статью...</h1>
        <form id="article-writer" action="/publish.php" method="POST">
          <input type="text" name="title" placeholder="Название статьи">
          <input type="text" name="image-url" placeholder="Ссылка на обложку статьи">
          <textarea name="content">Содержание статьи тут</textarea>
          <input type="submit" value="Опубликовать">
        </form>
      </section>
      <section class="upload">
        <ul id="upload-files">
          <form id="upload-form" action="/upload.php" method="POST"
                enctype="multipart/form-data">
            <span class="error" style="display:none;" id="upload-error"></span>
            <div class="input-group">
              <input type="file" accept="image/*" name="fileToUpload">
              <input type="submit" value="загрузить файл">
            </div>
          </form>
        </ul>
      </section>
      <footer>
        Copyright &copy; 2022 Marxist Science | All rights reserved.
      </footer>
    </div>
    <script src="/js/upload.js" defer></script>
  </body>
</html>
