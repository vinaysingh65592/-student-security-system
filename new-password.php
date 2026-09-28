<?php
session_start();
include('db_connect.php');
if (isset($_POST['change-password'])) {

    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password not matched!";
    } else {
        $code = 0;
        $email = mysqli_real_escape_string($conn, $_SESSION['email']);
        $safe_password = mysqli_real_escape_string($conn, $password);
        $who = isset($_SESSION['reset_who']) && in_array($_SESSION['reset_who'], ['admin', 'teacher', 'staff', 'parent']) ? $_SESSION['reset_who'] : 'admin';
        
        $update_pass = "UPDATE `tbl_$who` SET password = '$safe_password' WHERE email = '$email'";
        $run_query = mysqli_query($conn, $update_pass);
        
        // Also update usertable if present
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        @mysqli_query($conn, "UPDATE usertable SET code = 0, password = '$encpass' WHERE email = '$email'");
        
        if ($run_query) {
            $info = "Your password has been changed successfully. Now you can log in with your new password.";
            $_SESSION['info'] = $info;
            header('Location: password-changed.php');
            exit();
        } else {
            $errors['db-error'] = "Failed to change your password: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create a New Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="new-password.php" method="POST" autocomplete="off">
                    <h2 class="text-center">New Password</h2>

                    <?php
                    if (!empty($errors)) {
                        # code...
                        if (count($errors) > 0) {
                    ?>
                            <div class="alert alert-warning  fade show" role="alert">
                                <?php
                                foreach ($errors as $showerror) {
                                    echo $showerror;
                                }
                                ?>
                               
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Create new password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password" value="Change">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>