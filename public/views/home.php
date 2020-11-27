<?php require_once VIEW_ROOT . "/includes/header.php"; ?>

<div class="header">
  <h1><a href="<?php echo BASE_URL; ?>/src/home.php">Network</a></h1>

  <span id="search">
    <form action="<?php echo BASE_URL; ?>/src/search.php" method="GET">
      <input type="text" name="search" placeholder="Search">
    </form>
  </span>

  <a href="<?php echo BASE_URL; ?>/src/logout.php">Log out</a>
</div>

<div class="content">
  <div class="create">
    <form action="<?php echo BASE_URL; ?>/src/create.php" method="POST">
      <div class="form-group">
        <h2>Make a post</h2>
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
    <?php
      foreach($posts as $post) {
        echo("
          <div class='post'>
            <p id='content'>{$post['content']}</p>
            <p id='datetime'>{$post['datetime']}</p>
            <span id='options'><a href='update.php?id={$post['id']}'>Update</a><a href='delete.php?id={$post['id']}'>Delete</a></span>
          </div>
        ");
      }
    ?>
  </div>
</div>

<?php require_once VIEW_ROOT . "/includes/footer.php"; ?>