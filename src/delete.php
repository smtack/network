<?php
require_once "../public/init.php";

$id = $_GET['id'];

$query = "DELETE FROM posts WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->execute(["id" => $id]);

header("Location: " . BASE_URL . "/src/home.php");
?>