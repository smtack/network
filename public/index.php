<?php
require_once '../src/init.php';

if($user->isLoggedIn()) {
  redirect('home');
}

if(isset($_POST['signup'])) {
  if(!check($_POST['token'], 'token')) {
    $error = "Token Invalid";
  } else if(empty($_POST['user_firstname']) || empty($_POST['user_surname']) || empty($_POST['user_username']) || empty($_POST['user_email']) || empty($_POST['user_password']) || empty($_POST['confirm_password'])) {
    $error = "Fill in all fields";
  } else if($db->exists('users', array('user_username' => $_POST['user_username']))) {
    $error = "This username already exists";
  } else if($db->exists('users', array('user_email' => $_POST['user_email']))) {
    $error = "This email address is already in use";
  } else if($_POST['user_password'] !== $_POST['confirm_password']) {
    $error = "Passwords must match";
  } else {
    $data = [
      'user_firstname' => $_POST['user_firstname'],
      'user_surname' => $_POST['user_surname'],
      'user_username' => $_POST['user_username'],
      'user_email' => $_POST['user_email'],
      'user_password' => $_POST['user_password']
    ];

    if(!$user->register($data)) {
      $error = "Unable to sign up. Try again later.";
    } else {
      redirect('home');
    }
  }
}

$page_title = "Sign Up";

require VIEW_ROOT . '/index.php';