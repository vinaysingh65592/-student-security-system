<?php
include('../db_connect.php');

$name = mysqli_real_escape_string($conn, $_POST['name']);
$crp = mysqli_real_escape_string($conn, $_POST['crp']);
$cp = mysqli_real_escape_string($conn, $_POST['cp']);
$dob = mysqli_real_escape_string($conn, $_POST['dob']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$teacher_id = "TCH" . date('Y') . rand(100, 999);

if ($crp === $cp) {
    $query = "INSERT INTO `tbl_teacher`(`teacher_id`, `name`, `gender`, `date_of_brith`, `mobile`, `address`, `email`, `password`, `dor`) VALUES ('$teacher_id', '$name', '$gender', '$dob', '$mobile', '$address', '$email', '$crp', curdate())";
    if (mysqli_query($conn, $query)) {
        header('Location: teacher_reg.php?error=1');
        exit();
    } else {
        header('Location: teacher_reg.php?error=3');
        exit();
    }
} else {
    header('Location: teacher_reg.php?error=2');
    exit();
}


