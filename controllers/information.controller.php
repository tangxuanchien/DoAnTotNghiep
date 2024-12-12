<?php
require '../models/Database.php';

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
} else {
    $user_id = $_SESSION['user_id'];
}

$db = new Database();
$user = $db->query("SELECT * FROM `users` where user_id = $user_id")->fetch(PDO::FETCH_ASSOC);

$total_post = $db->query("
SELECT count(*) as total_post FROM `posts`
WHERE user_id = :user_id", [
    'user_id' => $user_id
])->fetch(PDO::FETCH_ASSOC);

$posts = $db->query("
SELECT * FROM `posts` p
INNER JOIN properties pr on pr.property_id = p.property_id
INNER JOIN users u on u.user_id = p.user_id
INNER JOIN wards w on w.ward_id = pr.ward_id
INNER JOIN districts d on d.district_id = w.district_id
INNER JOIN property_images i on i.property_id = pr.property_id
WHERE u.user_id = :user_id LIMIT 3", [
    'user_id' => $user_id
])->fetchAll(PDO::FETCH_ASSOC);

if (empty($user['introduce'])) {
    $user['introduce'] = 'Chưa có giới thiệu';
}

if (empty($user['avatar'])) {
    $user['avatar'] = 'Chưa có giới thiệu';
}

$date = date_parse($user['created_user_at']);
?>
<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #34495e;
        --accent-color: #e74c3c;
    }

    body {
        background-color: #ecf0f1;
        min-height: 100vh;
    }

    .avatar {
        border-radius: 80px;
        height: 130px;
        width: 130px;
    }

    .profile-sidebar {
        background-color: var(--primary-color);
        color: white;
        padding: 2rem;
        height: 100%;
        min-height: 100vh;
    }

    .profile-main {
        padding: 2rem;
    }

    .profile-avatar {
        width: 150px;
        height: 150px;
        background-color: var(--secondary-color);
        color: white;
        font-size: 4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-bottom: 1rem;
        border: 4px solid #fff;
    }

    .progress {
        height: 10px;
    }

    .badge-real-estate {
        background-color: var(--accent-color);
        color: white;
        font-size: 0.8rem;
        padding: 0.3rem 0.6rem;
        border-radius: 1rem;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .social-icon {
        font-size: 1.5rem;
        color: white;
        margin-right: 1rem;
    }

    .card {
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        color: var(--primary-color);
        border-bottom: 2px solid var(--accent-color);
        padding-bottom: 0.5rem;
    }
</style>

