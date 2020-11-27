<?php
require_once "../public/init.php";

$keywords = isset($_GET["search"]) ? $_GET["search"] : "";
$keywords = "%{$keywords}%";

$query = "SELECT * FROM users WHERE name LIKE :keywords ORDER BY id DESC";
$stmt = $db->prepare($query);
$stmt->execute(["keywords" => $keywords]);

$users = $stmt->fetchAll();

$page_title = "Network - Search: " . $keywords;

require VIEW_ROOT . "/search.php";
?>