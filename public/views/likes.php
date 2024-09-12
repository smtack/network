<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="single-page">
    <div class="heading">
      <h2>Your Likes</h2>
    </div>
    <?php if(!$posts): ?>
      <h3 class="message">You haven't liked any posts<h3>
    <?php else: ?>
      <?php foreach($posts as $post): ?>
          <?php include 'public/views/templates/post-card.php' ?>
      <?php endforeach; ?>
      <div class="pagination">
        <?php for($x = 1; $x <= $pages; $x++): ?>
          <a href="?p=<?= $x ?>"<?php if($page === $x) { echo 'class="selected"'; } ?>><?= $x ?></a>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>