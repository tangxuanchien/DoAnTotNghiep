<?php
session_start();

$title = "Việc cần làm";
$banner = "Việc cần làm của tôi";
$login = 'Chào, '.$_SESSION['name'];

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

require '/controllers/property.controller.php';

require 'partials/footer.php';
