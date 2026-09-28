<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('../db_connect.php');

$image = isset($_FILES['image']['name']) ? basename($_FILES['image']['name']) : '';
$tmp_name = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';
$location = "../assets/image/profile_image/parent/";

if (!is_dir($location)) {
    @mkdir($location, 0777, true);
}

$parent_id = mysqli_real_escape_string($conn, $_POST['parent_id']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
$m_name = mysqli_real_escape_string($conn, $_POST['m_name']);
$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$address = mysqli_real_escape_string($conn, $_POST['address']);

$query = "SELECT * FROM `tbl_parent` WHERE parent_id='$parent_id' AND password='$password' LIMIT 1";
$res = mysqli_query($conn, $query);

if ($res && mysqli_num_rows($res) > 0) {
    if (empty($image)) {
        $query2 = "UPDATE `tbl_parent` SET f_name='$f_name', m_name='$m_name', mobile='$mobile', email='$email', address='$address' WHERE parent_id='$parent_id'";
    } else {
        $query2 = "UPDATE `tbl_parent` SET f_name='$f_name', m_name='$m_name', mobile='$mobile', email='$email', p_file='$image', address='$address' WHERE parent_id='$parent_id'";
        move_uploaded_file($tmp_name, $location . $image);
    }
    
    if (mysqli_query($conn, $query2)) {
        header('Location: parent_profile.php?msg=1');
        exit();
    } else {
        header('Location: edit_profile.php?msg=error');
        exit();
    }
} else {
    header('Location: edit_profile.php?msg=invalid_password');
    exit();
}
