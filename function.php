<?php
function dd($data)
{
    echo '<pre>';
    die(var_dump($data));
    echo '</pre>';
}

function check_login($name){
    if(!isset($name)){
        return 'Đăng nhập';
    } else return 'Chào, '.$name;
}

function check_banner($banner, $a, $b){
    if(empty($banner)){
        return $a;
    }
    else return $b;
}

function get_time(){
    return date('Y-m-d ') . (date('h') + 5) . date(':i:s');
}

function get_price_per_m2($a, $b){
    return $a / $b;
}