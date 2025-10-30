<?php

// Sanitise database ouput
function escape($string) {
  return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

// Return BASE URL and optional location for links
function base_url($location = null) {
  if(!$location) {
    return BASE_URL;
  } else {
    return BASE_URL . $location;
  }
}

// Return PHP_SELF variable for forms
function self() {
  return $_SERVER['PHP_SELF'];
}

// Redirect user
function redirect($location = null) {
  switch($location) {
    case null:
      header("Location: " . $_SERVER['HTTP_REFERER']);

      exit();
    case 404:
      header('HTTP/1.0 404 Not Found');

      include_once VIEW_ROOT . '/errors/404.php';

      exit();
    default:
      header("Location: " . BASE_URL . $location);

      exit();
  }
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

    exit();
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

// Generate unique filename
function createUniqueFilename($filename) {
  $hashed_filename = hash('sha256', $filename);

  $shortened_hash = substr($hashed_filename, 0, 16);

  $unique_filename = $shortened_hash . time();

  return $unique_filename;
}