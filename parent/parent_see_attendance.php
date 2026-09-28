<?php
session_start();
if (isset($_SESSION['email'])) {
    include('parent_dash_header.php');

?>
    <div class="text">Attendance</div>
    <div id="content">
        <!-- main contiant -->


        <!-- Main Content goes here -->
        <div class="row mb-5">
            <div class="col-sm-12 w-100">
                <form action="" method="post">
                    <table class="w-100">
                        <tr>
                            <td><b>From</b></td>
                            <td><b>To</b></td>
                        </tr>
                        <tr>

                            <td>
                                <input type="date" name="from" required='date' class="form form-control">
                                <?php
                                // echo $parent_id;
                                ?>
                            </td>
                            <td>
                                <input type="date" name="to" required id='date' class="form form-control">

                            </td>
                            <td>

                                <input type="submit" class="form form-control bg-danger" value="LOAD">
                </form>
                </td>
                </tr>
                </table>

            </div>

        </div>
        <?php
        if (isset($_POST['from']) && isset($_POST['to'])) {
        ?>
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-center">
                    <h3 class="">Attendance</h3>
                </div>
            </div>
            <table width=100% >

                <tbody>

                    <thead style="text-align: center;">
                        <th>S.no</th>
                        <!-- <th>Student ID</th> -->
                        <!-- <th>Student Name</th> -->
                        <th>Attendance</th>
                        <th>Date</th>
                    </thead>
                    <tbody style="text-align: center;">
                    <?php

                    $date_from = $_POST['from'];
                    $date_from_rev = strrev($date_from);
                    $date_to = $_POST['to'];
                    // $date_to_rev = strrev($date_to);
                    $date_from = str_replace('-', '', $date_from);
                    $date_to = str_replace('-', '', $date_to);
                    // echo $date_from;
                    $a = 1;
                    for ($d = $date_from; $d <= $date_to; $d++) {




                    ?>

                        <tr>
                            <td><?php echo $a  ?></td>
                            <!-- <td><?php

                                ?></td>
                            <td><?php

                                ?></td> -->
                            <td><?php
                                $query = "SELECT * FROM `tbl_attendance` where stu_id='$stu_id' and doa=$d";
                                $res = mysqli_query($conn, $query);
                                // echo $query;
                                if (mysqli_fetch_array($res)) {
                                    echo 'Present';
                                } else {
                                    echo 'Absent';
                                }
                                ?></td>
                                <td><?php echo $d ?></td>

                        </tr>
                <?php
                        $a++;
                    }
                }
                ?>
                </tbody>

            </table>

            <?php


            ?>


        <?php
        include('parent_dash_footer.php');
    } else
        header('location:../index.php?msg=1');
        ?>