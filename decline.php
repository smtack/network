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
} else {
    if(!$friend = $user->getUser(escape($_GET['query']))) {
        redirect('home');
    } else {
        if($user->declineFriendRequest($friend->user_id, $user_info->user_id)) {
            redirect();
        } else {
            redirect();
        }
    }
}