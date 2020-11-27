<?php
require_once "../public/init.php";

$page_title = "Network - Login";

if(isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "SELECT * FROM users WHERE email = :email LIMIT 0,1";
  $stmt = $db->prepare($query);
  $stmt->execute(['email' => $email]);

  $rows = $stmt->rowCount();

  if($rows > 0) {
    $row = $stmt->fetch();
    
    if(password_verify($password, $row['password'])) {
      $_SESSION['email'] = $row['email'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['loggedin'] = true;

      header("Location: home.php");
    } else {
      echo "Unable to log in";
    }
  }
}

require VIEW_ROOT . "/login.php";
?>