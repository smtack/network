<?php
require_once "public/init.php";

if(!isset($_SESSION['loggedin'])) {
  header("Location: " . BASE_URL . "/index");
}

$page_title = "Network - Update";

$id = $_GET['id'];

$query = "SELECT * FROM posts WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->execute(["id" => $id]);

$post_data = $stmt->fetchAll();

foreach($post_data as $post);

if(isset($_POST['content']) && !empty($_FILES['image']['name'])) {
  $target_dir = "src/uploads/";
  $file_name = basename($_FILES['image']['name']);
  $target_file_path = $target_dir . $file_name;
  $file_type = pathinfo($target_file_path, PATHINFO_EXTENSION);
  $allow_types = array('jpg', 'png', 'jpeg', 'gif');

  $content = htmlentities($_POST['content']);

  if(in_array($file_type, $allow_types)) {
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file_path)) {
      $query = "UPDATE posts SET image = :image, content = :content WHERE id = :id";
      $stmt = $db->prepare($query);
      $stmt->execute([
        "id" => $id,
        "image" => $file_name,
        "content" => $content
      ]);

      header("Location: " . BASE_URL . "/home");
    }
  }
} else if(isset($_POST['content'])) {
  $content = htmlentities($_POST['content']);

  $query = "UPDATE posts SET content = :content WHERE id = :id";
  $stmt = $db->prepare($query);
  $stmt->execute([
    "id" => $id,
    "content" => $content
  ]);

  header("Location: " . BASE_URL . "/home");
}

require VIEW_ROOT . "/update.php";
?>