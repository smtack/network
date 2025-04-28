<?php
require_once '../src/init.php';

$user = new User($db);

if(loggedIn()) {
  $user_info = $user->getUser($_SESSION['user']);
} else {
  redirect('index');
}

$keywords = isset($_GET['s']) ? escape($_GET['s']) : '';
$keywords = "%{$keywords}%";

$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;

$start = ($page > 1) ? ($page * 10) - 10 : 0;

$results = $user->search($keywords, $start);

$total = $db->pdo->query("SELECT FOUND_ROWS() as total")->fetch()->total;

$pages = ceil($total / 10);

$page_title = "Search: " . str_replace('%', '', $keywords);

require VIEW_ROOT . '/search.php';