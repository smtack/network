<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<?php require_once VIEW_ROOT . '/includes/navbar.php'; ?>

<div class="container">
  <div class="heading">
    <h2>Update Profile</h2>
  </div>

  <div class="form">
    <h2>Update Profile Information</h2>

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
            <input type="text" class="form-control" id="user_firstname" name="user_firstname" value="<?= escape($user_info->user_firstname) ?>" placeholder="First name">
          </div>
          <div class="col">
            <label for="user_surname" class="form-label visually-hidden">Surname</label>
            <input type="text" class="form-control" id="user_surname" name="user_surname" value="<?= escape($user_info->user_surname) ?>" placeholder="Surname">
          </div>
        </div>
      </div>
      <div class="mb-3">
        <label for="user_username" class="form-label visually-hidden">Username</label>
        <input type="text" class="form-control" id="user_username" name="user_username" value="<?= escape($user_info->user_username) ?>" placeholder="Username">
      </div>
      <div class="mb-3">
        <label for="user_email" class="form-label visually-hidden">Email Address</label>
        <input type="email" class="form-control" id="user_email" name="user_email" value="<?= escape($user_info->user_email) ?>" placeholder="Email address">
      </div>
      <div>
        <input type="hidden" name="token" value="<?= generate('token') ?>">
        <button type="submit" name="update" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>

  <div class="form">
    <h2>Update Bio</h2>

    <form action="<?php self() ?>" method="POST">
      <div class="mb-3">
        <?php if(isset($bio_error)): ?>
          <p class="error"><?= $bio_error ?></p>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="user_bio" class="form-label visually-hidden">Bio</label>
        <textarea class="form-control" id="user_bio" name="user_bio" rows="5" placeholder="Write something about yourself..."><?= ($user_info->user_bio) ? $user_info->user_bio : '' ?></textarea>
        <p id="counter-text"><span id="counter"></span>/250</p>
      </div>
      <div>
        <input type="hidden" name="bio_token" value="<?= generate('bio_token') ?>">
        <button type="submit" id="submit" name="update_bio" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>

  <div class="form">
    <h2>Update Profile Picture</h2>

    <form enctype="multipart/form-data" action="<?php self() ?>" method="POST">
      <div class="mb-3">
        <?php if(isset($picture_error)): ?>
          <p class="error"><?= $picture_error ?></p>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="post_image" class="form-label visually-hidden">Image</label>
        <input class="form-control form-control-lg" id="post_image" type="file" name="user_profile_picture">
        <p id="file-name"></p>
      </div>
      <div>
        <input type="hidden" name="picture_token" value="<?= generate('picture_token') ?>">
        <button type="submit" name="upload_profile_picture" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>

  <div class="form">
    <h2>Change Password</h2>

    <form action="<?php self() ?>" method="POST">
      <div class="mb-3">
        <?php if(isset($password_error)): ?>
          <p class="error"><?= $password_error ?></p>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="user_password" class="form-label visually-hidden">Current Password</label>
        <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password">
      </div>
      <div class="mb-3">
        <label for="new_password" class="form-label visually-hidden">New Password</label>
        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New password">
      </div>
      <div class="mb-3">
        <label for="confirm_password" class="form-label visually-hidden">Confirm Password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password">
      </div>
      <div>
        <input type="hidden" name="password_token" value="<?= generate('password_token') ?>">
        <button type="submit" name="update_password" class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>

  <div class="form">
    <h2>Delete Profile</h2>

    <form action="<?php self() ?>" method="POST">
      <div class="mb-3">
        <?php if(isset($delete_error)): ?>
          <p class="error"><?= $delete_error ?></p>
        <?php endif; ?>
      </div>
      <div class="mb-3">
        <label for="user_password" class="form-label visually-hidden">Password</label>
        <input type="password" class="form-control" id="user_password" name="user_password" placeholder="Password">
      </div>
      <div>
        <input type="hidden" name="delete_token" value="<?= generate('delete_token') ?>">
        <button type="submit" name="delete_profile" class="btn btn-primary">Delete Profile</button>
      </div>
    </form>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>