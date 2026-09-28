<?php
session_start();
include('../db_connect.php');
if (isset($_SESSION['email'])) {
    include('parent_dash_header.php');

?>
    <div class="text">Dashboard</div>
    <div id="content">

        <!-- Main Content goes here -->

        <div class="row justify-content-end pb-3">
            <div class="col-sm-2 col-md-2 mb-3 btn btn-primary mx-2"><a href="parent_profile.php" style="text-decoration:none;" class="text-white">Back to Profile</a></div>
        </div>
        <form action="change_pass_code.php" method="post">
            input
        </form>

    <?php

    include('parent_dash_footer.php');
} else
    header('location:../index.php?msg=1');
    ?>