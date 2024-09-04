<?php
require_once "config.php";
require_once "functions.php";

spl_autoload_register(function($class) {
  include_once "classes/$class.php";
});

// set_error_handler('errorHandler');
ini_set("display_errors", "on");
error_reporting(E_ALL);

session_start();

$db = new Database();

$db->connect();

$allowed_types = ['jpg', 'jpeg', 'png', 'webp', 'jfif'];