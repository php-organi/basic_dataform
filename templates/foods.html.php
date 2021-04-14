<?php foreach($foods as $food): ?>
<blockquote>
  <P>
    <?= htmlspecialchars($food, ENT_QUOTES, 'UTF-8') ?>
  </P>
</blockquote>
<?php endforeach ?>
