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
        <div class="interactive">
          <a href="/index.php" class="logo">
            <img src="img/nm-logo.png">
          </a>
          <form id="search">
            <input type="text" placeholder="Поиск">
          </form>
          <span id="menu-toggle" class="material-symbols-outlined menu">menu</span>
        </div>
        <ul class="navbar-menu">
          <li class="active"><a href="/articles.php">Статьи</a></li>
          <li><a href="/study.php">Кружки</a></li>
          <li><a href="/archive.php">Архив</a></li>
        </ul>
      </div>
    </nav>
    <div class="content">
      <section class="articles">
        <h1 class="heading">
          Статьи
        </h1>
        <ul class="article-list">
          <li>
            <a href="#">
              <div class="article-image" style="background-image: url('/uploads/63b8675fc5ff3.png');"></div>
              <div class="article-content">
                <span class="article-title">Article title</span>
                <div class="article-preview-text">
                  Short article description.
                </div>
              </div>
            </a>
          </li>
        </ul>
      </section>
      <footer>
        Copyright &copy; 2022 Marxist Science | All rights reserved.
      </footer>
    </div>
    <script src="/js/menu-toggle.js" defer></script>
  </body>
</html>
