<?php require_once VIEW_ROOT . "/includes/header.php"; ?>

<div class="header">
  <h1><a href="<?php echo BASE_URL; ?>/src/home.php">Network</a></h1>

  <span id="search">
    <form action="<?php echo BASE_URL; ?>/src/search.php" method="GET">
      <input type="text" name="search" value="<?php echo $keywords; ?>">
    </form>
  </span>

  <a href="logout.php">Log out</a>
</div>

<div class="content">
  <div class="users">
    <?php
      if($users > 0) {
        foreach($users as $user) {
          echo("
            <div class='user'>
              <h3 id='user-name'><a href='profile.php?id={$user['name']}'>{$user['name']}</a></h3>
            </div>
          ");
        }
      }
    ?>
  </div>
</div>

<?php require_once VIEW_ROOT . "/includes/footer.php"; ?>