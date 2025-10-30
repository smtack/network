<?php
require_once '../src/init.php';

if(!$user->isLoggedIn()) {
    redirect('index');
}

if(!isset($_GET['query'])) {
    redirect('home');
} else {
    if(!$friend = $user->getUser(escape($_GET['query']))) {
        redirect('home');
    } else {
        if($user->acceptFriendRequest($friend->user_id, $user_info->user_id)) {
            redirect('profile/' . $friend->user_username);
        } else {
            redirect();
        }
    }
}