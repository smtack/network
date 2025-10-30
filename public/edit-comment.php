<?php
require_once '../src/init.php';

$post = new Post($db);

if(!$user->isLoggedIn()) {
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

if(isset($_POST['delete_comment'])) {
  if(!check($_POST['delete_token'], 'delete_token')) {
    $delete_error = "Token Invalid";
  } else {
    if($post->deleteComment($comment_data->comment_id)) {
      redirect('post/' . $comment_data->comment_post);
    } else {
      redirect('post/' . $comment_data->comment_post);
    }
  }
}

$page_title = "Edit Comment";

require VIEW_ROOT . '/edit-comment.php';