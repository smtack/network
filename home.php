<?php
require_once 'src/init.php';

$user = new User($db);
$post = new Post($db);

if(!isset($_SESSION['user'])) {
  redirect('index');
} else {
  $user_info = $user->getUser($_SESSION['user']);

  $posts = $post->getHomepagePosts($user_info->user_id);

  $follows = $user->getUsersFollows($user_info->user_id);
}

require VIEW_ROOT . '/home.php';