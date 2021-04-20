<?php

if(isset($error)):
  echo '<div class="error">' . $error . '</div>';
endif;
?>
<form action="" method="post">
  <label for="email">이메일</label>
  <input type="text" id="email" name="email">
  <label for="email">비밀번호</label>
  <input type="password" id="password" name="password">

  <input type="submit" name="login" value="로그인">
</form>

<p>계정없음?<a href="/author/register">회원가입하려면 클릭</a></p>