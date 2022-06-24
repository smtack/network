<?php require_once VIEW_ROOT . '/includes/header.php'; ?>

<div class="content">
  <div class="posts page">
    <div class="heading">
      <h2>Update Profile</h2>
    </div>
    <div class="form">
      <h3>Update Info</h3>

      <form action="<?php $self; ?>" method="POST">
        <div class="form-group">
          <?php if(isset($error)): ?>
            <p class="error"><?=$error?></p>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <input type="text" name="user_name" value="<?=escape($user_info->user_name)?>" placeholder="Name">
        </div>
        <div class="form-group">
          <input type="text" name="user_username" value="<?=escape($user_info->user_username)?>" placeholder="Username">
        </div>
        <div class="form-group">
          <input type="text" name="user_email" value="<?=escape($user_info->user_email)?>" placeholder="Email Address">
        </div>
        <div class="form-group">
          <input type="hidden" name="token" value="<?=generate('token')?>">
          <input type="submit" name="update" value="Update">
        </div>
      </form>
    </div>
    <div class="form">
      <h3>Upload Profile Picture</h3>

      <form enctype="multipart/form-data" action="<?php $self; ?>" method="POST">
        <div class="form-group">
          <?php if(isset($picture_error)): ?>
            <p class="error"><?=$picture_error?></p>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <label for="post_image"><img id="upload-image" src="<?=BASE_URL?>/public/img/Image.svg" alt="Upload Image"></label>
          <input id="post_image" type="file" name="user_profile_picture">
          <p id="file-name"></p>
        </div>
        <div class="form-group">
          <input type="hidden" name="picture_token" value="<?=generate('picture_token')?>">
          <input type="submit" name="upload_profile_picture" value="Upload">
        </div>
      </form>
    </div>
    <div class="form">
      <h3>Change Password</h3>

      <form action="<?php $self; ?>" method="POST">
        <div class="form-group">
          <?php if(isset($password_error)): ?>
            <p class="error"><?=$password_error?></p>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <input type="password" name="user_password" placeholder="Current Password">
        </div>
        <div class="form-group">
          <input type="password" name="new_password" placeholder="New Password">
        </div>
        <div class="form-group">
          <input type="password" name="confirm_password" placeholder="Confirm Password">
        </div>
        <div class="form-group">
          <input type="hidden" name="password_token" value="<?=generate('password_token')?>">
          <input type="submit" name="update_password" value="Change Password">
        </div>
      </form>
    </div>
    <div class="form">
      <h3>Delete Profile</h3>

      <form action="<?php $self; ?>" method="POST">
        <div class="form-group">
          <?php if(isset($delete_error)): ?>
            <p class="error"><?=$delete_error?></p>
          <?php endif; ?>
        </div>
        <div class="form-group">
          <input type="password" name="user_password" placeholder="Password">
        </div>
        <div class="form-group">
          <input type="hidden" name="delete_token" value="<?=generate('delete_token')?>">
          <input type="submit" name="delete_profile" value="Delete Profile">
        </div>
      </form>
    </div>
  </div>
</div>

<?php require_once VIEW_ROOT . '/includes/footer.php'; ?>