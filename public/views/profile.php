<?php require_once VIEW_ROOT . "/includes/header.php"; ?>

<?php require_once VIEW_ROOT . "/includes/navbar.php"; ?>

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