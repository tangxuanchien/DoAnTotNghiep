<?php
session_start();
require '../models/Database.php';
$district_id = $_POST['district_id'];

$db = new Database();
$wards = $db->query("SELECT * FROM `wards` WHERE district_id = :district_id", [
    'district_id' => $district_id
])->fetchAll(PDO::FETCH_ASSOC);

foreach ($wards as $ward) {
    echo "<option value='" . $ward['ward_id'] . "'>" . $ward['ward_name'] . "</option>";
}
