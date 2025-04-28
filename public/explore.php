<?php
require_once '../src/init.php';

$user = new User($db);
$post = new Post($db);

if(loggedIn()) {
  $user_info = $user->getUser($_SESSION['user']);
} else {
  redirect('index');
}

$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;

$start = ($page > 1) ? ($page * 10) - 10 : 0;

$posts = $post->getPublicPosts($start);

$total = $db->pdo->query("SELECT FOUND_ROWS() as total")->fetch()->total;

$pages = ceil($total / 10);

$page_title = "Explore";

require VIEW_ROOT . '/explore.php';