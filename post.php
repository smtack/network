<?php
require_once "public/init.php";

if(!isset($_SESSION['loggedin'])) {
  header("Location: " . BASE_URL . "/index");
}

$page_title = "Network";

$id = $_GET['id'];

$query = "SELECT * FROM posts WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->execute([":id" => $id]);

$post_data = $stmt->fetch();

require VIEW_ROOT . "/post.php";