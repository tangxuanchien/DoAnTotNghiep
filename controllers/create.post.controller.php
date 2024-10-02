<?php
    session_start();
    require '../models/Database.php';
    require '../function.php';
    $id = $_SESSION['id'];

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $area = $_POST['area'];
    $contact_info = $_POST['contact_info'];
    $num_bedrooms = $_POST['num_bedrooms'];
    $num_bathrooms = $_POST['num_bathrooms'];
    $type_id = $_POST['type_id'];
    $ward_id = $_POST['ward_id'];
    $created_at = get_time();
    $price_per_m2 = get_price_per_m2($price, $area);
    
    if(empty($title) or empty($description) or empty($price) or empty($area) or empty($description)
    or empty($contact_info) or empty($num_bedrooms) or empty($type_id) or empty($ward_id)){
        $_SESSION['error_post'] = 'Bạn đang để trống nội dung';
        header('Location: /Datn/views/create.post.view.php');
    }
    else {
        $db = new Database();
        $property = $db->query("INSERT INTO `properties` (`property_id`, `title`, `description`, `price`, `area`, `price_per_m2`,
                               `type_id`, `ward_id`, `contact_info`, `created_at`, `num_bedrooms`, `num_bathrooms`) 
                               VALUES (:property_id, :title, :description, :price, :area, :price_per_m2,
                                :type_id, :ward_id, :contact_info, :created_at, :num_bedrooms, :num_bathrooms)",
        [
            'property_id' => NULL,
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'area' => $area,
            'price_per_m2' => $price_per_m2,
            'created_at' => $created_at,
            'type_id' => $type_id,
            'ward_id' => $ward_id,
            'num_bedrooms' => $num_bedrooms,
            'num_bathrooms' => $num_bathrooms,
            'contact_info' => $contact_info
        ])->fetch(PDO::FETCH_ASSOC);
    
        $_SESSION['error_post'] = '';
        header('Location: /Datn/'); 
        exit();
    }




