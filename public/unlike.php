<?php
require_once '../src/init.php';

$user = new User($db);
$post = new Post($db);

if(!loggedIn()) {
  redirect('index');
} else {
  $user_info = $user->getUser($_SESSION['user']);
}

if(!isset($_GET['query'])) {
  redirect('home');
} else {
  $liked_post = $post->getPost(escape($_GET['query']));

  $data = [
    'like_user' => $user_info->user_id,
    'like_post' => $liked_post->post_id
  ];

  if($post->unlike($data)) {
    redirect('post/' . $liked_post->post_id);
  } else {
    redirect('post/' . $liked_post->post_id);
  }
}