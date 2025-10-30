<?php
require_once '../src/init.php';

$post = new Post($db);

if(!$user->isLoggedIn()) {
  redirect('index');
}

if(!isset($_GET['query']) || empty($_GET['query'])) {
  redirect('index');
} else {
  if(!$profile_info = $user->getUser(escape($_GET['query']))) {
    redirect(404);
  } else {
    $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;

    $start = ($page > 1) ? ($page * 10) - 10 : 0;

    $posts = $post->getProfilePosts($profile_info->user_id, $start);

    $total = $db->pdo->query("SELECT FOUND_ROWS() as total")->fetch()->total;

    $pages = ceil($total / 10);

    $friendsOf = $user->friendsOf($profile_info->user_id);
    $friendsTo = $user->friendsTo($profile_info->user_id);

    $friends = (object) array_merge((array) $friendsOf, (array) $friendsTo); 
  }
}

if(isset($_POST['submit'])) {
  if(!check($_POST['token'], 'token')) {
    $error = "Token Invalid";
  } else if(empty($_POST['post_content'])) {
    $error = "Enter some text";
  } else {
    $data = [
      'post_content' => escape($_POST['post_content']),
      'post_profile' => $profile_info->user_id,
      'post_by' => $user_info->user_id
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
        }
      }
    }

    if($post->createPost($data)) {
      redirect('profile/' . $profile_info->user_username);
    } else {
      $error = "Unable to make post";
    }
  }
}

$page_title = $profile_info->user_name . "'s Profile";

require VIEW_ROOT . '/profile.php';