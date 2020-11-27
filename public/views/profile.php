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
    <h2><?php echo $user_name; ?></h2>
  </div>

  <div class="posts">
    <?php
      foreach($posts as $post) {
        echo("
          <div class='post'>
            <p id='content'>{$post['content']}</p>
            <p id='datetime'>{$post['datetime']}</p>
          </div>
        ");
      }
    ?>
  </div>
</div>

<?php require_once VIEW_ROOT . "/includes/footer.php"; ?>