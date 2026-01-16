<?php
require_once '../src/init.php';

if(!$user->isLoggedIn()) {
  redirect('index');
}

if(isset($_POST['update'])) {
  if(!check($_POST['token'], 'token')) {
    $error = "Token Invalid";
  } else if(empty($_POST['user_firstname']) || empty($_POST['user_surname']) || empty($_POST['user_username']) || empty($_POST['user_email'])) {
    $error = "Fill in all fields";
  } else if($db->exists('users', array('user_username' => $_POST['user_username'])) && $_POST['user_username'] !== $user_info->user_username) {
    $error = "This username already exists";
  } else if($db->exists('users', array('user_email' => $_POST['user_email'])) && $_POST['user_email'] !== $user_info->user_email) {
    $error = "This email address is already in use";
  } else {
    $data = [
      'user_firstname' => escape($_POST['user_firstname']),
      'user_surname' => escape($_POST['user_surname']),
      'user_username' => escape($_POST['user_username']),
      'user_email' => escape($_POST['user_email'])
    ];

    if($user->updateProfile($data, $user_info->user_id)) {
      redirect('update');
    } else {
      $error = "Unable to update profile";
    }
  }
}

if(isset($_POST['update_bio'])) {
  if(!check($_POST['bio_token'], 'bio_token')) {
    $bio_error = "Token Invalid";
  } else if(empty($_POST['user_bio'])) {
    $bio_error = "Enter some text";
  } else {
    $data = [
      'user_bio' => escape($_POST['user_bio'])
    ];

    if($user->updateProfile($data, $user_info->user_id)) {
      redirect('update');
    } else {
      $bio_error = "Unable to update bio";
    }
  }
}

if(isset($_POST['upload_profile_picture'])) {
  if(!check($_POST['picture_token'], 'picture_token')) {
    $picture_error = "Token Invalid";
  } else if(empty($_FILES['user_profile_picture']['name'])) {
    $picture_error = "Select an image to upload";
  } else {
    $target_dir = "../uploads/profile-pictures/";
    $file_name = basename($_FILES['user_profile_picture']['name']);
    $path = $target_dir . $file_name;
    $ext = pathinfo($path, PATHINFO_EXTENSION);

    if(!in_array($ext, $allowed_types)) {
      $picture_error = "This file type is not supported";
    } else {
      $unique_filename = createUniqueFilename($file_name);

      $new_path = $target_dir . $unique_filename . '.' . $ext;
      $new_filename = $unique_filename . '.' . $ext;

      if(!move_uploaded_file($_FILES['user_profile_picture']['tmp_name'], $new_path)) {
        $picture_error = "Unable to upload profile picture. Try again later.";
      } else {
        $data = ['user_profile_picture' => $new_filename];

        $old_filename = $target_dir . $user_info->user_profile_picture;

        if(file_exists($old_filename)) {
          if($old_filename !== $target_dir . 'default.png') {
            unlink($old_filename);
          }
        }

        if($user->updateProfile($data, $user_info->user_id)) {
          redirect('update');
        } else {
          $picture_error = "Unable to upload profile picture. Try again later.";
        }
      }
    }
  }
}

if(isset($_POST['update_password'])) {
  if(!check($_POST['password_token'], 'password_token')) {
    $password_error = "Token Invalid";
  } else if(empty($_POST['user_password']) || empty($_POST['new_password']) || empty($_POST['confirm_password'])) {
    $password_error = "Fill in all fields";
  } else if(!password_verify($_POST['user_password'], $user_info->user_password)) {
    $password_error = "Enter your current password correctly";
  } else if($_POST['new_password'] !== $_POST['confirm_password']) {
    $password_error = "Passwords must match";
  } else {
    $data = ['user_password' => password_hash($_POST['new_password'], PASSWORD_BCRYPT)];

    if($user->updateProfile($data, $user_info->user_id)) {
      redirect('update');
    } else {
      $password_error = "Unable to change password";
    }
  }
}

if(isset($_POST['delete_profile'])) {
  if(!check($_POST['delete_token'], 'delete_token')) {
    $delete_error = "Token Invalid";
  } else if(empty($_POST['user_password'])) {
    $delete_error = "Enter your password";
  } else if(!password_verify($_POST['user_password'], $user_info->user_password)) {
    $delete_error = "Enter your password correctly";
  } else {
    if($user->deleteProfile($user_info->user_id)) {
      $user->logout();

      redirect('index');
    } else {
      $delete_error = "Unable to delete profile. Try again later.";
    }
  }
}

$page_title = "Update Profile";

require VIEW_ROOT . '/update.php';