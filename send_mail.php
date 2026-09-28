<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/con.php';

if (isset($_POST['check-email'])) {
    $_SESSION['errors'] = array();
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $who = isset($_POST['who']) ? trim($_POST['who']) : '';

    $allowedRoles = ['admin', 'teacher', 'staff', 'parent'];
    if (!in_array($who, $allowedRoles)) {
        $_SESSION['errors'][] = "Please select a valid user role.";
    } elseif (empty($email)) {
        $_SESSION['errors'][] = "Please provide an email address.";
    } else {
        $checkQuery = "SELECT * FROM `tbl_$who` WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $checkQuery);

        if ($result && mysqli_num_rows($result) > 0) {
            $otp = rand(100000, 999999);
            $_SESSION['reset_code'] = $otp;
            $_SESSION['reset_email'] = $email;
            $_SESSION['reset_who'] = $who;
            $_SESSION['email'] = $email;

            // Update usertable if available
            $updateUser = "UPDATE usertable SET code = $otp WHERE email = '$email'";
            @mysqli_query($conn, $updateUser);

            // Send notification email (SMTP or standard mail)
            $subject = "Password Reset Code - Student Security System";
            $message = "Your password reset code is: " . $otp . "\n\nPlease use this code to change your password.";
            $headers = "From: " . (getenv('SMTP_FROM_EMAIL') ?: 'noreply@college.edu') . "\r\n" .
                       "Reply-To: " . (getenv('SMTP_FROM_EMAIL') ?: 'noreply@college.edu') . "\r\n" .
                       "X-Mailer: PHP/" . phpversion();

            @mail($email, $subject, $message, $headers);

            $_SESSION['info'] = "Password reset verification code generated! You may now set your new password.";
            header('Location: new-password.php');
            exit();
        } else {
            $_SESSION['errors'][] = "No account found with this email for the selected role ($who).";
        }
    }
}
?>
