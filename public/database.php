<?php
$dbhost = "127.0.0.1";
$dbname = "network";
$dbuser = "root";
$dbpass = "";

$dsn = "mysql:host=$dbhost;dbname=$dbname";

$opt = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false
];

try {
  $db = new PDO($dsn, $dbuser, $dbpass, $opt);
} catch(\PDOException $e) {
  throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>