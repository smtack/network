<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="form">
    <h3>Log In</h3>

    <form action="<?php $self; ?>" method="POST">
      <div class="form-group">
        <?php if(isset($error)): ?>
          <p class="error"><?=$error?></p>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <input type="text" name="user_username" placeholder="Username">
      </div>
      <div class="form-group">
        <input type="password" name="user_password" placeholder="Password">
      </div>
      <div class="form-group">
        <input type="hidden" name="token" value="<?=generate('token')?>">
        <input type="submit" name="login" value="Log In">
      </div>
      <div class="form-group">
        <p>Don't have an account? <a href="/">Sign Up</a></p>
      </div>
    </form>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>