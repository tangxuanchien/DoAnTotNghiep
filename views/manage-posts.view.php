<?php
session_start();
require '../function.php';

$title = "Quản lí bài đăng";
$banner = "";
$login = check_login($_SESSION['name']);

require 'partials/header.php';

require 'partials/navigation.php';

require 'partials/banner.php';

require '../controllers/manage-posts.controller.php';
?>
<div class="container-post" style="width: 80%;">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/Datn">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Quản lí bài đăng</li>
        </ol>
    </nav>
    <?php if ($_SERVER['PATH_INFO'] != '/save'): ?>
        <div class="navigation-post">
            <ul>
                <li <?= ($_SERVER['PATH_INFO'] == '/available') ? 'class="active-manage"' : '' ?>><a href="/Datn/views/manage-posts.view.php/available">
                        Tin đang bán (<?= $num_status['available'] ?>)
                    </a>
                </li>
                <li <?= ($_SERVER['PATH_INFO'] == '/sold') ? 'class="active-manage"' : '' ?>><a href="/Datn/views/manage-posts.view.php/sold">
                        Tin đã bán (<?= $num_status['sold'] ?>)
                    </a>
                </li>
                <li <?= ($_SERVER['PATH_INFO'] == '/for_rent') ? 'class="active-manage"' : '' ?>><a href="/Datn/views/manage-posts.view.php/for_rent">
                        Tin cho thuê (<?= $num_status['for_rent'] ?>)
                    </a>
                </li>
                <li <?= ($_SERVER['PATH_INFO'] == '/hide') ? 'class="active-manage"' : '' ?>><a href="/Datn/views/manage-posts.view.php/hide">
                        Tin bị ẩn (<?= $num_status['hide'] ?>)
                    </a>
                </li>
            </ul>
        </div>
    <?php endif ?>
    <?php
    foreach ($my_posts as $index => $my_post):
        $date = date_parse($my_post['updated_at']);
    ?>
        <div class="post-lists">
            <ul>
                <li>
                    <div class="image-container">
                        <a href="<?= $my_post['image_url'] ?>" data-lightbox="image_property_<?= $index ?>" data-title="Ảnh mô tả">
                            <img src="<?= $my_post['image_url'] ?>" alt="Thumbnail" style="width: 200px;">
                        </a>
                        <div class="image-overlay">
                            <i class="fa-regular fa-images"></i> <?= $my_post['total_images'] ?>
                        </div>
                    </div>
                </li>
                <li>
                    <div style="transform: translateY(15%);">
                        <a href="/Datn/views/detail-post.view.php?post_id=<?= $my_post['post_id'] ?>&source=manage" class="text-dark">
                            <h5><?= $my_post['title'] ?></h5>
                        </a>
                        <small class="text-muted me-5"><i class="far fa-clock me-1"></i> <?= $date['day'] . '-' . $date['month'] . '-' . $date['year'] ?></small>
                        <?php if ($my_post['status'] == 'available') {
                            echo '<p class ="badge text-bg-primary text-wrap">Đang bán</p>';
                        } elseif ($my_post['status'] == 'for_rent') {
                            echo '<p class ="badge text-bg-warning text-wrap">Cho thuê</p>';
                        } ?>
                    </div>
                    <div class="mt-2 post-edit">
                        <ul>
                            <?php if ($_SERVER['PATH_INFO'] == '/available' OR $_SERVER['PATH_INFO'] == '/for_rent'): ?>
                                <li>
                                    <form action="/Datn/views/edit-post.view.php" method="post">
                                        <input type="hidden" value="<?= $my_post['post_id'] ?>" name="post_id">
                                        <button class="btn btn-outline-secondary"><i class="fa-solid fa-pen"></i> Sửa tin</button>
                                    </form>
                                </li>
                                <li>
                                    <form id="post_hide" action="/Datn/controllers/status-post.controller.php?post_id=<?= $my_post['post_id'] ?>&status=hide" method="post">
                                        <button type="button" class="btn btn-outline-secondary" onclick="showAlert('Bạn có chắc muốn ẩn tin này ?', '', 'post_hide')"><i class="fa-regular fa-eye-slash"></i> Ẩn tin</button>
                                    </form>
                                </li>
                                <li>
                                    <form id="post_sold" action="/Datn/controllers/status-post.controller.php?post_id=<?= $my_post['post_id'] ?>&status=sold" method="post">
                                        <button type="button" class="btn btn-outline-secondary" onclick="showAlert('Tin này đã được bán thành công', 'Bạn sẽ không thể thay đổi lại trạng thái của tin ?', 'post_sold')"><i class="fa-solid fa-sack-dollar"></i> Tin đã bán</button>
                                    </form>
                                </li>
                            <?php elseif ($_SERVER['PATH_INFO'] == '/hide'): ?>
                                <li>
                                    <form action="/Datn/views/edit-post.view.php" method="post">
                                        <input type="hidden" value="<?= $my_post['post_id'] ?>" name="post_id">
                                        <button class="btn btn-outline-secondary"><i class="fa-solid fa-pen"></i> Sửa tin</button>
                                    </form>
                                </li>
                                <li>
                                    <form id="post_hide" action="/Datn/controllers/status-post.controller.php?post_id=<?= $my_post['post_id'] ?>&status=available" method="post">
                                        <button type="button" class="btn btn-outline-secondary" onclick="showAlert('Bạn có chắc muốn hiện này ?', '', 'post_hide')"><i class="fa-regular fa-eye"></i> Hiện tin</button>
                                    </form>
                                </li>
                            <?php endif ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    <?php endforeach ?>
</div>
<div class="overlay" id="customAlert">
    <div class="alert-box">
        <h2>Thông báo</h2>
        <p id="alertMessage"></p>
        <p id="alertWarning"><b></b></p>
        <button onclick="confirmSubmit()">Xác nhận</button>
        <button onclick="closeAlert()">Đóng</button>
    </div>
</div>
<script>
    let formIdToSubmit = "";

    function showAlert(message, warning = "", formId) {
        document.getElementById("alertMessage").textContent = message;

        const warningElement = document.getElementById("alertWarning");
        if (warning) {
            warningElement.innerHTML = `<b>${warning}</b>`;
            warningElement.style.display = "block";
        } else {
            warningElement.style.display = "none";
        }

        formIdToSubmit = formId;
        document.getElementById("customAlert").style.display = "flex";
    }

    function closeAlert() {
        document.getElementById("customAlert").style.display = "none";
    }

    function confirmSubmit() {
        if (formIdToSubmit) {
            document.getElementById(formIdToSubmit).submit();
        }
        closeAlert();
    }
</script>
<?php

require 'partials/footer.php';
