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
  redirect(404);
} else if($post_data->post_by !== $user_info->user_id) {
  redirect('home');
}

if(isset($_POST['edit'])) {
  if(empty($_POST['post_content'])) {
    $error = "Enter some text";
  } else {
    $data = [
      'post_content' => escape($_POST['post_content'])
    ];

    if($post->editPost($data, $post_data->post_id)) {
      redirect('post?p=' . $post_data->post_id);
    } else {
      $error = "Unable to edit post. Try again later.";
    }
  }
}

$page_title = "Edit Post";

require VIEW_ROOT . '/edit.php';