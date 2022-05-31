<?php
require_once 'src/init.php';

$user = new User($db);
$post = new Post($db);

if(loggedIn()) {
  $user_info = $user->getUser($_SESSION['user']);
}

if(!isset($_GET['p'])) {
  redirect('home');
} else if(!$post_data = $post->getPost(escape($_GET['p']))) {
  redirect(404);
}

$comments = $post->getComments($post_data->post_id);

if(isset($_POST['post_comment'])) {
  if(empty($_POST['comment_text'])) {
    $error = "Enter a comment";
  } else {
    $data = [
      'comment_text' => escape($_POST['comment_text']),
      'comment_post' => $post_data->post_id,
      'comment_by' => $user_info->user_id
    ];

    if($post->createComment($data)) {
      redirect('post?p=' . $post_data->post_id);
    } else {
      $error = "Unable to post comment";
    }
  }
}

$page_title = "Post by " . $post_data->user_name;

require VIEW_ROOT . '/post.php';