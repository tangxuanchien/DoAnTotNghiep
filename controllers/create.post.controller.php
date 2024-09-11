<?php
    session_start();
    require '../models/Database.php';
    require '../function.php';

    // $title = $_POST['title'];
    // $description = $_POST['description'];
    // $price = $_POST['price'];
    // $area = $_POST['area'];
    // $contact_info = $_POST['contact_info'];
    // $num_bedrooms = $_POST['num_bedrooms'];
    // $num_bathrooms = $_POST['num_bathrooms'];
    // $type_id = $_POST['type_id'];
    $ward_id = $_POST['ward_id'];
    // $created_at = get_time();
    // $price_per_m2 = $price / $area;

    $id = $_SESSION['id'];
    dd($ward_id);
    
    // if($body === ""){
    //     $_SESSION['textbody'] = 'Bạn đang để trống, vui lòng nhập nội dung';
    //     header('Location: /Datn/views/create.view.php');
    // }
    // else {
    //     $db = new Database();
    //     $property = $db->query("INSERT INTO `notes` (`id`, `body`, `userid`) VALUES (:id, :body, :userid)",
    //     [
    //         'id' => NULL,
    //         'body' => $body,
    //         'userid' => $id
    //     ])->fetch(PDO::FETCH_ASSOC);
    
    //     $_SESSION['textbody'] = '';
    //     header('Location: /Datn/index.php'); 
    //     exit();
    // }




