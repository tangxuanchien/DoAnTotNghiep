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

<form class="d-flex my-3" role="search">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Tìm kiếm" id="search">
    <button class="btn btn-outline-success" id="search-btn" type="button">Tìm</button>
</form>

<form action="/Datn/views/create.post.view.php" method="post">
    <button type="submit">Tạo bài đăng mới</button>
</form>

<div class="mt-5">
    <script>
    $(document).ready(function() {
        $('#search').keyup(function(e) {
            var search = $('#search').val();
            if (search.length > 0) {
                $.ajax({
                    url: '../Datn/controllers/get_searchs.php',
                    type: 'POST',
                    data: { search: search },
                    success: function(response) {
                        $('#result').html(response);
                    },
                });
            } else {
                $('#result').html('');
            }
        });
    });
</script>
    <div  id="result"></div>
    <table class="table table-bordered">
        <tbody>
            <?php foreach ($propertys as $property) : ?>
                <tr>
                    <td>
                        <a href=#><?= $property['title'] ?></a>
                    </td>
                    <td>
                        <form action="/Datn/views/detail.property.view.php?id=<?= $property['property_id'] ?>" method="post">
                            <button type="submit">Xem chi tiết</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>