<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="container">
  <h1 id="logo"><a href="<?= base_url() ?>">network</a></h1>

  <div class="form">
    <h2>Log in</h2>

    <form action="<?php self() ?>" method="POST">
      <div class="mb-3">
        <?php if(isset($error)): ?>
          <p class="error"><?= $error ?></p>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="user_username" class="form-label visually-hidden">Username</label>
        <input type="text" class="form-control" id="user_username" name="user_username" placeholder="Username">
      </div>
      <div class="mb-3">
        <label for="user_password" class="form-label visually-hidden">Password</label>
        <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password">
      </div>
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" value="" id="remember" name="remember">
        <label class="form-check-label" for="remember">
          Remember Me
        </label>
      </div>
      <div class="mb-3">
        <input type="hidden" name="token" value="<?= generate('token') ?>">
        <button type="submit" name="login" class="btn btn-primary">Log In</button>
      </div>
      <div>
        <p>Don't have an account? <a href="<?= base_url() ?>">Sign Up</a></p>
      </div>
    </form>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>