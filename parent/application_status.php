<?php
session_start();
if (isset($_SESSION['email'])) {
    include('../db_connect.php');
    include('parent_dash_header.php');

?>
    <div class="text">Application Status</div>
    <div id="content">
        <!-- Main Content goes here -->
        <table width=100% class="table view table-striped" cellpadding="2" cellspacing="20">
            <thead class="mx-auto">
                <th class="mx-auto">S.No.</th>
                <th>Student Id</th>
                <th>Subject</th>
                <th>Reason</th>
                <th>Date of appliction</th>
                <th>Status</th>
            </thead>
            <tbody>
                <?php
                $query = "select * from tbl_application where parent_id='$parent_id'";
                $res = mysqli_query($conn, $query);
               
                $a=1;
                while ($row = mysqli_fetch_array($res)) {


                ?>
                <tr>

                    <td><?php echo $a; ?></td>
                    <td><?php echo $row['stu_id'] ?></td>
                    <td><?php echo $row['subject'] ?></td>
                    <td><?php echo $row['reason'] ?></td>
                    <td><?php echo $row['doa'] ?></td>
                    <td><?php echo $row['status'] ?></td>
                    <td><?php  ?></td>
                </tr>
                <?php
                $a++;
                }
                ?>
            </tbody>
        </table>

    <?php
    include('parent_dash_footer.php');
} else
    header('location:../index.php?msg=1');
    ?>