<?php
if(isset($_SESSION['email']))
{
    include('../db_connect.php');
    $email=$_SESSION['email'];
    $query="select * from tbl_parent where email='$email'";
    // echo $query;
    $res=mysqli_query($conn,$query); 
    $row=mysqli_fetch_array($res);
    $parent_id=$row['parent_id'];
    $stu_id=$row['stu_id'];
    // echo $parent_id;

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/admin_dash.css"/>
    <link rel="stylesheet" href="../assets/css/bootstrap.css"/>
    <!-- Icons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Dashboard Sidebar Menu</title>
</head>

<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../assets/image/logo.png" alt="logo">
                </span>
                <div class="text header-text">
                    <span class="name">Student Security System</span>
                    <span class="user">Parent Panel</span>
                </div>
            </div>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <li class="nav-link">
                <a href="parent_dashboard.php">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="text nav-text">Back to Dashboard</span>
                        </a>
                </li>
                <!-- <ul class="menu-links"> -->
                    
                    
                    <li class="nav-link">
                        <a href="parent_profile.php">
                            <i class="bx bx-show icon"></i>
                            <span class="text nav-text">Parent Profile</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="parent_child_profile.php">
                            <i class="bx bx-show icon"></i>
                            <span class="text nav-text">Child Profile</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="parent_see_attendance.php">
                            <i class="bx bx-show icon"></i>
                            <span class="text nav-text">See Attendance</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="parent_apply_child_leave.php">
                            <i class="bx bx-note icon"></i>
                            <span class="text nav-text">Apply For Leave</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="application_status.php">
                            <i class="bx bx-note icon"></i>
                            <span class="text nav-text">Application Status</span>
                        </a>
                    </li>
             
                <!-- </ul> -->
            </div>
            <div class="bottom-content">
                <li class="">
                    <a href="parent_logout_code.php">
                        <i class="bx bx-log-out icon"></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
                <!-- <li class="mode">
                    <div class="moon-sun">
                        <i class="bx bx-moon icon moon"></i>
                        <i class="bx bx-sun icon sun"></i>
                    </div>
                     <span class="mode-text text">Dark Mode</span> -->

                    <!-- <div class="toggle-switch">
                        <span class="switch"></span>
                    </div> -->
                </li> 
            </div>
        </div>
    </nav>
    <section class="home full">
        <div class="container">
            <i class='bx bxs-chevron-right toggle'></i>
            