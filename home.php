<?php
require_once "public/init.php";

if(!isset($_SESSION['loggedin'])) {
  header("Location: " . BASE_URL . "/index");
}

$page_title = "Network - Home";

$name = $_SESSION['name'];

$query = "SELECT * FROM posts WHERE name = :name ORDER BY id DESC";
$stmt = $db->prepare($query);
$stmt->execute(["name" => $name]);

$posts = $stmt->fetchAll();

require VIEW_ROOT . "/home.php";
?>