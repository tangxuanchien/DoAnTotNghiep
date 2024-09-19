<?php
require '../models/Database.php';
$search = $_POST['search'];
$db = new Database();
$properties = $db->query("SELECT * FROM `properties` where title like '%$search%'")->fetchAll(PDO::FETCH_ASSOC);
if ($properties) {
    foreach ($properties as $property) : ?>
    <tr>
        <td><?= $property['title'] ?></td>
        <td>
            <form action="/Datn/views/detail.property.view.php?id=<?= $property['property_id'] ?>" method="post" class="mx-5 my-2">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </td>
    </tr>
<?php
    endforeach;
} else {
    echo "Không tìm thấy kết quả.";
}
