<?php
require_once '../src/init.php';

if($user->isLoggedIn()) {
  redirect('home');
}

if(isset($_POST['login'])) {
  if(!check($_POST['token'], 'token')) {
    $error = "Token Invalid";
  } else if(empty($_POST['user_username']) || empty($_POST['user_password'])) {
    $error = "Enter your Username and Password";
  } else {
    $data = [
      'user_username' => escape($_POST['user_username']),
      'user_password' => escape($_POST['user_password'])
    ];

    $remember = isset($_POST['remember']);

    if($user->login($data, $remember)) {
      redirect('home');
    } else {
      $error = "Username or Password Incorrect";
    }
  }
}

$page_title = "Log In";

require VIEW_ROOT . '/login.php';