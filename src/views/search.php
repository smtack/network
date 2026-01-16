<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<div class="container mt-4">
  <?php if(!$results): ?>
    <h3 class="message">No users found</h3>
  <?php else: ?>
    <?php foreach($results as $user_data): ?>
      <?php include VIEW_ROOT . '/templates/user-card.php' ?>
    <?php endforeach; ?>
    <div class="pagination">
      <?php for($x = 1; $x <= $pages; $x++): ?>
        <a href="?s=<?= str_replace('%', '', $keywords) ?>&p=<?= $x ?>"<?php if($page === $x) { echo 'class="selected"'; } ?>><?= $x ?></a>
      <?php endfor; ?>
    </div>
  <?php endif; ?>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>