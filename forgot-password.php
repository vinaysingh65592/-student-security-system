<?php
// session_start();
include('send_mail.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="" method="POST" autocomplete="">
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">Enter your email address</p>
                    <?php
                    
                    if (isset($_SESSION['errors'])) {
                        
                    ?>
                            <div class="alert alert-danger text-center">
                            <?php

                            # code...
                            $errors = $_SESSION['errors'];
                            foreach ($errors as $error) {
                                echo $error;
                            
                        }
                            ?>
                            </div>
                        <?php
                    }
                        ?>
                        <div class="form-group">
                            <select required name="who" class="form-select form-select-md mb-3 from-control" aria-label=".form-select-lg example">
                                <option value="">Forget As</option>
                                <option value="admin">Admin</option>
                                <option value="teacher">Teachers</option>
                                <option value="staff">Staff</option>
                                <option value="parent">Parent</option>
                            </select>
                            <input class="form-control" type="email" name="email" placeholder="Enter email address" required value="<?php  ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control button" type="submit" name="check-email" value="Continue">
                        </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>