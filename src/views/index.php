<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="container">
  <h1 id="logo"><a href="<?= base_url() ?>">network</a></h1>

  <div class="form">
    <h2>Create an account</h2>

    <form action="<?php self() ?>" method="POST">
      <div class="mb-3">
        <?php if(isset($error)): ?>
          <p class="error"><?= $error ?></p>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <div class="row">
          <div class="col">
            <label for="user_firstname" class="form-label visually-hidden">First Name</label>
            <input type="text" class="form-control" id="user_firstname" name="user_firstname" placeholder="First name">
          </div>
          <div class="col">
            <label for="user_surname" class="form-label visually-hidden">Surname</label>
            <input type="text" class="form-control" id="user_surname" name="user_surname" placeholder="Surname">
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label for="user_username" class="form-label visually-hidden">Username</label>
        <input type="text" class="form-control" id="user_username" name="user_username" placeholder="Username">
      </div>
      <div class="mb-3">
        <label for="user_email" class="form-label visually-hidden">Email Address</label>
        <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Email address">
      </div>
      <div class="mb-3">
        <label for="user_password" class="form-label visually-hidden">Password</label>
        <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password">
      </div>
      <div class="mb-3">
        <label for="confirm_password" class="form-label visually-hidden">Confirm Password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password">
      </div>
      <div class="mb-3">
        <input type="hidden" name="token" value="<?= generate('token') ?>">
        <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
      </div>
      <div>
        <p>Already have an account? <a href="<?= base_url('login') ?>">Login</a></p>
      </div>
    </form>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>