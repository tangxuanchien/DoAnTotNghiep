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
    <?php
    foreach ($post_saves as $index => $post_saves):
        $date = date_parse($post_saves['updated_at']);
    ?>
        <div class="post-lists">
            <ul>
                <li>
                    <div class="image-container">
                        <a href="<?= $post_saves['image_url'] ?>" data-lightbox="image_property_<?= $index ?>" data-title="Ảnh mô tả">
                            <img src="<?= $post_saves['image_url'] ?>" alt="Thumbnail" style="width: 200px;">
                        </a>
                        <div class="image-overlay">
                            <i class="fa-regular fa-images"></i> <?= $post_saves['total_images'] ?>
                        </div>
                    </div>
                </li>
                <li>
                    <div style="transform: translateY(15%);">
                        <a href="/Datn/views/detail-post.view.php?property_id=<?= $post_saves['property_id'] ?>" class="text-dark">
                            <h5><?= $post_saves['title'] ?></h5>
                        </a>
                        <small class="text-muted"><i class="far fa-clock me-1"></i> <?= $date['day'] . '-' . $date['month'] . '-' . $date['year'] ?></small>
                    </div>
                    <div class="mt-2 post-edit">
                        <ul>
                            <li>
                            <form action="/Datn/controllers/save-post.controller.php?post_id=<?= $post_saves['post_id'] ?>" method="post">
                                    <?php if ($post_saves['user_sid'] == $_SESSION['user_id'] and $post_saves['post_sid'] == $post_saves['post_id']): ?>
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
