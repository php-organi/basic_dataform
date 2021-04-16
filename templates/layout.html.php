<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
</head>
<body>

  <nav>
    <header>
      <h1>food 게시판</h1>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="foods.php">목록</a></li>
        <li><a href="editfood.php">등록</a></li>
      </ul>
    </header>
  </nav>
  <main>
    <?= $output ?>
  </main>
  <footer>
    &copy; foodie 2021
  </footer>

</body>
</html>