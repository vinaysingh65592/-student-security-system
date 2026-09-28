<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['email'])) {
    include('../db_connect.php');
    $email = $_SESSION['email'];
    $query = "SELECT * FROM `tbl_staff` WHERE email='$email' LIMIT 1";
    $res = mysqli_query($conn, $query);
    $staff = mysqli_fetch_array($res);
} else {
    header('Location: ../index.php?msg=1');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/admin_dash.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Staff Panel - Student Security System</title>
</head>

<body>
    <div class="outer">
        <nav class="sidebar close">
            <header>
                <div class="image-text">
                    <span class="image">
                        <img src="../assets/image/logo/logo.png" alt="logo" onerror="this.src='../assets/image/logo.png'">
                    </span>
                    <div class="text header-text">
                        <span class="name">Student Security System</span>
                        <span class="user">Staff Panel</span>
                    </div>
                </div>
            </header>
            <div class="menu-bar">
                <div class="menu">
                    <li class="nav-link">
                        <a href="staff_dashboard.php">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="staff_profile.php">
                            <i class="bx bx-user icon"></i>
                            <span class="text nav-text">My Profile</span>
                        </a>
                    </li>
                </div>
                <div class="bottom-content">
                    <li>
                        <a href="staff_logout_code.php">
                            <i class="bx bx-log-out icon"></i>
                            <span class="text nav-text">Logout</span>
                        </a>
                    </li>
                </div>
            </div>
        </nav>
        <section class="home full">
            <div class="box">
                <i class='bx bxs-chevron-right toggle'></i>
