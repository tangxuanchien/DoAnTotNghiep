<?php
function dd($data)
{
    echo '<pre>';
    die(var_dump($data));
    echo '</pre>';
}

function check_login($name)
{
    if (!isset($name)) {
        return $name = 'Đăng nhập';
    } else return $name;
}

function check_banner($banner, $a, $b)
{
    if (empty($banner)) {
        return $a;
    } else return $b;
}

function get_time()
{
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    return date('Y-m-d H:i:s');
}

function get_time_extra()
{
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $new_time = time() + 60; 
    return date('Y-m-d H:i:s', $new_time);
}

function get_price_per_m2($a, $b)
{
    if (empty($a) or empty($b)) {
        return 0;
    } else
        return $a / $b;
}

function checkpagenumber($condition_a, $condition_b, $result_a, $result_b)
{
    if ($condition_a == $condition_b) {
        return $result_a;
    } else
        return $result_b;
}

function randomRGBAColors($count) {
    $colors = [];
    for ($i = 0; $i < $count; $i++) {
        $red = rand(0, 255);
        $green = rand(0, 255);
        $blue = rand(0, 255);
        $colors[] = "rgba($red, $green, $blue, 0.2)";
    }
    return $colors;
}

function borderColors($count){
    $colors = [];
    for ($i = 0; $i < $count; $i++) {
        $colors[] = "rgba(0, 0, 0, 0.3)";
    }
    return $colors;
}