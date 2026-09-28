<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/admin_dash.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <!-- Icons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Dashboard Sidebar Menu</title>
</head>

<body>
    <div class="outer">


        <nav class="sidebar close">
            <header>
                <div class="image-text">
                    <span class="image">
                    <img src="../assets/image/logo/logo.png" alt="logo">
                    </span>
                    <div class="text header-text">
                        <span class="name">Student Security System</span>
                        <span class="user">Admin Panel</span>
                    </div>
                </div>
            </header>
            <div class="menu-bar">
                <div class="menu">
                    <li class="search-box">
                        <i class="bx bx-search icon"></i>
                        <input type="text" placeholder="Search....">
                    </li>
                    <!-- <ul class="menu-links"> -->

                        <li class="nav-link ">
                            <a href="student_reg.php">
                                <i class="bx bx-home-alt icon"></i>
                                <span class="text nav-text">Register Student</span>
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="see_reg_student.php">
                                <i class="bx bx-home-alt icon"></i>
                                <span class="text nav-text">See Registered Students</span>
                            </a>
                        </li>
                        <li class="nav-link ">
                            <a href="see_reg_parent.php">
                                <i class="bx bx-home-alt icon"></i>
                                <span class="text nav-text">See Registered Parent</span>
                            </a>
                        </li>
                    <li class="nav-link">
                        <a href="teacher_reg.php">
                            <i class="bx bx-pencil icon"></i>
                            <span class="text nav-text">Register Teacher</span>
                        </a>
                    </li>
                    <li class="nav-link ">
                        <a href="see_reg_teacher.php">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="text nav-text">See Registered Teacher</span>
                        </a>
                    </li>
                    <li class="nav-link ">
                        <a href="staff_reg.php">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="text nav-text">Register Staff</span>
                        </a>
                    </li>
                    <!-- <li class="nav-link ">
                        <a href="#">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="text nav-text">Register Parent</span>
                        </a>
                    </li> -->
                    <li class="nav-link">
                        <a href="see_reg_staff.php">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="text nav-text">See Registered Staff</span>
                        </a>
                    </li>
                    <li class="nav-link ">
                        <a href="manage_application.php">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="text nav-text">Manage Application</span>
                        </a>
                    </li>
                    <!-- </ul> -->
                </div>
                <div class="bottom-content">
                    <li class="">
                        <a href="logout_code.php">
                            <i class="bx bx-log-out icon"></i>
                            <span class="text nav-text">Logout</span>
                        </a>
                    </li>
                    <!-- <li class="mode">
                        <div class="moon-sun">
                            <i class="bx bx-moon icon moon"></i>
                            <i class="bx bx-sun icon sun"></i>
                        </div>
                        <span class="mode-text text">Dark Mode</span>

                        <div class="toggle-switch">
                            <span class="switch"></span>
                        </div>
                    </li> -->
                </div>
            </div>
        </nav>
        <section class="home full">
            <div class="box">
                <i class='bx bxs-chevron-right toggle'></i>
