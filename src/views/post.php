<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="single-page">
    <h3><a href="<?= base_url('profile/') . escape($post_data->user_username) ?>"><?= escape($post_data->user_name) ?></a></h3>
    <h4><a href="<?= base_url('profile/') . escape($post_data->user_username) ?>">@<?= escape($post_data->user_username) ?></a></h4>
    <h6>
      <?= date('j F Y H:i', strtotime(escape($post_data->post_date))) ?>
      on <a href="<?= base_url('profile/') . $post_user->user_username ?>"><?= $post_user->user_name ?>'s Profile</a>
    </h6>
    <p><?= escape($post_data->post_content) ?></p>

    <?php if($post_data->post_image): ?>
      <img src="<?= base_url("uploads/post-images/$post_data->post_image") ?>">
    <?php endif; ?>
    
    <?php if($user->isLoggedIn()): ?>
      <span class="like">
        <?php if(!findValue($likes_data, 'like_user', $user_info->user_id)): ?>
          <a href="<?= base_url('like/') . escape($post_data->post_id) ?>"><img src="<?= base_url('public/img/Like.svg') ?>" alt="Like"></a>
        <?php else: ?>
          <a href="<?= base_url('unlike/') . escape($post_data->post_id) ?>"><img src="<?= base_url('public/img/Unlike.svg') ?>" alt="Unlike"></a>
        <?php endif; ?>
      </span>
      <span class="like-count"><?= count($likes_data) == 1 ? count($likes_data) . ' Like' : count($likes_data) . ' Likes' ?></span>
    <?php endif; ?>

    <?php if($user->isLoggedIn() && $post_data->post_by == $user_info->user_id): ?>
      <span class="options">
        <a href="<?= base_url('edit/') . escape($post_data->post_id) ?>">Edit</a>
      </span>
    <?php endif; ?>

    <div class="comments submit">
      <?php if($user->isLoggedIn()): ?>
        <div class="form">
          <form action="<?php self() ?>" method="POST">
            <div class="form-group">
              <?php if(isset($error)): ?>
                <p class="error"><?= $error ?></p>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <textarea class="comment-text" name="comment_text"></textarea>
              <p id="counter-text"><span id="counter"></span>/500</p>
            </div>
            <div class="form-group">
              <input type="hidden" name="token" value="<?= generate('token') ?>">
              <input id="submit" type="submit" name="post_comment" value="Comment">
            </div>
          </form>
        </div>
      <?php endif; ?>

      <?php foreach($comments as $comment): ?>
        <div class="comment">
          <h4><a href="<?= base_url('profile/') . escape($comment->user_username) ?>"><?= escape($comment->user_name) ?></a></h4>
          <h5><a href="<?= base_url('profile/') . escape($comment->user_username) ?>">@<?= escape($comment->user_username) ?></a></h5>
          <h6><?= date('j F Y H:i', strtotime(escape($comment->comment_date))) ?></h6>
          <p><?= escape($comment->comment_text) ?></p>

          <?php if($user->isLoggedIn() && $comment->comment_by == $user_info->user_id): ?>
            <span class="options">
              <a href="<?= base_url('edit-comment/') . escape($comment->comment_id) ?>"><img src="<?= base_url('public/img/Edit.svg') ?>" alt="Edit Comment"></a>
            </span>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>