<p><?= $totalFood ?>개의 글이 있음</p>

<?php foreach($foods as $food): ?>
<blockquote>
  <P>
    <?= htmlspecialchars($food['foodtext'], ENT_QUOTES, 'UTF-8') ?>

    (작성자: <a href="mailto:<?= htmlspecialchars($food['email'], ENT_QUOTES, 'UTF-8')?>">
    <?=htmlspecialchars($food['name'], ENT_QUOTES, 'UTF-8')?></a>)

    <a href="editfood.php?id=<?= $food['id']?>">수정</a>

    <form action="deletefood.php" method="post">
      <input type="hidden" name="id" value="<?=$food['id']?>">
      <input type="submit" value="삭제">
    </form>
  </P>
</blockquote>
<?php endforeach ?>
