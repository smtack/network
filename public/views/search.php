<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="single-post">
    <?php if(!$results): ?>
      <h3 class="message">No users found</h3>
    <?php else: ?>
      <?php foreach($results as $result): ?>
        <div class="result-info">
          <img src="<?=BASE_URL?>/uploads/profile-pictures/<?=escape($result->user_profile_picture)?>">
          <h2><a href="/profile/<?=escape($result->user_username)?>"><?=escape($result->user_name)?></a></h2>
          <h5>@<?=escape($result->user_username)?></h5>
          <h6>Joined on <?=date('j F Y \a\t H:i', strtotime(escape($result->user_joined)))?></h6>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>