<?php
require_once "../public/init.php";

$page_title = "Network - Update";

$id = $_GET['id'];

$query = "SELECT * FROM posts WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->execute(["id" => $id]);

$post_data = $stmt->fetchAll();

foreach($post_data as $post);

if(isset($_POST['update'])) {
  $content = htmlentities($_POST['content']);
  
  $query = "UPDATE posts SET content = :content WHERE id = :id";
  $stmt = $db->prepare($query);
  $stmt->execute([
    "id" => $id,
    "content" => $content
  ]);

  header("Location: " . BASE_URL . "/src/home.php");
}

require VIEW_ROOT . "/update.php";
?>