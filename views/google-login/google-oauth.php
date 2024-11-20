<?php
session_start();
require '../../models/Database.php';
require '../../function.php';
$google_oauth_client_id = '1090080427402-4l7ejr79feo8ep8ch0j68b8tkvkupvog.apps.googleusercontent.com';
$google_oauth_client_secret = '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';
$google_oauth_redirect_uri = 'http://localhost/Datn/views/google-login/google-oauth.php';
$google_oauth_version = 'v3';

if (isset($_GET['code']) && !empty($_GET['code'])) {
    $params = [
        'code' => $_GET['code'],
        'client_id' => $google_oauth_client_id,
        'client_secret' => $google_oauth_client_secret,
        'redirect_uri' => $google_oauth_redirect_uri,
        'grant_type' => 'authorization_code'
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://accounts.google.com/o/oauth2/token');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response, true);

    if (isset($response['access_token']) && !empty($response['access_token'])) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/oauth2/' . $google_oauth_version . '/userinfo');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $response['access_token']]);
        $response = curl_exec($ch);
        curl_close($ch);
        $profile = json_decode($response, true);
        // Make sure the profile data exists
        if (isset($profile['email'])) {
            $google_name_parts = [];
            $google_name_parts[] = isset($profile['given_name']) ? preg_replace('/[^a-zA-Z0-9àáạãâầấậẩẫăằắặẳẵèéẹẽêềếệểễìíịĩòóọõôồốộổỗơờớợởỡùúụũưừứựửữỳýỵỹđ]/u', '', $profile['given_name']) : '';
            $google_name_parts[] = isset($profile['family_name']) ? preg_replace('/[^a-zA-Z0-9àáạãâầấậẩẫăằắặẳẵèéẹẽêềếệểễìíịĩòóọõôồốộổỗơờớợởỡùúụũưừứựửữỳýỵỹđ]/u', '', $profile['family_name']) : '';

            $db = new Database();
            $max_id = $db->query("SELECT max(user_id) FROM users")->fetch(PDO::FETCH_ASSOC);

            $user = $db->query('SELECT * FROM users WHERE method = :method and email = :email', [
                'method' => 'google',
                'email' => $profile['email']
            ])->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                $db->query('
                INSERT INTO users (user_id, email, name, avatar, method, created_user_at) 
                VALUES (:user_id, :email, :name, :avatar, :method, :created_user_at)', [
                    'user_id' => $max_id['max(user_id)'] + 1,
                    'name' => implode(' ', $google_name_parts),
                    'email' => $profile['email'],
                    'created_user_at' => get_time(),
                    'method' => 'google',
                    'avatar' => isset($profile['picture']) ? $profile['picture'] : ''      
                ]);
                $user_id = $max_id['max(user_id)'] + 1;
            } else {
                $user_id = $user['user_id'];
            }
            session_regenerate_id();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['method'] = 'google';
            $_SESSION['name'] = $user['name'];
            $_SESSION['avatar'] = $user['avatar'];

            header('Location: /Datn');
            exit;
        } else {
            exit('Could not retrieve profile information! Please try again later!');
        }
    } else {
        exit('Invalid access token! Please try again later!');
    }
} else {

    $params = [
        'response_type' => 'code',
        'client_id' => $google_oauth_client_id,
        'redirect_uri' => $google_oauth_redirect_uri,
        'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
        'access_type' => 'offline',
        'prompt' => 'consent'
    ];
    header('Location: https://accounts.google.com/o/oauth2/auth?' . http_build_query($params));
    exit;
}
