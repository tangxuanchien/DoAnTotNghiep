<?php
session_start();

$title = "Việc cần làm";
$banner = "Cập nhật việc làm";
$login = 'Chào, '.$_SESSION['name'];

$id = $_GET['id'];
require '../models/Database.php';
$db = new Database();
$property = $db->query("SELECT * FROM `notes` WHERE id = $id")->fetch(PDO::FETCH_ASSOC); 

require '../partials/header.php';

require '../partials/navigation.php';

require '../partials/banner.php';
?>
<form action="/Datn/controllers/update.controller.php?id=<?= $property['id'] ?>" method="POST">
    <div class="form-floating">
        <textarea class="form-control"  style="height: 100px" name="body"><?= $property['body'] ?></textarea>
    </div>
    <div class="mt-5">
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </div>
</form>
<?php
require '../partials/footer.php';
?>