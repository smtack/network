<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="single-post">
    <h3><a href="/profile?u=<?=$post_data->user_username?>"><?=$post_data->user_name?></a></h3>
    <h6><?=date('j F Y H:i', strtotime($post_data->post_date))?></h6>
    <p><?=$post_data->post_content?></p>

    <?php if(loggedIn() && $post_data->post_by == $user_info->user_id): ?>
      <span class="options">
        <a href="/edit?p=<?=$post_data->post_id?>">Edit</a>
        <a href="/delete?p=<?=$post_data->post_id?>">Delete</a>
      </span>
    <?php endif; ?>

    <div class="comments submit">
      <?php if(loggedIn()): ?>
        <div class="form">
          <form action="<?php $self; ?>" method="POST">
            <div class="form-group">
              <?php if(isset($error)): ?>
                <p class="error"><?=$error?></p>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <textarea name="comment_text"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" name="post_comment" value="Comment">
            </div>
          </form>
        </div>
      <?php endif; ?>

      <?php foreach($comments as $comment): ?>
        <div class="comment">
          <h4><a href="/profile?u=<?=$comment->user_username?>"><?=$comment->user_name?></a></h4>
          <h6><?=date('j F Y H:i', strtotime($comment->comment_date))?></h6>
          <p><?=$comment->comment_text?></p>

          <?php if(loggedIn() && $comment->comment_by == $user_info->user_id): ?>
            <span class="options">
              <a href="/edit-comment?c=<?=$comment->comment_id?>"><img src="/public/img/Edit.svg" alt="Edit Comment"></a>
              <a href="/delete-comment?c=<?=$comment->comment_id?>"><img src="/public/img/Delete.svg" alt="Delete Comment"></a>
            </span>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>