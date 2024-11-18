<?php
if (!isset($_POST['ward_id'])) {
	$ward_id = '';
} else {
	$ward_id = $_POST['ward_id'];
};
if (!isset($_POST['type'])) {
	$type = '';
} else {
	$type = $_POST['type'];
};

$db = new Database();
$districts = $db->query("SELECT * FROM `districts`")->fetchAll(PDO::FETCH_ASSOC);

$ward = $db->query("
SELECT * FROM `wards` w 
INNER JOIN districts d ON d.district_id = w.district_id 
WHERE ward_id = :ward_id", [
	'ward_id' => $ward_id
])->fetch(PDO::FETCH_ASSOC);

if (!isset($ward['district_id'])) {
	$district_id = '';
} else {
	$district_id = $ward['district_id'];
};

$statistic_of_ward = $db->query("
Select count(*) AS total, REPLACE(CAST(avg(price_per_m2) AS DECIMAL(5, 1)), '.', ',') AS avg_ward 
FROM `properties` where ward_id = :ward_id", [
	'ward_id' => $ward_id
])->fetch(PDO::FETCH_ASSOC);

$statistic_of_district = $db->query("
SELECT CAST(avg(price_per_m2) AS DECIMAL(5, 0)) AS avg_district 
FROM `properties` WHERE ward_id IN (SELECT ward_id FROM `wards` WHERE district_id = :district_id)", [
	'district_id' => $ward['district_id']
])->fetch(PDO::FETCH_ASSOC);

$avg_wards = $db->query("
	SELECT 
    d.district_name, 
    w.ward_id, 
    w.ward_name, 
    CAST(IFNULL(AVG(p.price_per_m2), 0) AS DECIMAL(5,1)) AS avg_ward
FROM 
    wards w
LEFT JOIN properties p ON p.ward_id = w.ward_id
INNER JOIN districts d ON w.district_id = d.district_id
WHERE 
    d.district_id = :district_id
GROUP BY 
    w.ward_id
ORDER BY 
    w.ward_id;", [
	'district_id' => $district_id
])->fetchAll(PDO::FETCH_ASSOC);

$avg_districts = $db->query("
	SELECT 
		CAST(AVG(properties.price_per_m2) AS DECIMAL(5,1)) AS avg_district
	FROM 
		properties
	INNER JOIN wards ON properties.ward_id = wards.ward_id
	INNER JOIN districts ON wards.district_id = districts.district_id
	GROUP BY districts.district_id")->fetchAll(PDO::FETCH_ASSOC);

$backgroundColors = randomRGBAColors(count($districts));
$borderColors = borderColors(count($districts));



