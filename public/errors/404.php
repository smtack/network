<?php
require_once '../../src/init.php';

http_response_code(404);

$page_title = "404 Not Found";

require VIEW_ROOT . '/errors/404.php';