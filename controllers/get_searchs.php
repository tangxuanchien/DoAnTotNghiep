<?php
require '../models/Database.php';
$search = $_POST['search'];
$db = new Database();
$properties = $db->query("
SELECT * FROM `properties` pr
INNER JOIN posts p on p.property_id = pr.property_id
WHERE title like '%$search%' LIMIT 6")->fetchAll(PDO::FETCH_ASSOC);
if ($properties) {
    foreach ($properties as $property) : ?>
    <tr>
        <td><?= $property['title'] ?></td>
        <td>
            <form action="/Datn/views/detail-post.view.php?post_id=<?= $property['post_id'] ?>" method="post" class="mx-5 my-2">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </td>
    </tr>
<?php
    endforeach;
} else {
    echo "Không tìm thấy kết quả.";
}
