<?php
require_once 'src/init.php';

$user = new User($db);

if(!loggedIn()) {
    redirect('index');
} else {
    $user_info = $user->getUser($_SESSION['user']);
}

$requests = $user->getFriendRequests($user_info->user_id);

$friendsOf = $user->friendsOf($user_info->user_id);
$friendsTo = $user->friendsTo($user_info->user_id);

$friends = (object) array_merge((array) $friendsOf, (array) $friendsTo);

$page_title = "Your Friends";

require VIEW_ROOT . '/friends.php';