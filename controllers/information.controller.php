<?php
$id = $_SESSION['id'];
require '../models/Database.php';
$db = new Database();
$user = $db->query("SELECT * FROM `users` where user_id = $id")->fetch(PDO::FETCH_ASSOC);
$date = date_parse($user['created_at']);
?>
<style>
    .container {
        position: relative;
    }

    .div-avatar {
        /* position: absolute; */
        margin: 20px 0;
    }

    .avatar {
        border-radius: 80px;
        height: 130px;
        width: 130px;
    }

    .div-info {
        position: absolute;
        left: 240px;
        bottom: -45px;
    }

    .div-button {
        position: absolute;
        top: 230px;
        left: 272px;
    }

    ul {
        list-style-type: none;
    }

    li {
        padding: 4px 0;
    }

    .a-edit {
        position: absolute;
        text-decoration: none;
        border: 3px solid #cccccc;
        border-radius: 15px;
        color: black;
        padding: 3px 11px;
        left: 24px;
    }
</style>
<div class="container">
    <div class="div-avatar">
        <img src="<?= $user['picture'] ?>" alt="avatar" class="avatar">
    </div>
    <div>
        <a href="#" class="a-edit"><i class="fa-regular fa-pen-to-square"></i> Thay đổi</a>
    </div>
    <div class="div-info">
        <ul>
            <li>
                Tên người dùng: <b><?= $user['name'] ?></b>
            </li>
            <li>
                Email người dùng: <b><?= $user['email'] ?></b>
            </li>
            <li>
                Số điện thoại người dùng: <b><?= $user['phone'] ?></b>
            </li>
            <li>
                Mật khẩu người dùng: <b><?= $user['password'] ?></b>
            </li>
            <li>
                Đã tham gia vào: <b><?= $date['day'] . '-' . $date['month'] . '-' . $date['year'] ?></b>
            </li>
        </ul>
    </div>
    <div class="div-button">
        <form action="/Datn/views/information.update.view.php?id=<?= $id ?>" method="post" class="mt-3">
            <button type="submit"><i class="fa-solid fa-user-pen"></i> Chỉnh sửa</button>
        </form>
        <form action="/Datn/controllers/logout.controller.php" method="post" class="mt-3">
            <button type="submit"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</button>
        </form>
    </div>
</div>