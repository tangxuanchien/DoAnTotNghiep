<?php
require 'models/Database.php';
require 'function.php';
$id = $_SESSION['id'];

$db = new Database();
$propertys = $db->query("SELECT * FROM `properties`")->fetchAll(PDO::FETCH_ASSOC); //fetchAll cho nhieu ban ghi
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

<form action="/Datn/views/create.post.view.php" method="post">
    <button type="submit">Tạo bài đăng mới</button>
</form>
<div class="mt-5">
    <table class="table table-bordered">
        <tbody>
            <?php foreach ($propertys as $property) : ?>
                <tr>
                    <td>
                        <a href=#><?= $property['title'] ?></a>
                    </td>
                    <td>
                        <form action="/Datn/views/detail.property.view.php" method="post">
                            <button type="submit">Xem chi tiết</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>