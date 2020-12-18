<?php require_once VIEW_ROOT . "/includes/header.php"; ?>

<div class="header">
  <h1><a href="<?php echo BASE_URL; ?>/src/home.php">Network</a></h1>

  <div class="opts">
    <img class="search-toggle" src="<?php echo BASE_URL; ?>/img/search.png">
    <img class="settings-toggle" src="<?php echo BASE_URL; ?>/img/settings.png">

    <div class="search">
      <form action="<?php echo BASE_URL; ?>/src/search.php" method="GET">
        <input type="text" name="search" placeholder="Search">
      </form>
    </div>

    <div class="settings">
      <ul>
        <li><a href="<?php echo BASE_URL; ?>/src/logout.php">Log out</a></li>
      </ul>
  </div>
</div>

<div class="content">
  <div class="update-form">
    <div class="post">
      <p id='content'><?php echo $post_data['content']; ?></p>
      <p id='datetime'><?php echo $post_data['datetime']; ?></p>
    </div>
  </div>
</div>

<?php require_once VIEW_ROOT . "/includes/footer.php"; ?>