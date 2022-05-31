<?php
require_once 'src/init.php';

$user = new User($db);
$post = new Post($db);

if(!loggedIn()) {
  redirect('index');
} else if(!$user_info = $user->getUser($_SESSION['user'])) {
  redirect('index');
} else if(!isset($_GET['c'])) {
  redirect(404);
} else if(!$comment_data = $post->getComment(escape($_GET['c']))) {
  redirect('home');
} else if($comment_data->comment_by !== $user_info->user_id) {
  redirect('home');
} else {
  if($post->deleteComment($comment_data->comment_id)) {
    redirect('post?p=' . $comment_data->comment_post);
  } else {
    redirect('post?p=' . $comment_data->comment_post);
  }
}