<?php

session_start();

session_unset();
session_destroy();

session_start();

$_SESSION['auth_err'] = 'You Are not Authorized to View the Accessed Content';

header('location:index.php');

?>