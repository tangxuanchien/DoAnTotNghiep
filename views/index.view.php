<?php
require 'routes.php';
session_start();

$title = "Trang chủ";
$banner = "Bài đăng nổi bật";

if (!isset($_SESSION['name'])) {
    $login = 'Đăng nhập';
} else $login = $_SESSION['name'];


require 'partials/header.php';

require 'partials/navigation.php';

?>
<div class="container-search">
    <div class="search">
        <form action="/Datn/views/search-post.view.php?page_number=1" method="post" class="d-flex my-3" role="search">
            <input class="form-control me-2" type="search" placeholder="Tìm kiếm theo tiêu đề" aria-label="Tìm kiếm" name="search" id="search">
            <button class="btn btn-light" id="search-btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>
    <div id="result" class="search-result">
        <table class="table table-bordered">
            <tbody>
                <script>
                    $(document).ready(function() {
                        var initialProperties = $('#properties').html();
                        $('#search').keyup(function(e) {
                            var search = $('#search').val();
                            if (search.length > 0) {
                                $.ajax({
                                    url: '../Datn/controllers/get_searchs.php',
                                    type: 'POST',
                                    data: {
                                        search: search
                                    },
                                    success: function(response) {
                                        $('#result').html(response).show();
                                        $('#properties').html("");
                                    },
                                });
                            } else {
                                $('#result').html('').hide();
                                $('#properties').html(initialProperties);
                            }
                        });
                    });
                </script>
            </tbody>
        </table>
    </div>
</div>
<?php
require 'partials/banner.php';

require 'controllers/index.controller.php';

?>

<div class="btn-view-all">
    <form action="/Datn/views/all-posts.view.php?page_number=1" method="post">
        <button type="submit" class="btn btn-dark">Xem tất cả bài đăng <i class="fa-solid fa-arrow-right text-light"></i></button>
    </form>
</div>
<?php
require 'partials/footer.php';
