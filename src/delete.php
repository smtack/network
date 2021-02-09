<?php
require_once "../public/init.php";

$id = $_GET['id'];

$query = "SELECT * FROM posts WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->execute(["id" => $id]);

$post_data = $stmt->fetch();

$path = "uploads/";
$image = $post_data['image'];
$file_name = $path . $image;

if(file_exists($file_name)) {
  unlink($file_name);
}

$query = "DELETE FROM posts WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->execute(["id" => $id]);

header("Location: " . BASE_URL . "/home");
?>