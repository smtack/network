<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<div class="container">
  <div class="heading">
    <h2>Explore</h2>
  </div>
  <?php if(!$posts): ?>
    <h3 class="message">Nobody has posted anything yet...<h3>
  <?php else: ?>
    <?php foreach($posts as $post_data): ?>
      <?php include VIEW_ROOT .  '/templates/post-card.php' ?>
    <?php endforeach; ?>
    <div class="pagination">
      <?php for($x = 1; $x <= $pages; $x++): ?>
        <a href="?p=<?= $x ?>"<?php if($page === $x) { echo 'class="selected"'; } ?>><?= $x ?></a>
      <?php endfor; ?>
    </div>
  <?php endif; ?>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>