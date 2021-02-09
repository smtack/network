<?php
require_once "public/init.php";

if(!isset($_SESSION['loggedin'])) {
  header("Location: " . BASE_URL . "/index");
}

$user_name = $_GET['id'];

$query = "SELECT * FROM posts WHERE name = :name ORDER BY id DESC";
$stmt = $db->prepare($query);
$stmt->execute(["name" => $user_name]);

$posts = $stmt->fetchAll();

$page_title = "Network - " . $user_name;

require VIEW_ROOT . "/profile.php";
?>