<?php
require_once 'src/init.php';

$user = new User($db);

if(!loggedIn()) {
    redirect('index');
} else {
    $user_info = $user->getUser($_SESSION['user']);
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

        if($user->friend($data)) {
            redirect();
        } else {
            redirect();
        }
    }
}