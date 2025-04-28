<?php
require_once "config.php";
require_once "functions.php";

spl_autoload_register(function($class) {
  include_once "classes/$class.php";
});

// Error Reporting
ini_set("display_errors", "On");
ini_set("display_startup_errors", "On");
ini_set('log_errors', 'On');

error_reporting(E_ALL);
// set_error_handler('errorHandler');

session_start();

$db = new Database();

$db->connect();

$allowed_types = ['jpg', 'jpeg', 'png', 'webp', 'jfif'];