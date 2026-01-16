<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-md-4 sidebar">
      <div class="info">
        <img src="<?= base_url("uploads/profile-pictures/$user_info->user_profile_picture") ?>">
        <h2><?= escape($user_info->user_firstname) . ' ' . escape($user_info->user_surname) ?></h2>
        <h5>@<?= escape($user_info->user_username) ?></h5>
      </div>
      <div class="info">
        <h3>Your Friends</h3>

        <?php if(!(array)$friends): ?>
          <p>You don't have any friends</p>
        <?php else: ?>
          <?php foreach($friends as $friend): ?>
            <a href="<?= base_url('profile/') . escape($friend->user_username) ?>">
              <img class="friend-img" src="<?= base_url("uploads/profile-pictures/$friend->user_profile_picture") ?>">
            </a>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
    <div class="col-md-8 posts">
      <?php if(!$posts): ?>
        <h3 class="message">Welcome to network. Make a post or search for people.</h3>
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
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>