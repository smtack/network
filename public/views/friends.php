<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="single-post">
    <div class="heading">
      <h2>Friend Requests</h2>

      <?php if(!$requests): ?>
        <h3 class="message">No friend requests</h3>
      <?php else: ?>
        <?php foreach($requests as $request): ?>
          <div class="result-info">
            <img src="<?= base_url("uploads/profile-pictures/$request->user_profile_picture") ?>">
            <h2><a href="<?= base_url('profile/') . escape($request->user_username) ?>"><?= escape($request->user_name) ?></a></h2>
            <h5>@<?= escape($request->user_username) ?></h5>
            <h6>Joined on <?= date('j F Y \a\t H:i', strtotime(escape($request->user_joined))) ?></h6>

            <a href="<?= base_url('accept/') . escape($request->user_id) ?>"><button id="friend">Accept</button></a>
            <a href="<?= base_url('decline/') . escape($request->user_id) ?>"><button id="friend">Decline</button></a>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div class="heading">
      <h2>Your Friends</h2>
      <?php if(!(array)$friends): ?>
        <h3 class="message">You have no friends</h3>
      <?php else: ?>
        <?php foreach($friends as $friend): ?>
          <div class="result-info">
            <img src="<?= base_url("uploads/profile-pictures/$friend->user_profile_picture") ?>">
            <h2><a href="<?= base_url('profile/') . escape($friend->user_username) ?>"><?= escape($friend->user_name) ?></a></h2>
            <h5>@<?= escape($friend->user_username) ?></h5>
            <h6>Joined on <?= date('j F Y \a\t H:i', strtotime(escape($friend->user_joined))) ?></h6>

            <a href="<?= base_url('unfriend/') . escape($friend->user_id) ?>"><button id="friend">Unfriend</button></a>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>