<?php
session_start();
//unset($_SESSION['uid']);
//unset($_SESSION['username']);
//unset($_SESSION['usertype']);

if (session_destroy()) {
    header('location: index.php');
}
