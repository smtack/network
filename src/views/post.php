<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<div class="container">
  <div class="post card single-post">
    <div class="post-user">
        <div class="post-user-picture">
            <img class="post-profile-picture rounded-circle" src="<?= base_url('uploads/profile-pictures/' . $post_data->user_profile_picture) ?>" alt="Profile Picture">
        </div>
        <div class="post-user-info">
            <h4><a href="<?= base_url('profile/') . escape($post_data->user_username) ?>"><?= escape($post_data->user_firstname) ?> <?= escape($post_data->user_surname) ?></a></h4>
            <h5><a href="<?= base_url('profile/') . escape($post_data->user_username) ?>">@<?= escape($post_data->user_username) ?></a></h5>
    
            <span class="date">
                <?= date('j F Y H:i', strtotime(escape($post_data->post_date))) ?>
                on <a href="<?= base_url('profile/') . $post_user->user_username ?>"><?= $post_user->user_firstname ?>'s Profile</a>
            </span>
        </div>
    </div>
    <div class="post-content">
      <p><?= escape($post_data->post_content) ?></p>

      <?php if($post_data->post_image): ?>
          <img src="<?= base_url("uploads/post-images/$post_data->post_image") ?>">
      <?php endif; ?>

      <?php if($user->isLoggedIn()): ?>
        <span class="like">
          <?php if(!findValue($likes_data, 'like_user', $user_info->user_id)): ?>
            <a href="<?= base_url('like/') . escape($post_data->post_id) ?>"><img src="<?= base_url('public/img/Like-Red.svg') ?>" alt="Like"></a>
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
    </div>
  </div>

  <div class="comments submit">
    <?php if($user->isLoggedIn()): ?>
      <div class="form">
        <form action="<?php self() ?>" method="POST">
          <div class="mb-3">
            <?php if(isset($error)): ?>
              <p class="error"><?= $error ?></p>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label for="comment_text" class="form-label visually-hidden">Comment</label>
            <textarea class="form-control" id="comment_text" name="comment_text" placeholder="Make a comment..."></textarea>
            <p id="counter-text"><span id="counter"></span>/500</p>
          </div>
          <div>
            <input type="hidden" name="token" value="<?= generate('token') ?>">
            <button id="submit" type="submit" name="post_comment" class="btn btn-primary">Comment</button>
          </div>
        </form>
      </div>
    <?php endif; ?>

    <?php foreach($comments as $comment): ?>
      <div class="post card comment">
        <div class="post-user">
            <div class="post-user-picture">
                <img class="post-profile-picture rounded-circle" src="<?= base_url('uploads/profile-pictures/' . $comment->user_profile_picture) ?>" alt="Profile Picture">
            </div>
            <div class="post-user-info">
                <h4><a href="<?= base_url('profile/') . escape($comment->user_username) ?>"><?= escape($comment->user_firstname) ?> <?= escape($comment->user_surname) ?></a></h4>
                <h5><a href="<?= base_url('profile/') . escape($comment->user_username) ?>">@<?= escape($comment->user_username) ?></a></h5>
        
                <span class="date">
                    <?= date('j F Y H:i', strtotime(escape($comment->comment_date))) ?>
                </span>
            </div>
        </div>
        <div class="post-content">
          <p><?= escape($comment->comment_text) ?></p>

          <?php if($user->isLoggedIn() && $comment->comment_by == $user_info->user_id): ?>
            <span class="options">
              <a href="<?= base_url('edit-comment/') . escape($comment->comment_id) ?>"><img src="<?= base_url('public/img/Edit.svg') ?>" alt="Edit Comment"></a>
            </span>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>