<?php
session_start();
include('permissions.php');

if(!isset($_SESSION['username'])){

    $_SESSION['auth_err'] = 'Please login properly!';
    header('location:index.php');
}

$uri_arr = explode('/',$_SERVER['REQUEST_URI']);
$current_page= explode('?',end($uri_arr));
$current_page=$current_page[0];

if(!in_array($permission[$current_page], $_SESSION['user_permissions'])){
    header('location:Access_Denied.php');
}
?>