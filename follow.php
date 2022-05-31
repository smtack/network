<?php
require_once 'src/init.php';

$user = new User($db);

if(!loggedIn()) {
  redirect('index');
} else {
  $user_info = $user->getUser($_SESSION['user']);
}

if(!isset($_GET['u'])) {
  redirect('home');
} else if($_GET['u'] === $user_info->user_id) {
  redirect('home');
} else {
  $followed_user = $user->getUser(escape($_GET['u']));

  $data = [
    'follow_user' => $user_info->user_id,
    'follow_follow' => $followed_user->user_id
  ];

  if($user->follow($data)) {
    redirect('profile?u=' . $followed_user->user_username);
  } else {
    redirect('home');
  }
}