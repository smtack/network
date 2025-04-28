<?php
require_once '../src/init.php';

$user = new User($db);
$post = new Post($db);

if(!loggedIn()) {
  redirect('index');
} else if(!$user_info = $user->getUser($_SESSION['user'])) {
  redirect('index');
} else if(!isset($_GET['query'])) {
  redirect(404);
} else if(!$post_data = $post->getPost(escape($_GET['query']))) {
  redirect(404);
} else if($post_data->post_by !== $user_info->user_id) {
  redirect('home');
}

if(isset($_POST['edit'])) {
  if(!check($_POST['token'], 'token')) {
    $error = "Token Invalid";
  } else if(empty($_POST['post_content'])) {
    $error = "Enter some text";
  } else {
    if(!empty($_FILES['post_image']['name'])) {
      $target_dir = "uploads/post-images/";
      $file_name = basename($_FILES['post_image']['name']);
      $path = $target_dir . $file_name;
      $file_type = pathinfo($path, PATHINFO_EXTENSION);
      $allow_types = array('jpg', 'png', 'gif');

      if(!in_array($file_type, $allow_types)) {
        $error = "This fiule type is not supported";
      } else if(!move_uploaded_file($_FILES['post_image']['tmp_name'], $path)) {
        $error = "Unable to upload image. Try again later.";
      } else {
        $data = [
          'post_content' => escape($_POST['post_content']),
          'post_image' => escape($file_name)
        ];

        if($post->editPost($data, $post_data->post_id)) {
          redirect('post/' . $post_data->post_id);
        } else {
          $error = "Unable to edit post. Try again later.";
        }
      }
    } else {
      $data = [
        'post_content' => escape($_POST['post_content'])
      ];
  
      if($post->editPost($data, $post_data->post_id)) {
        redirect('post/' . $post_data->post_id);
      } else {
        $error = "Unable to edit post. Try again later.";
      }
    }
  }
}

if(isset($_POST['delete'])) {
  if(!check($_POST['delete_token'], 'delete_token')) {
    $delete_error = "Token Invalid";
  } else {
    $image_dir = "uploads/post-images/";
    $file_to_delete = $image_dir . $post_data->post_image;
  
    if($post->deletePost($post_data->post_id)) {
      if(file_exists($file_to_delete)) {
        unlink($file_to_delete);
      }
      
      redirect('home');
    } else {
      $delete_error = "Unable to delete post. Try again later.";
    }
  }
}

$page_title = "Edit Post";

require VIEW_ROOT . '/edit.php';