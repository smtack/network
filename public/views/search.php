<?php require_once VIEW_ROOT . "/includes/header.php"; ?>

<?php require_once VIEW_ROOT . "/includes/navbar.php"; ?>

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