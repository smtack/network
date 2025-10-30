<?php
require_once '../src/init.php';

if(!$user->isLoggedIn()) {
  redirect('index');
}

if(!isset($_GET['query'])) {
    redirect('home');
} else if($_GET['query'] === $user_info->user_id) {
    redirect('home');
} else {
    if(!$friend = $user->getUser($_GET['query'])) {
        redirect('home');
    } else {
        $data = [
            'friend_user' => $user_info->user_id,
            'friend_friend' => $friend->user_id
        ];

        if($user->unfriend($data)) {
            redirect();
        } else {
            redirect();
        }
    }
}