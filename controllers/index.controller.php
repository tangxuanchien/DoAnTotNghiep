<?php
require 'models/Database.php';
require 'function.php';
$id = $_SESSION['id'];

$db = new Database();
$propertys = $db->query("SELECT * FROM `notes` WHERE userid=$id")->fetchAll(PDO::FETCH_ASSOC); //fetchAll cho nhieu ban ghi
?>

<style>
    a {
        text-decoration: none;
        color: black;
    }

    td:hover {
       background-color: #e0e0e0;
    }

    button:hover {
        background-color: #e0e0e0;
    }
</style>

<table class="table table-bordered">
    <tbody>
        <?php foreach ($propertys as $property) : ?>
            <tr>
                <td>
                    <a href="/Datn/views/property.view.php?id=<?= $property['id'] ?>" ><?= $property['body'] ?></a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<div class="mt-5">
    <form action="/Datn/views/create.view.php" method="post">
        <button type="submit">THÊM MỚI VIỆC LÀM</button>
    </form>
</div>