<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<div class="container">
  <div class="heading">
    <h2>Friend Requests</h2>
  </div>

  <?php if(!$requests): ?>
    <h3 class="message">No friend requests</h3>
  <?php else: ?>
    <?php foreach($requests as $user_data): ?>
      <?php include VIEW_ROOT . '/templates/user-card.php' ?>
    <?php endforeach; ?>
  <?php endif; ?>

  <div class="heading">
    <h2>Your Friends</h2>
  </div>

  <?php if(!(array)$friends): ?>
    <h3 class="message">You have no friends</h3>
  <?php else: ?>
    <?php foreach($friends as $user_data): ?>
      <?php include VIEW_ROOT . '/templates/user-card.php' ?>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>