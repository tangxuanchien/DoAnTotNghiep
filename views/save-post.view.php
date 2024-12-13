<?php
session_start();
require '../function.php';

$title = "Tin đã lưu";
$banner = "Tin đã lưu";
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
            <li class="breadcrumb-item active" aria-current="page">Tin đã lưu</li>
        </ol>
    </nav>
    <?php
    foreach ($post_saves as $index => $post_save):
        $time = date("H:i", strtotime($post_save['created_save_at']));
        $date = date("Y-m-d", strtotime($post_save['created_save_at'])); ?>
        <div class="post-lists">
            <ul>
                <li>
                    <div class="image-container">
                        <a href="<?= $post_save['image_url'] ?>" data-lightbox="image_property_<?= $index ?>" data-title="Ảnh mô tả">
                            <img src="<?= $post_save['image_url'] ?>" alt="Thumbnail" style="width: 200px;">
                        </a>
                        <div class="image-overlay">
                            <i class="fa-regular fa-images"></i> <?= $post_save['total_images'] ?>
                        </div>
                    </div>
                </li>
                <li>
                    <div style="transform: translateY(15%);">
                        <a href="/Datn/views/detail-post.view.php?post_id=<?= $post_save['post_id'] ?>&source=save" class="text-dark">
                            <h5><?= $post_save['title'] ?></h5>
                        </a>
                        <small class="text-muted">
                            <i class="far fa-clock me-1"></i> <?= $time ?>
                            <i class="fa-solid fa-calendar-days me-1" style="margin-left: 10px;"></i> <?= $date ?>
                        </small>
                    </div>
                    <div class="mt-2 post-edit">
                        <ul>
                            <li>
                                <form action="/Datn/controllers/save-post.controller.php?post_id=<?= $post_save['post_id'] ?>" method="post">
                                    <?php if ($post_save['user_sid'] == $_SESSION['user_id'] and $post_save['post_sid'] == $post_save['post_id']): ?>
                                        <button class="btn btn-success">
                                            <i class="fa-regular fa-bookmark text-light"></i> Bỏ lưu tin
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-outline-success">
                                            <i class="fa-solid fa-bookmark"></i> Lưu tin
                                        </button>
                                    <?php endif ?>
                                </form>
                            </li>
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
