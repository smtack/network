<?php
require_once '../src/init.php';

$post = new Post($db);

if(!$user->isLoggedIn()) {
  redirect('index');
}

if(!isset($_GET['query'])) {
  redirect('home');
} else {
  $liked_post = $post->getPost(escape($_GET['query']));

  $data = [
    'like_user' => $user_info->user_id,
    'like_post' => $liked_post->post_id
  ];

  if($post->like($data)) {
    redirect('post/' . $liked_post->post_id);
  } else {
    redirect('post/' . $liked_post->post_id);
  }
}