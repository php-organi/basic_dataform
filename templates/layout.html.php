<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="/foods.css"> -->
  <title><?= $title ?></title>
</head>
<body>

  <nav>
    <header>
      <h1>food 게시판</h1>
      <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/food/list">목록</a></li>
        <li><a href="/food/edit">등록</a></li>

        <?php if($loggedIn): ?>
        <li><a href="/logout">로그아웃</a></li>
        <?php else: ?>
        <li><a href="/login">로그인</a></li>
        <?php endif; ?>
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