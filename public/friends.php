<?php
require_once '../src/init.php';

if(!$user->isLoggedIn()) {
    redirect('index');
}

$requests = $user->getFriendRequests($user_info->user_id);

$friendsOf = $user->friendsOf($user_info->user_id);
$friendsTo = $user->friendsTo($user_info->user_id);

$friends = (object) array_merge((array) $friendsOf, (array) $friendsTo);

$page_title = "Your Friends";

require VIEW_ROOT . '/friends.php';