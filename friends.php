<?php
require_once 'src/init.php';

$user = new User($db);

if(!loggedIn()) {
    redirect('index');
} else {
    $user_info = $user->getUser($_SESSION['user']);
}

$requests = $user->getFriendRequests($user_info->user_id);

$friendsOfMine = $user->friendsOfMine($user_info->user_id);
$friendOf = $user->friendOf($user_info->user_id);

$friends = (object) array_merge((array) $friendsOfMine, (array) $friendOf);

$page_title = "Your Friends";

require VIEW_ROOT . '/friends.php';