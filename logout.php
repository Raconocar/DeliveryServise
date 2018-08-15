<?php
require_once 'module.php';
session_start();
// echo $_SESSION['user'];
logout();
session_destroy();
?>