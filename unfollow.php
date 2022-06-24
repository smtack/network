<?php
require_once 'src/init.php';

$user = new User($db);

if(!loggedIn()) {
  redirect('index');
} else {
  $user_info = $user->getUser($_SESSION['user']);
}

if(!isset($_GET['query'])) {
  redirect('home');
} else if($_GET['query'] === $user_info->user_id) {
  redirect('home');
} else {
  $followed_user = $user->getUser(escape($_GET['query']));

  $data = [
    'follow_user' => $user_info->user_id,
    'follow_follow' => $followed_user->user_id
  ];

  if($user->unfollow($data)) {
    redirect('profile/' . $followed_user->user_username);
  } else {
    redirect('home');
  }
}