<?php
require_once 'src/init.php';

$user = new User($db);
$post = new Post($db);

if(loggedIn()) {
  $user_info = $user->getUser($_SESSION['user']);
}

if(!isset($_GET['u']) || empty($_GET['u'])) {
  redirect('index');
} else {
  if(!$profile_info = $user->getUser(escape($_GET['u']))) {
    redirect(404);
  } else {
    $posts = $post->getProfilePosts($profile_info->user_id);
    $follows_data = $user->getFollowsData($profile_info->user_id);
  }
}

if(isset($_POST['submit'])) {
  if(empty($_POST['post_content'])) {
    $error = "Enter some text";
  } else {
    $data = [
      'post_content' => escape($_POST['post_content']),
      'post_profile' => $profile_info->user_id,
      'post_by' => $user_info->user_id
    ];

    if($post->createPost($data)) {
      redirect('profile?u=' . $profile_info->user_username);
    } else {
      $error = "Unable to make post";
    }
  }
}

$page_title = $profile_info->user_name . "'s Profile";

require VIEW_ROOT . '/profile.php';