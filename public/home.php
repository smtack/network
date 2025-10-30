<?php
require_once '../src/init.php';

$post = new Post($db);

if(!$user->isLoggedIn()) {
  redirect('index');
}

$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;

$start = ($page > 1) ? ($page * 10) - 10 : 0;

$posts = $post->getHomepagePosts($user_info->user_id, $start);

$total = $db->pdo->query("SELECT FOUND_ROWS() as total")->fetch()->total;

$pages = ceil($total / 10);

$friendsOf = $user->friendsOf($user_info->user_id);
$friendsTo = $user->friendsTo($user_info->user_id);

$friends = (object) array_merge((array) $friendsOf, (array) $friendsTo);

require VIEW_ROOT . '/home.php';