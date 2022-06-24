<?php
require_once 'src/init.php';

$user = new User($db);
$post = new Post($db);

if(loggedIn()) {
  $user_info = $user->getUser($_SESSION['user']);
}

$posts = $post->getPublicPosts();

$page_title = "Explore";

require VIEW_ROOT . '/explore.php';