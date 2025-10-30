<?php
require_once '../src/init.php';

$post = new Post($db);

if(!$user->isLoggedIn()) {
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
    $data = [
      'post_content' => escape($_POST['post_content'])
    ];

    if(!empty($_FILES['post_image']['name'])) {
      $target_dir = "../uploads/post-images/";
      $file_name = basename($_FILES['post_image']['name']);
      $path = $target_dir . $file_name;
      $ext = pathinfo($path, PATHINFO_EXTENSION);

      if(!in_array($ext, $allowed_types)) {
        $error = "This file type is not supported";
      } else {
        $unique_filename = createUniqueFilename($file_name);

        $new_path = $target_dir . $unique_filename . '.' . $ext;
        $new_filename = $unique_filename . '.' . $ext;

        if(!move_uploaded_file($_FILES['post_image']['tmp_name'], $new_path)) {
          $error = "Unable to upload image. Try again later.";
        } else {
          $data += [
            'post_image' => $new_filename,
          ];

          $old_filename = $target_dir . $post_data->post_image;

          if(file_exists($old_filename)) {
            unlink($old_filename);
          }
        }
      }
    }

    if($post->editPost($data, $post_data->post_id)) {
      redirect('post/' . $post_data->post_id);
    } else {
      $error = "Unable to edit post. Try again later.";
    }
  }
}

if(isset($_POST['delete'])) {
  if(!check($_POST['delete_token'], 'delete_token')) {
    $delete_error = "Token Invalid";
  } else {
    $image_dir = "../uploads/post-images/";
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