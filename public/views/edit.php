<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="form">
    <h3>Edit Post</h3>

    <form enctype="multipart/form-data" action="<?php self() ?>" method="POST">
      <div class="form-group">
        <?php if(isset($error)): ?>
          <p class="error"><?= $error ?></p>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <textarea class="post-content" id="textarea" name="post_content"><?= escape($post_data->post_content) ?></textarea>
        <p id="counter-text"><span id="counter"></span>/1000</p>
      </div>
      <?php if($post_data->post_image): ?>
        <div class="form-group">
          <img src="<?= base_url("uploads/post-images/$post_data->post_image") ?>">
        </div>
      <?php endif; ?>
      <div class="form-group">
        <label for="post_image"><img id="upload-image" src="<?= base_url('public/img/Image.svg') ?>" alt="Upload Image"></label>
        <input id="post_image" type="file" name="post_image">
        <p id="file-name"></p>
      </div>
      <div class="form-group">
        <input type="hidden" name="token" value="<?= generate('token') ?>">
        <input id="submit" type="submit" name="edit" value="Edit">
      </div>
    </form>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>