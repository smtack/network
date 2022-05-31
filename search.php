<?php
require_once 'src/init.php';

$user = new User($db);

if(loggedIn()) {
  $user_info = $user->getUser($_SESSION['user']);
}

$keywords = escape($_GET['s']);
$keywords = "%{$keywords}%";;

$results = $user->search($keywords);

$page_title = "Search: " . str_replace('%', '', $keywords);

require VIEW_ROOT . '/search.php';