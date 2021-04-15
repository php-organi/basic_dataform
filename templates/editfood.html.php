<form action="" method="post">
  <input type="hidden" name="foodid" value="<?= $food['id'] ?>">
  <label for="foodtext">food 글을 입력 : </label>
  <textarea name="foodtext" id="foodtext" cols="30" rows="10">
  <?= $food['foodtext'] ?>
  </textarea>
  <input type="submit" value="수정">
</form>