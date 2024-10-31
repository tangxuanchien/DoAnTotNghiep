<?php
require '../models/Database.php';

$user_id = $_SESSION['id'];
$db = new Database();
$my_posts = $db->query("
SELECT *, count(p.property_id) as total FROM `posts` p 
INNER JOIN users u on u.user_id = p.user_id
inner join properties pr on pr.property_id = p.property_id
inner join property_images i on i.property_id = p.property_id
where u.user_id = :user_id", [
    'user_id' => $user_id
])->fetchAll(PDO::FETCH_ASSOC);

?>
<?php
foreach ($my_posts as $my_post):
    $date = date_parse($my_post['created_at']);
?>
    <div class="property-lists">
        <ul>
            <li>
                <img src="<?= $my_post['image_url'] ?>" alt="image_property" width="150px">
            </li>
            <li>
                <div>
                    <h5><?= $my_post['title'] ?></h5>
                    <p>Ngày đăng: <?= $date['day'] . '-' . $date['month'] . '-' . $date['year'] ?></p>
                </div>
            </li>
        </ul>
    </div>
<?php endforeach ?>