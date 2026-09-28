<?php
session_start();
if(isset($_SESSION['email']))
{
include('../db_connect.php');
if (isset($_REQUEST['app_id'])) {
    $app_id=$_REQUEST['app_id'];
    if (isset($_REQUEST['status'])) {
        $status=$_REQUEST['status'];
        if ($status==1) {
            # code...
            $query="update tbl_application set status ='Accept' where app_id=$app_id";
        }
        else {
            $query="update tbl_application set status ='Reject' where app_id=$app_id";
        }
        mysqli_query($conn,$query);
    }
}
include('admin_dash_header.php');
?>
<div class="text">Manage Application</div>
    <div id="content">
        <!-- Main Content goes here -->
        <table width=100% class="table view table-striped" cellpadding="2" cellspacing="20">
            <thead class="mx-auto">
                <th class="mx-auto">S.No.</th>
                <th>Student Id</th>
                <th>Subject</th>
                <th>Reason</th>
                <th>Date of appliction</th>
                <th>Accept</th>
                <th>Reject</th>
            </thead>
            <tbody>
                <?php
                $query = "select * from tbl_application where status='Pending'";
                // echo $query  
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
                    <td><form action="manage_application.php?app_id=<?php echo $row['app_id'] ?>&status=1" method="post"><button class="form-control btn btn-success w-50 mt-5 ms-4" type="submit" id="submit">Accept</button></form></td>
                    <td><form action="manage_application.php?app_id=<?php echo $row['app_id'] ?>&status=0" method="post"><button class="form-control btn btn-danger w-50 mt-5 ms-4" type="submit" id="submit">Reject</button>
                </form></td>
                </tr>
                <?php
                $a++;
                }
                ?>
            </tbody>
        </table>

<script>

</script>
<?php
include('admin_dash_footer.php');
}
else
{
    header('location:../index.php?msg=1');
}
?>