<?php
require_once '../src/init.php';

$post = new Post($db);

if(!isset($_GET['query'])) {
  redirect('home');
} else if(!$post_data = $post->getPost(escape($_GET['query']))) {
  redirect(404);
}

$post_user = $user->getUser($post_data->post_profile);

$likes_data = $post->getLikesData($post_data->post_id);

$comments = $post->getComments($post_data->post_id);

if(isset($_POST['post_comment'])) {
  if(!check($_POST['token'], 'token')) {
    $error = "Token Invalid";
  } else if(empty($_POST['comment_text'])) {
    $error = "Enter a comment";
  } else {
    $data = [
      'comment_text' => escape($_POST['comment_text']),
      'comment_post' => $post_data->post_id,
      'comment_by' => $user_info->user_id
    ];

    if($post->createComment($data)) {
      redirect('post/' . $post_data->post_id);
    } else {
      $error = "Unable to post comment";
    }
  }
}

$page_title = "Post by " . $post_data->user_name;

require VIEW_ROOT . '/post.php';