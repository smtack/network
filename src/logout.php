<?php
require_once "../public/init.php";

session_start();

session_destroy();

header("Location: " . BASE_URL . "/index");
?>