<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$roll = ''; 
include('../db_connect.php');
include('../phpqrcode/qrlib.php');

$stu_name = mysqli_real_escape_string($conn, $_POST['stu_name']);
$class = mysqli_real_escape_string($conn, $_POST['class']);
$query = "select * from tbl_student where class='$class' order by id desc limit 1";
$res = mysqli_query($conn, $query);
if ($row = mysqli_fetch_array($res)) {
    $roll = (int)$row['roll'] + 1;
} else {
    $roll = 1;
}

$dob = mysqli_real_escape_string($conn, $_POST['dob']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
$m_name = mysqli_real_escape_string($conn, $_POST['m_name']);
$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$file = isset($_FILES['file']['name']) ? basename($_FILES['file']['name']) : '';
$tmp_name = isset($_FILES['file']['tmp_name']) ? $_FILES['file']['tmp_name'] : '';
$aadhar_no = mysqli_real_escape_string($conn, $_POST['aadhaar']);
$path = '../assets/qr_img/';
if (!is_dir($path)) {
    @mkdir($path, 0777, true);
}
$year = date('Y');
$stu_id = "SSS$year$class$roll";
$file_name = $path . $stu_id . ".png";
$parent_id = !empty($_POST['parent_id']) ? mysqli_real_escape_string($conn, $_POST['parent_id']) : "PPP$year$class$roll";
$address = mysqli_real_escape_string($conn, $_POST['address']);

QRcode::png("$stu_id", $file_name, QR_ECLEVEL_L, 10, 1);

$query = "INSERT INTO `tbl_student`(`stu_id`, `roll`, `stu_name`, `class`, `dob`, `gender`, `f_name`, `m_name`, `aadhar_no.`, `email`, `mobile`, `p_file`, `qr_file`, `parent_id`, `address`, `dor`) VALUES ('$stu_id','$roll','$stu_name','$class','$dob','$gender','$f_name','$m_name','$aadhar_no','$email','$mobile','$file','$file_name','$parent_id','$address',curdate())";

if (mysqli_query($conn, $query)) {
    if (!empty($file) && !empty($tmp_name)) {
        $photoDir = "../assets/image/student_photo/";
        if (!is_dir($photoDir)) {
            @mkdir($photoDir, 0777, true);
        }
        move_uploaded_file($tmp_name, $photoDir . $file);
    }
    $queryParent = "INSERT INTO `tbl_parent`(`parent_id`, `f_name`, `m_name`, `mobile`, `email`, `password`, `stu_id`,`address`,`dor`) VALUES ('$parent_id','$f_name','$m_name','$mobile','$email','$mobile','$stu_id','$address',curdate()) ON DUPLICATE KEY UPDATE `mobile`=VALUES(`mobile`)";
    mysqli_query($conn, $queryParent);
    
    $_SESSION['msg'] = 1;
    header('Location: student_reg.php');
    exit();
} else {
    $_SESSION['msg'] = 2;
    header('Location: student_reg.php');
    exit();
}

