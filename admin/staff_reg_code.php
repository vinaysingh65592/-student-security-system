<?php
include('../db_connect.php');

$crp = mysqli_real_escape_string($conn, $_POST['crp']);
$cp = mysqli_real_escape_string($conn, $_POST['cp']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$dob = mysqli_real_escape_string($conn, $_POST['dob']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$staff_id = "STF" . date('Y') . rand(100, 999);

if ($crp === $cp) {
    $query = "INSERT INTO `tbl_staff`(`staff_id`, `name`, `date_of_brith`, `gender`, `email`, `password`, `mobile`, `address`, `dor`) VALUES ('$staff_id', '$name', '$dob', '$gender', '$email', '$crp', '$mobile', '$address', curdate())";
    if (mysqli_query($conn, $query)) {
        header('Location: staff_reg.php?error=1');
        exit();
    } else {
        header('Location: staff_reg.php?error=3');
        exit();
    }
} else {
    header('Location: staff_reg.php?error=2');
    exit();
}


