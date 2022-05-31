<?php
require_once 'src/init.php';

$user = new User($db);

$user->logout();

redirect('index');