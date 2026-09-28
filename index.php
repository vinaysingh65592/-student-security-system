<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['submit'])) {
    include_once('db_connect.php');

    $allowedRoles = ['admin', 'teacher', 'staff', 'parent'];
    $who = isset($_POST['who']) ? trim($_POST['who']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, trim($_POST['email'])) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, trim($_POST['password'])) : '';

    if (in_array($who, $allowedRoles) && !empty($email) && !empty($password)) {
        $query = "SELECT * FROM `tbl_$who` WHERE email='$email' AND password='$password' LIMIT 1";
        $res = mysqli_query($conn, $query);
        if ($res && $row = mysqli_fetch_array($res)) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $who;
            $_SESSION['user_id'] = isset($row['id']) ? $row['id'] : null;
            header('Location: ' . $who . '/' . $who . '_dashboard.php');
            exit();
        } else {
            header("Location: index.php?msg=2");
            exit();
        }
    } else {
        header("Location: index.php?msg=2");
        exit();
    }
}
if (isset($_REQUEST['msg'])) {
    $msg = $_REQUEST['msg'];
    if ($msg == 1) {
        echo ("<script>alert('Unauthorized Access... Accessing directly through path is Denied')</script>");
    } else if ($msg == 2) {
        echo "<script>alert('Invalid Details.. Please provide correct details')</script>";
    } else if ($msg == 3) {
        echo "<script>alert('Successfully Logged Out... Thanks for Visiting.')</script>";
    }
    else if ($msg == 4) {
        echo "<script>alert('all field are requird')</script>"; 
    
    } else if ($msg == 5) {
        echo "<script>alert('Query submit successfully')</script>"; 
}
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Security System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Bootstrap Icons CSSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

</head>

<body>

    <!-- Navbar Starts-->
    <div id="navbar">
        <nav class="navbar navbar-expand-lg fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="assets/image/logo/logo.png" width="75px" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>
                <div class="collapse navbar-collapse py-4 mt-2" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#hero">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#about">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#services">Facilities & Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#contact">Contact Us</a>
                        </li>
                    </ul>
                    <a class="nav-link login-btn px-5 py-2 mx-4" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Login</a>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">

                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Log In</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body p-5 pt-0">
                                        <form action="" class="" method="post">
                                            <select required name="who" class="form-select form-select-md mb-3" aria-label=".form-select-lg example">
                                                <option value="">Login As</option>
                                                <option value="admin">Admin</option>
                                                <option value="teacher">Teachers</option>
                                                <option value="staff">Staff</option>
                                                <option value="parent">Parent</option>
                                            </select>
                                            <div class="form-floating mb-3">
                                                <input required type="email" name="email" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com">
                                                <label for="floatingInput">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input required type="password" name="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password">
                                                <label for="floatingPassword">Password</label>
                                            </div>
                                            <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit" name="submit">Log In</button>
                                            <small class="text-body-secondary">
                                                <a href="forgot-password.php">Forget Password</a>
                                            </small>
                                            <hr class="my-4">

                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal ends -->
                </div>
            </div>
        </nav>
    </div>

    <!-- Navbar Ends here -->

    <!-- Carousel Starts here -->

    <header>
        <section class="hero" id="hero">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="carousel-background">
                            <img src="assets/image/sliders/slider1.jpg" alt="">
                            <div class="carousel-container">
                                <div class="carousel-content-container">
                                    <h2>Student Security Portal</h2>
                                    <p>
                                        Student Security Portal is introduced to shift the Attendance Marking of the
                                        student on Online Platform on the basis of which student daily routines are
                                        tracked and thier reports are sent to thier Parents. Parent can also see tha
                                        their child are attending the class regularly and if a child become sick then
                                        their parent can apply for the leave by providing the proper reason of Sickness.
                                    </p>
                                    <div class="button">
                                        <a href="#" class="button1">Our Services</a>
                                        <a href="#" class="button1">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-background">
                            <img src="assets/image/sliders/slider2.jpg" alt="">
                            <div class="carousel-container">
                                <div class="carousel-content-container">
                                    <h2>Verification of Student on Entry</h2>
                                    <p>
                                        Online student entry marking using a QR code printed on ID cards is a system
                                        where students scan a QR code on their ID card to mark their attendance. This
                                        process allows for a quick and contactless method of attendance taking, and
                                        provides real-time updates to teachers and administrators. It also enables
                                        better tracking and monitoring of student attendance, and reduces the risk of
                                        errors or discrepancies in attendance records.
                                    </p>
                                    <div class="button">
                                        <a href="#" class="button1">Our Services</a>
                                        <a href="#" class="button1">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="carousel-background">
                            <img src="image/sliders/slider3.jpg" alt="">
                            <div class="carousel-container">
                                <div class="carousel-content-container">
                                    <h2>Class Attendance Marking by Teacher</h2>
                                    <p>
                                        Class attendance marking is the process of recording and tracking the attendance
                                        of students in a classroom or educational setting. This typically involves
                                        taking attendance at the beginning of class, either manually or electronically,
                                        and recording the presence or absence of each student. Teachers and
                                        administrators may use attendance records to monitor student progress, identify
                                        patterns of absences, and intervene when necessary to help students stay on
                                        track academically. Accurate and consistent attendance marking is an important
                                        aspect of ensuring that students receive the support they need to succeed in
                                        their academic pursuits.
                                    </p>
                                    <div class="button">
                                        <a href="#" class="button1">Our Services</a>
                                        <a href="#" class="button1">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
    </header>
    <!-- Carousel Ends here -->

    <!-- About Section Starts here -->

    <section id="about" class="about mt-3">
        <div class="container-fluid">
            <div class="row py-2">
                <div class="col-md-6 d-none d-md-flex d-lg-flex">
                    <img src="assets/image/sliders/slider4.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-md-6">
                    <div class="about-content text-center">
                        <h1>About Us</h1>
                        <h2>Welcome to Student Security System</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. At deserunt pariatur accusamus
                            magnam quaerat voluptas perferendis nulla, odit, animi molestias iusto? Perferendis tempore
                            enim nostrum sunt ipsam rem expedita odit.</p>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fugit labore similique obcaecati
                            quam magni illum. Tempora, voluptas repudiandae. Dicta rerum, non officia eveniet modi
                            perferendis atque quaerat? Tempora, fugiat quisquam?</p>
                        <div class="button">
                            <a href="#" class="button3">Read More
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section Ends here -->

    <!-- Services section starts -->
    <section class="mt-5 mb-5 services" id="services">
        <div class="container">
            <div class="row mb-5">
                <h2 class="text-center">Our Facilities & Services</h2>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="main-service-box">
                        <div class="icon">
                            <i class="bi bi-house-door-fill"></i>
                        </div>
                        <h3>Bus Service</h3>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et beatae, nulla esse repellat
                            ratione deleniti natus.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="main-service-box">
                        <div class="icon">
                            <i class="bi bi-house-door-fill"></i>
                        </div>
                        <h3>Academic Attendance</h3>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et beatae, nulla esse repellat
                            ratione deleniti natus.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="main-service-box">
                        <div class="icon">
                            <i class="bi bi-house-door-fill"></i>
                        </div>
                        <h3>Student Monitoring</h3>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et beatae, nulla esse repellat
                            ratione deleniti natus.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="main-service-box">
                        <div class="icon">
                            <i class="bi bi-house-door-fill"></i>
                        </div>
                        <h3>Lorem Epsum</h3>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Et beatae, nulla esse repellat
                            ratione deleniti natus.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!--  Services section ends -->

    <!-- Contact Section Starts here -->

    <section class="mt-5 mb-5 contact" id="contact">
        <div class="container">
            <div class="row mb-4">
                <h2 class="text-center">Contact Us</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <h3 class="text-center">Mail to Us</h3>
                    <div class="outer-form m-4 p-4">
                        <form action="query_code.php" method="post" id="query">
                            <input type="text" name="name" class="form-control mt-3" placeholder="Enter your Name">
                            <input type="email" name="email" class="form-control mt-3" placeholder="Enter your E-Mail Id">
                            <textarea id="query" name="query" class="form-control mt-3" rows="9" placeholder="Write your Message here"></textarea>
                            <input type="submit" class="form-control mt-3 btn btn-success">
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <h3 class="text-center">Our Address</h3>
                    <h5 class="mt-3">
                        Government Polytchnic Aadampur Tarabganj Gonda
                    </h5>
                    <p>Affilated to BTEUP(Board of Technical Education Uttar Pradesh) & AICTE</p>
                    <p>
                        <i class="bi bi-telephone-forward"></i> <a href="tel:+91 1122334455">+91 1122334455</a>
                    </p>
                    <p>
                        <i class="bi bi-envelope"></i> <a href="mailto:gpatarabganjgonda@gmail.com">gpatarabganjgonda@gmail.com</a>
                    </p>
                    <p>
                        <i class="bi bi-geo-alt"></i> <a href="https://www.google.com/maps?ll=26.925455,81.885952&z=17&t=m&hl=en&gl=IN&mapclient=embed&cid=8157931189557962239">
                            Government Polytechnic Adampur Tarabganj Gonda</a>
                    </p>
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1212.4264726818437!2d81.88524806748046!3d26.925462718781187!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3999f62995555555%3A0x7136cb31bfaea5ff!2sGovernment%20Polytechnic%20Aadampur%20Tarabganj%20Gonda!5e0!3m2!1sen!2sin!4v1680514999718!5m2!1sen!2sin" width="100%" height="250px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Contact Section Ends here -->

    <!-- Footer section starts here -->

    <section class="mt-5 mb-5 bg-red" id="footer">

    </section>

    <!-- Footer section ends here -->



    <script src="assets/js/bootstrap.bundle.js"></script>
    <script src="assets/js/index.js">
    </script>
</body>

</html>