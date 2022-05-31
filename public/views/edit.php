<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="form">
    <h3>Edit Post</h3>

    <form action="<?php $self; ?>" method="POST">
      <div class="form-group">
        <?php if(isset($error)): ?>
          <p class="error"><?=$error?></p>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <textarea name="post_content"><?=$post_data->post_content?></textarea>
      </div>
      <div class="form-group">
        <input type="submit" name="edit" value="Edit">
      </div>
    </form>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>