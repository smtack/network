<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="form">
    <h3>Sign Up</h3>

    <form action="<?php $self; ?>" method="POST">
      <div class="form-group">
        <?php if(isset($error)): ?>
          <p class="error"><?=$error?></p>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <input type="text" name="user_name" placeholder="Name">
      </div>
      <div class="form-group">
        <input type="text" name="user_username" placeholder="Username">
      </div>
      <div class="form-group">
        <input type="text" name="user_email" placeholder="Email Address">
      </div>
      <div class="form-group">
        <input type="password" name="user_password" placeholder="Password">
      </div>
      <div class="form-group">
        <input type="password" name="confirm_password" placeholder="Confirm Password">
      </div>
      <div class="form-group">
        <input type="hidden" name="token" value="<?=generate('token')?>">
        <input type="submit" name="signup" value="Sign Up">
      </div>
      <div class="form-group">
        <p>Already have an account? <a href="/login">Login</a></p>
      </div>
    </form>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>