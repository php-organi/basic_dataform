<p><?= $totalFood ?>개의 글이 있음</p>

<?php foreach($foods as $food): ?>
<blockquote>
  <P>
    <?= htmlspecialchars($food['foodtext'], ENT_QUOTES, 'UTF-8') ?>

    (작성자: <a href="mailto:<?= htmlspecialchars($food['email'], ENT_QUOTES, 'UTF-8')?>">
    <?=htmlspecialchars($food['name'], ENT_QUOTES, 'UTF-8')?></a>
    <!-- 작성일: <?=$food['fooddate']?> -->
    작성일: <?php $date = new DateTime($food['fooddate']);
            echo $date->format('jS F Y')?>)

    <a href="index.php?action=edit&id=<?= $food['id']?>">수정</a>

    <form action="index.php?action=delete" method="post">
      <input type="hidden" name="id" value="<?=$food['id']?>">
      <input type="submit" value="삭제">
    </form>
  </P>
</blockquote>
<?php endforeach ?>
