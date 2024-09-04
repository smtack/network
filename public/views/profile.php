<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="sidebar">
    <div class="info">
      <img src="<?= base_url("uploads/profile-pictures/$profile_info->user_profile_picture") ?>">
      <h2><?= escape($profile_info->user_name) ?></h2>
      <h5>@<?= escape($profile_info->user_username) ?></h5>
      <h6>Joined on <?= date('j F Y \a\t H:i', strtotime(escape($profile_info->user_joined))) ?></h6>

      <?php if(isset($profile_info->user_bio)): ?>
        <p><?= $profile_info->user_bio ?></p>
      <?php endif; ?>

      <?php if(loggedIn() && $profile_info->user_id !== $user_info->user_id): ?>
        <?php if(!$user->isFriends($user_info->user_id, $profile_info->user_id)): ?>
          <a href="<?= base_url('friend/') . escape($profile_info->user_id) ?>"><button id="friend">Add as Friend</button></a>
        <?php elseif($user->isFriendRequestPending($user_info->user_id)): ?>
          <a href="<?= base_url('accept/') . escape($profile_info->user_id) ?>"><button id="friend">Accept Friend Request</button></a>
        <?php else: ?>
          <a href="<?= base_url('unfriend/') . escape($profile_info->user_id) ?>"><button id="friend">Remove Friend</button></a>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
  
  <?php if(loggedIn()): ?>
    <div class="posts submit">
      <div class="form">
        <form enctype="multipart/form-data" action="<?php self() ?>" method="POST">
          <div class="form-group">
            <?php if(isset($error)): ?>
              <p class="error"><?= $error ?></p>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <textarea class="post-content" name="post_content" placeholder="Make a post..."></textarea>
            <p id="counter-text"><span id="counter"></span>/1000</p>
          </div>
          <div class="form-group">
            <label for="post_image"><img id="upload-image" src="<?= base_url('public/img/Image.svg') ?>" alt="Upload Image"></label>
            <input id="post_image" type="file" name="post_image">
            <p id="file-name"></p>
          </div>
          <div class="form-group">
            <input type="hidden" name="token" value="<?= generate('token') ?>">
            <input id="submit" type="submit" name="submit" value="Post">
          </div>
        </form>
      </div>
    </div>
  <?php endif; ?>

  <div class="posts">
    <?php if(!$posts): ?>
      <h3 class="message">Make a post on <?= escape($profile_info->user_name) ?>'s profile...<h3>
    <?php else: ?>
      <?php foreach($posts as $post): ?>
        <div class="post" onclick="location.href='<?= base_url('post/') . escape($post->post_id) ?>'">
          <h5><a href="<?= base_url('profile/') . escape($post->user_username) ?>"><?= escape($post->user_name) ?></a></h5>
          <h6><?= date('j F Y H:i', strtotime(escape($post->post_date))) ?></h6>

          <?php if(strlen($post->post_content) > 140): ?>
            <p><?= substr(escape($post->post_content), 0, 140) . '...' ?></p>
          <?php else: ?>
            <p><?= escape($post->post_content) ?></p>
          <?php endif; ?>

          <?php if($post->post_image): ?>
            <img src="<?= base_url("uploads/post-images/$post->post_image") ?>">
          <?php endif; ?>

          <?php if(loggedIn() && $post->post_by == $user_info->user_id): ?>
            <span class="options">
              <a href="<?= base_url('edit/') . escape($post->post_id) ?>">Edit</a>
              <a href="<?= base_url('delete/') . escape($post->post_id) ?>">Delete</a>
            </span>
          <?php endif; ?>
        </div>
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