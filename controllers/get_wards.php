<?php
require '../models/Database.php';
$district_id = $_POST['district_id'];
// $ward_id = $_POST['ward_id'];
$ward_id = isset($_POST['ward_id']) ? $_POST['ward_id'] : '';

$db = new Database();
$wards = $db->query("SELECT * FROM `wards` WHERE district_id = :district_id", [
    'district_id' => $district_id
])->fetchAll(PDO::FETCH_ASSOC);

foreach ($wards as $ward) {
    $selected = ($ward['ward_id'] == $ward_id) ? 'selected' : '';
    echo "<option value='" . $ward['ward_id'] . "' $selected>" . $ward['ward_name'] . "</option>";
    // echo "<option value='" . $ward['ward_id'] . "' " . ($ward['ward_id'] == $ward_id ? 'selected' : '') . ">" . $ward['ward_name'] . "</option>";
}
