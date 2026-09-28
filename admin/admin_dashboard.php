<?php
session_start();
if (isset($_SESSION['email'])) {
    include('admin_dash_header.php');
?>
    <div class="text">Dashboard</div>
    <div id="content">
        <div class="row outer">
        <!-- Content goes here -->

        </div>
    <?php
    include('admin_dash_footer.php');
} else {
    header('location:../index.php?msg=1');
}
    ?>