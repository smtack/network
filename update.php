<?php
require_once 'src/init.php';

$user = new User($db);

if(isset($_SESSION['user'])) {
  $user_info = $user->getUser($_SESSION['user']);
} else {
  redirect('index');
}

if(isset($_POST['update'])) {
  if(empty($_POST['user_name']) || empty($_POST['user_username']) || empty($_POST['user_email'])) {
    $error = "Fill in all fields";
  } else if($db->exists('users', array('user_username' => $_POST['user_username'])) && $_POST['user_username'] !== $user_info->user_username) {
    $error = "This username already exists";
  } else if($db->exists('users', array('user_email' => $_POST['user_email'])) && $_POST['user_email'] !== $user_info->user_email) {
    $error = "This email address is already in use";
  } else {
    $data = [
      'user_name' => escape($_POST['user_name']),
      'user_username' => escape($_POST['user_username']),
      'user_email' => escape($_POST['user_email'])
    ];

    if($user->updateProfile($data, $user_info->user_id)) {
      $_SESSION['user'] = $data['user_username'];
      
      redirect('update');
    } else {
      $error = "Unable to update profile";
    }
  }
}

if(isset($_POST['upload_profile_picture'])) {
  if(empty($_FILES['user_profile_picture']['name'])) {
    $picture_error = "Select an image to upload";
  } else {
    $target_dir = "uploads/profile-pictures/";
    $file_name = basename($_FILES['user_profile_picture']['name']);
    $path = $target_dir . $file_name;
    $file_type = pathinfo($path, PATHINFO_EXTENSION);
    $allow_types = array('jpg', 'png');

    if(!in_array($file_type, $allow_types)) {
      $picture_error = "This file type is not supported";
    } else if(!move_uploaded_file($_FILES['user_profile_picture']['tmp_name'], $path)) {
      $picture_error = "Unable to upload profile picture. Try again later.";
    } else {
      $data = ['user_profile_picture' => escape($file_name)];

      if($user->updateProfile($data, $user_info->user_id)) {
        redirect('update');
      } else {
        $picture_error = "Unable to upload profile picture. Try again later.";
      }
    }
  }
}

if(isset($_POST['update_password'])) {
  if(empty($_POST['user_password']) || empty($_POST['new_password']) || empty($_POST['confirm_password'])) {
    $password_error = "Fill in all fields";
  } else if(!password_verify($_POST['user_password'], $user_info->user_password)) {
    $password_error = "Enter your current password correctly";
  } else if($_POST['new_password'] !== $_POST['confirm_password']) {
    $password_error = "Passwords must match";
  } else {
    $data = ['user_password' => password_hash($_POST['new_password'], PASSWORD_BCRYPT)];

    if($user->updatePassword($data, $user_info->user_id)) {
      redirect('update');
    } else {
      $password_error = "Unable to change password";
    }
  }
}

if(isset($_POST['delete_profile'])) {
  if(empty($_POST['user_password'])) {
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