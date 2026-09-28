<?php
session_start();
if(isset($_SESSION['email']))
{
include('admin_dash_header.php');
include("../db_connect.php");
$query="select * from tbl_teacher";
$res=mysqli_query($conn,$query);

?>
                <div class="text">SEE REGISTERED TEACHER</div>
                <div id="content">
<div class="row table">
    <table width=100% class="table view table-striped">
        <thead align="center">
            <th>S.No.</th>
            <th>PARENT ID</th>
            <th>NAME</th>
            <th>DATE OF BIRTH</th>
            <th>GENDER</th>
            <th>MOBILE</th>
            <th>EMAIL</th>
            <!-- <th>PARENT ID</th> -->
            <th>DATE OF REGISTRATION</th>
            <!-- <th>GENRATE ID</th> -->
        </thead>
        <tbody>
        <?php
        $a=1;
        while($row=mysqli_fetch_array($res))
        {
    
    ?>
     <tr>
        <td><?php echo $a;?></td>
        <!-- <td></td> -->
        <td><?php echo $row['teacher_id'];?></td>
        <td><?php echo $row['name'];?></td>
        <td><?php echo $row['date_of_brith'];?></td>
        <td><?php echo $row['gender'];?></td>
        <td><?php echo $row['mobile'];?></td>
        <td><?php echo $row['email'];?></td>
        <td><?php echo $row['dor'];?></td>
        

     </tr>
     <?php
        $a++;
        }
     ?>
        </tbody>
    </table>
</div>
<?php
?>


<?php
include('admin_dash_footer.php');
}
else
{
    header('location:../index.php?msg=1');
}
?>