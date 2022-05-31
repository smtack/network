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