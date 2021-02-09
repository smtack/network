<?php require_once VIEW_ROOT . "/includes/header.php"; ?>

<?php require_once VIEW_ROOT . "/includes/navbar.php"; ?>

<div class="content">
  <div class="update-form">
    <form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="form-group">
        <img src="<?php echo BASE_URL; ?>/src/uploads/<?php echo $post['image']; ?>" alt="<?php echo $post['image']; ?>">
      </div>
      <div class="form-group">
        <input type="file" name="image">
      </div>
      <div class="form-group">
        <textarea name="content"><?php echo $post['content']; ?></textarea>
      </div>
      <div class="form-group">
        <input type="submit" name="update" value="Update">
      </div>
    </form>
  </div>
</div>

<?php require_once VIEW_ROOT . "/includes/footer.php"; ?>