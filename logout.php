<?php

session_start();

session_unset();
session_destroy();

session_start();

$_SESSION['auth_err'] = 'Logged out successfully!';

header('location:index.php');

?>