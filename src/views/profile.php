<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-md-4 sidebar">
      <div class="info">
        <img src="<?= base_url("uploads/profile-pictures/$profile_info->user_profile_picture") ?>">
        <h2><?= escape($profile_info->user_firstname) . ' ' . escape($profile_info->user_surname) ?></h2>
        <h5>@<?= escape($profile_info->user_username) ?></h5>
        <h6>Joined on <?= date('j F Y \a\t H:i', strtotime(escape($profile_info->user_joined))) ?></h6>

        <?php if(isset($profile_info->user_bio)): ?>
          <p><?= $profile_info->user_bio ?></p>
        <?php endif; ?>

        <?php if($user->isLoggedIn() && $profile_info->user_id !== $user_info->user_id): ?>
          <?php if(!$user->isFriends($user_info->user_id, $profile_info->user_id)): ?>
            <a href="<?= base_url('friend/') . escape($profile_info->user_id) ?>"><button id="friend" class="btn btn-primary">Add as Friend</button></a>
          <?php elseif($user->isFriendRequestPending($user_info->user_id, $profile_info->user_id)): ?>
            <a href="<?= base_url('accept/') . escape($profile_info->user_id) ?>"><button id="friend" class="btn btn-primary">Accept Friend Request</button></a>
          <?php else: ?>
            <a href="<?= base_url('unfriend/') . escape($profile_info->user_id) ?>"><button id="friend" class="btn btn-primary">Remove Friend</button></a>
          <?php endif; ?>
        <?php endif; ?>
      </div>
      <div class="info">
        <h3><?= escape($profile_info->user_firstname) ?>'s Friends</h3>

        <?php if(!(array)$friends): ?>
          <p><?= escape($profile_info->user_firstname) ?> doesn't have any friends</p>
        <?php else: ?>
          <?php foreach($friends as $friend): ?>
            <a href="<?= base_url('profile/') . escape($friend->user_username) ?>">
              <img class="friend-img" src="<?= base_url("uploads/profile-pictures/$friend->user_profile_picture") ?>">
            </a>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
    <div class="col-md-8">
      <?php if($user->isLoggedIn()): ?>
        <div class="posts submit">    
          <div class="form">
            <form enctype="multipart/form-data" action="<?php self() ?>" method="POST">
              <div class="mb-3">
                <?php if(isset($error)): ?>
                  <p class="error"><?= $error ?></p>
                <?php endif; ?>
              </div>
              <div class="mb-3">
                <label for="post_content" class="form-label visually-hidden">Post Message</label>
                <textarea class="form-control" id="post_content" name="post_content" placeholder="Make a post..."></textarea>
                <p id="counter-text"><span id="counter"></span>/1000</p>
              </div>
              <div class="mb-3">
                <label for="post_image" class="form-label"><img id="upload-image" src="<?= base_url('public/img/Image.svg') ?>" alt="Select image"></label>
                <input class="form-control visually-hidden" id="post_image" type="file" name="post_image">
                <p id="file-name"></p>
              </div>
              <div>
                <input type="hidden" name="token" value="<?= generate('token') ?>">
                <button id="submit" type="submit" name="submit" class="btn btn-primary">Post</button>
              </div>
            </form>
          </div>
        </div>
      <?php endif; ?>

      <div class="posts">
        <?php if(!$posts): ?>
          <h3 class="message">Make a post on <?= escape($profile_info->user_firstname) ?>'s profile...<h3>
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
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>