<?php
    session_start();
    require '../models/Database.php';
    $body = $_POST['body'];
    $id = $_SESSION['id'];
    require '../function.php';
    // dd($body);
    
    if($body === ""){
        $_SESSION['textbody'] = 'Bạn đang để trống, vui lòng nhập nội dung';
        header('Location: /Datn/views/create.view.php');
    }
    else {
        $db = new Database();
        $property = $db->query("INSERT INTO `notes` (`id`, `body`, `userid`) VALUES (:id, :body, :userid)",
        [
            'id' => NULL,
            'body' => $body,
            'userid' => $id
        ])->fetch(PDO::FETCH_ASSOC);
    
        $_SESSION['textbody'] = '';
        header('Location: /Datn/index.php'); 
        exit();
    }




