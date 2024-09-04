<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="sidebar">
    <div class="info">
      <img src="<?= base_url("uploads/profile-pictures/$user_info->user_profile_picture") ?>">
      <h2><?= escape($user_info->user_name) ?></h2>
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
  
  <div class="posts">
    <?php if(!$posts): ?>
      <h3 class="message">Welcome to network. Make a post or search for people.</h3>
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

          <?php if($post->post_by == $user_info->user_id): ?>
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