<?php require_once VIEW_ROOT . "/includes/header.php"; ?>

<?php require_once VIEW_ROOT . "/includes/navbar.php"; ?>

<div class="content">
  <div class="create">
    <form enctype="multipart/form-data" action="<?php echo BASE_URL; ?>/src/create.php" method="POST">
      <div class="form-group">
        <h2>Make a post</h2>
      </div>
      <div class="form-group">
        <input type="file" name="image">
      </div>
      <div class="form-group">
        <textarea name="content"></textarea>
      </div>
      <div class="form-group">
        <input type="submit" name="post" value="Post">
      </div>
    </form>
  </div>

  <div class="posts">
    <?php foreach($posts as $post): ?>
      <div class="post">
        <div class="name">
          <span><?php echo $post['name']; ?>
        </div>
        <div class="image">
          <img src="<?php echo BASE_URL; ?>/src/uploads/<?php echo $post['image']; ?>" alt="<?php echo $post['image']; ?>">
        </div>
        <div class="text">
          <p><?php echo $post['content']; ?></p>
        </div>
        <div class="datetime">
          <span><?php echo $post['datetime']; ?></span>
        </div>
        <div class="options">
          <span id='options'>
            <a href='update?id=<?php echo $post['id']; ?>'>Update</a>
            <a href='src/delete.php?id=<?php echo $post['id']; ?>'>Delete</a>
            <a href='post.php?id=<?php echo $post['id']; ?>'>View Post</a>
          </span>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php require_once VIEW_ROOT . "/includes/footer.php"; ?>