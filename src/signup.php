<?php
require_once "../public/init.php";

if(isset($_POST['signup'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

  $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
  $stmt = $db->prepare($query);
  $stmt->execute([
    'name' => $name,
    'email' => $email,
    'password' => $hashed_password
  ]);

  $_SESSION['email'] = $email;
  $_SESSION['name'] = $name;
  $_SESSION['loggedin'] = true;

  header("Location: " . BASE_URL . "/src/home.php");
}
?>