<?php
// Sanitize user input
function escape($string) {
  return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

// Redirect user
function redirect($location) {
  if(is_numeric($location)) {
    switch($location) {
      case 404:
        header('HTTP/1.0 404 Not Found');

        include_once VIEW_ROOT . '/errors/404.php';

        exit();
      break;
    }
  } else {
    header('Location: /' . $location);

    exit();
  }
}

// Check if user is logged in
function loggedIn() {
  return isset($_SESSION['user']) ? true : false;
}

// Check for a value in a multidimensional array
function findValue($array, $key, $value) {
  foreach($array as $item) {
    if(is_array($item) && findValue($item, $key, $value)) {
      return true;
    }

    if(isset($item[$key]) && $item[$key] == $value) {
      return true;
    }
  }

  return false;
}

// Custom error page
function errorHandler() {
  if(error_reporting()) {
    include_once VIEW_ROOT . '/errors/error.php';

    die();
  }
}

// Create random bytes
function random($number) {
  return bin2hex(random_bytes($number));
}

// Generate token
function generate($token) {
  return $_SESSION[$token] = random(64);
}

// Check token
function check($token, $name) {
  if(isset($_SESSION[$name]) && hash_equals($_SESSION[$name], $token)) {
    unset($_SESSION[$name]);

    return true;
  }

  return false;
}