<?php
if(!empty($error)):
?>

<div class="errors">
  <p>등록할 수 없습니다. 다음을 확인</p>
  <ul>
  <?php
    foreach($errors as $error):
  ?>
  <li><?= $error ?></li>
    <?php endforeach; ?>
  </ul>
</div>

<?php endif; ?>

<form action="" method="post">
  <label for="email">이메일</label>
  <input type="text" name="author[email]" id="email" value="<?= $author['email']?? '' ?>">
  <label for="email">이름</label>
  <input type="text" name="author[name]" id="name" value="<?= $author['name']?? '' ?>">
  <label for="email">비밀번호</label>
  <input type="password" name="author[password]" id="password" value="<?= $author['password']?? '' ?>">

  <input type="submit" name="submit" value="사용자 등록">
</form>