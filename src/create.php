<?php
require_once "../public/init.php";

if(isset($_POST['post']) && !empty($_FILES['image']['name'])) {
  $target_dir = "uploads/";
  $file_name = basename($_FILES['image']['name']);
  $target_file_path = $target_dir . $file_name;
  $file_type = pathinfo($target_file_path, PATHINFO_EXTENSION);
  $allow_types = array('jpg', 'png', 'jpeg', 'gif');

  $name = $_SESSION['name'];
  $content = htmlentities($_POST['content']);

  if(in_array($file_type, $allow_types)) {
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file_path)) {
      $query = "INSERT INTO posts (name, image, content) VALUES (:name, :image, :content)";
      $stmt = $db->prepare($query);
      $stmt->execute([
        "name" => $name,
        "image" => $file_name,
        "content" => $content
      ]);

      header("Location: " . BASE_URL . "/home");
    }
  }
}
?>