<?php require_once VIEW_ROOT . "/includes/header.php"; ?>

<?php require_once VIEW_ROOT . "/includes/navbar.php"; ?>

<div class="content">
  <div class="update-form">
    <div class="post">
      <div class="name">
        <span><?php echo $post_data['name']; ?>
      </div>
      <div class="image">
        <img src="<?php echo BASE_URL; ?>/src/uploads/<?php echo $post_data['image']; ?>" alt="<?php echo $post_data['image']; ?>">
      </div>
      <div class="text">
        <p><?php echo $post_data['content']; ?></p>
      </div>
      <div class="datetime">
        <span><?php echo $post_data['datetime']; ?></span>
      </div>
      <div class="options">
        <span>
          <a href='update?id=<?php echo $post_data['id']; ?>'>Update</a>
          <a href='src/delete?id=<?php echo $post_data['id']; ?>'>Delete</a>
          <a href='post?id=<?php echo $post_data['id']; ?>'>View Post</a>
        </span>
      </div>
    </div>
  </div>
</div>

<?php require_once VIEW_ROOT . "/includes/footer.php"; ?>