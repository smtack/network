<?php
require_once "../public/init.php";

if(isset($_POST['post'])) {
  $name = $_SESSION['name'];
  $content = $_POST['content'];
  
  $query = "INSERT INTO posts (name, content) VALUES (:name, :content)";
  $stmt = $db->prepare($query);
  $stmt->execute([
    "name" => $name,
    "content" => $content
  ]);

  header("Location: " . BASE_URL . "/src/home.php");
}
?>