<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../db_connect.php');

if (!isset($_SESSION['email'])) {
    header('Location: ../index.php?msg=1');
    exit();
}

header('Location: parent_child_profile.php');
exit();
?>
