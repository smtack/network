<?php require_once VIEW_ROOT . "/includes/header.php"; ?>

<div class="content">
  <div class="logo">
    <h1>Network</h1>
  </div>

  <div class="form">
    <form action="<?php echo BASE_URL; ?>/src/signup.php" method="POST">
      <div class="form-group">
        <input type="text" name="name" placeholder="Name">
      </div>
      <div class="form-group">
        <input type="text" name="email" placeholder="Email">
      </div>
      <div class="form-group">
        <input type="password" name="password" placeholder="Password">
      </div>
      <div class="form-group">
        <input type="submit" name="signup" value="Sign Up">
      </div>
      <div class="form-group">
        <a href="<?php echo BASE_URL; ?>/src/login.php">Already have an account? Log in</a>
      </div>
    </form>
  </div>
</div>

<?php require_once VIEW_ROOT . "/includes/footer.php"; ?>