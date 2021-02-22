<?php
define("BASE_PATH", "VALUE_BASE_PATH");
// define("BASE_PATH", "http://localhost/phone_php/");

function url(){
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['REQUEST_URI']
    );
}
$current_url = url();
date_default_timezone_set("Asia/tehran");

$version = '1.4.2';

?>