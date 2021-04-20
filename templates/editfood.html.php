<?php if($userId == $food['authorId']): ?>
<form action="" method="post">
  <input type="hidden" name="food[id]" value="<?= $food['id'] ?? '' ?>">
  <label for="foodtext">food 글을 입력 : </label>
  <textarea name="food[foodtext]" id="foodtext" cols="30" rows="10">
  <?= $food['foodtext'] ?? '' ?>
  </textarea>
  <input type="submit" value="수정">
</form>
<?php else: ?>
<p> 자신이 작성한 글만 수정할 수 있음 </p>
<?php endif; ?>