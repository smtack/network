<?php
require_once '../src/init.php';

$user = new User($db);
$post = new Post($db);

if(!isset($_SESSION['user'])) {
  redirect('index');
} else {
  $user_info = $user->getUser($_SESSION['user']);

  $page = isset($_GET['p']) ? (int)$_GET['p'] : 1;

  $start = ($page > 1) ? ($page * 10) - 10 : 0;

  $posts = $post->getHomepagePosts($user_info->user_id, $start);
  
  $total = $db->pdo->query("SELECT FOUND_ROWS() as total")->fetch()->total;

  $pages = ceil($total / 10);

  $friendsOf = $user->friendsOf($user_info->user_id);
  $friendsTo = $user->friendsTo($user_info->user_id);

  $friends = (object) array_merge((array) $friendsOf, (array) $friendsTo);
}

require VIEW_ROOT . '/home.php';