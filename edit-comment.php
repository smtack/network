<?php
require_once 'src/init.php';

$user = new User($db);
$post = new Post($db);

if(!loggedIn()) {
  redirect('index');
} else if(!$user_info = $user->getUser($_SESSION['user'])) {
  redirect('index');
} else if(!isset($_GET['query'])) {
  redirect(404);
} else if(!$comment_data = $post->getComment(escape($_GET['query']))) {
  redirect(404);
} else if($comment_data->comment_by !== $user_info->user_id) {
  redirect('home');
}

if(isset($_POST['edit_comment'])) {
  if(!check($_POST['token'], 'token')) {
    $error = "Token Invalid";
  } else if(empty($_POST['comment_text'])) {
    $error = "Enter a comment";
  } else {
    $data = [
      'comment_text' => escape($_POST['comment_text'])
    ];

    if($post->editComment($data, $comment_data->comment_id)) {
      redirect('post/' . $comment_data->comment_post);
    } else {
      $error = "Unable to edit comment. Try again later.";
    }
  }
}

$page_title = "Edit Comment";

require VIEW_ROOT . '/edit-comment.php';