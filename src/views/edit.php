<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<div class="container">
  <div class="form">
    <h2>Edit Post</h2>

    <form enctype="multipart/form-data" action="<?php self() ?>" method="POST">
      <div class="mb-3">
        <?php if(isset($error)): ?>
          <p class="error"><?= $error ?></p>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="post_content" class="form-label visually-hidden">Post Message</label>
        <textarea class="form-control" id="post_content" name="post_content"><?= escape($post_data->post_content) ?></textarea>
        <p id="counter-text"><span id="counter"></span>/1000</p>
      </div>
      <?php if($post_data->post_image): ?>
        <div class="mb-3">
          <img src="<?= base_url("uploads/post-images/$post_data->post_image") ?>">
        </div>
      <?php endif; ?>
      <div class="mb-3">
        <label for="post_image" class="form-label"><img id="upload-image" src="<?= base_url('public/img/Image.svg') ?>" alt="Select image"></label>
        <input class="form-control visually-hidden" id="post_image" type="file" name="post_image">
        <p id="file-name"></p>
      </div>
      <div>
        <input type="hidden" name="token" value="<?= generate('token') ?>">
        <button id="submit" type="submit" name="edit" class="btn btn-primary">Edit</button>
      </div>
    </form>
  </div>
  <div class="form">
    <h2>Delete Post</h2>

    <form action="<?php self() ?>" method="POST">
      <div class="mb-3">
        <?php if(isset($delete_error)): ?>
          <p class="error"><?= $delete_error ?></p>
        <?php endif; ?>
      </div>
      <div>
        <input type="hidden" name="delete_token" value="<?= generate('delete_token') ?>">
        <button id="submit" type="submit" name="delete" class="btn btn-primary">Delete</button>
      </div>
    </form>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>