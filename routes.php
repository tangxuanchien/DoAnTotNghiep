<?php
$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '/':
        require 'views/index.view.php';
        break;

    case '/statistics':
        require '/views/price-statistics.view.php';
        break;

    default:
        http_response_code(404);
        echo "404 - Page Not Found";
        break;
}
