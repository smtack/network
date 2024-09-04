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
} else if(!$post_data = $post->getPost(escape($_GET['query']))) {
  redirect('home');
} else if($post_data->post_by !== $user_info->user_id) {
  redirect('home');
} else {
  $image_dir = "uploads/post-images/";
  $file_to_delete = $image_dir . $post_data->post_image;

  if($post->deletePost($post_data->post_id)) {
    if(file_exists($file_to_delete)) {
      unlink($file_to_delete);
    }
    
    redirect();
  } else {
    redirect();
  }
}