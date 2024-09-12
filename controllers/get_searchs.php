<?php
require '../models/Database.php';
$search = $_POST['search'];
$db = new Database();
$properties = $db->query("SELECT * FROM `properties` where title like '%$search%'")->fetchAll(PDO::FETCH_ASSOC);
if ($properties) {
    foreach ($properties as $property) {
        echo "<a href='#'>" . $property['title'] . "</a></br>";
    }
} else {
    echo "Không tìm thấy kết quả.";
}
