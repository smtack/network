<?php require_once VIEW_ROOT . "/includes/header.php"; ?>

<div class="header">
  <h1><a href="<?php echo BASE_URL; ?>/src/home.php">Network</a></h1>
  <a href="logout.php">Log out</a>
</div>

<div class="content">
  <div class="update-form">
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
      <div class="form-group">
        <textarea name="content"><?php echo $post['content']; ?></textarea>
      </div>
      <div class="form-group">
        <input type="submit" name="update" value="Update">
      </div>
    </form>
  </div>
</div>

<?php require_once VIEW_ROOT . "/includes/header.php"; ?>