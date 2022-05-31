<?php
require_once 'src/init.php';

$user = new User($db);
$post = new Post($db);

if(!loggedIn()) {
  redirect('index');
} else if(!$user_info = $user->getUser($_SESSION['user'])) {
  redirect('index');
} else if(!isset($_GET['p'])) {
  redirect(404);
} else if(!$post_data = $post->getPost(escape($_GET['p']))) {
  redirect('home');
} else if($post_data->post_by !== $user_info->user_id) {
  redirect('home');
} else {
  if($post->deletePost($post_data->post_id)) {
    redirect('home');
  } else {
    redirect('home');
  }
}