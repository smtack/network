<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<div class="container">
  <div class="form">
    <h2>Edit Comment</h2>

    <form action="<?php self() ?>" method="POST">
      <div class="mb-3">
        <?php if(isset($error)): ?>
          <p class="error"><?= $error ?></p>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="comment_text" class="form-label visually-hidden">Comment</label>
        <textarea class="form-control" id="comment_text" name="comment_text"><?= escape($comment_data->comment_text) ?></textarea>
        <p id="counter-text"><span id="counter"></span>/500</p>
      </div>
      <div>
        <input type="hidden" name="token" value="<?= generate('token') ?>">
        <button id="submit" type="submit" name="edit_comment" class="btn btn-primary">Edit Comment</button>
      </div>
    </form>
  </div>
  <div class="form">
    <h2>Delete Comment</h2>

    <form action="<?php self() ?>" method="POST">
      <div class="mb-3">
        <?php if(isset($delete_error)): ?>
          <p class="error"><?= $delete_error ?></p>
        <?php endif; ?>
      </div>
      <div>
        <input type="hidden" name="delete_token" value="<?= generate('delete_token') ?>">
        <button id="submit" type="submit" name="delete_comment" class="btn btn-primary">Delete Comment</button>
      </div>
    </form>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>