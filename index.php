<?php
require_once 'src/init.php';

$user = new User($db);

if(isset($_SESSION['user'])) {
  redirect('home');
}

if(isset($_POST['signup'])) {
  if(!check($_POST['token'], 'token')) {
    $error = "Token Invalid";
  } else if(empty($_POST['user_name']) || empty($_POST['user_username']) || empty($_POST['user_email']) || empty($_POST['user_password']) || empty($_POST['confirm_password'])) {
    $error = "Fill in all fields";
  } else if($db->exists('users', array('user_username' => $_POST['user_username']))) {
    $error = "This username already exists";
  } else if($db->exists('users', array('user_email' => $_POST['user_email']))) {
    $error = "This email address is already in use";
  } else if($_POST['user_password'] !== $_POST['confirm_password']) {
    $error = "Passwords must match";
  } else {
    $data = [
      'user_name' => escape($_POST['user_name']),
      'user_username' => escape($_POST['user_username']),
      'user_email' => escape($_POST['user_email']),
      'user_password' => password_hash($_POST['user_password'], PASSWORD_BCRYPT)
    ];

    if($user->createUser($data)) {
      $_SESSION['user'] = $data['user_username'];
      
      redirect('home');
    } else {
      $error = "Unable to sign up. Try again later.";
    }
  }
}

$page_title = "Sign Up";

require VIEW_ROOT . '/index.php';