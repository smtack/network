<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="form">
    <h3>Edit Comment</h3>

    <form action="<?php self() ?>" method="POST">
      <div class="form-group">
        <?php if(isset($error)): ?>
          <p class="error"><?= $error ?></p>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <textarea class="comment-text" name="comment_text"><?= escape($comment_data->comment_text) ?></textarea>
        <p id="counter-text"><span id="counter"></span>/1000</p>
      </div>
      <div class="form-group">
        <input type="hidden" name="token" value="<?= generate('token') ?>">
        <input id="submit" type="submit" name="edit_comment" value="Edit Comment">
      </div>
    </form>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>