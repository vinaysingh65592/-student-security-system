<?php
session_start();
if(isset($_SESSION['email']))
{
include('admin_dash_header.php');
include("../db_connect.php");
$query="select * from tbl_student";
$res=mysqli_query($conn,$query);

?>
                <div class="text">SEE REGISTERED STUDENT</div>
<div id="content">
<div class="row table">
    <table width=100% class="table view table-striped">
        <thead align="center">
            <th>S.No.</th>
            <th>PHOTO</th>
            <th>STUDENT ID</th>
            <th>STUDENT NAME</th>
            <th>CLASS</th>
            <th>DATE OF BIRTH</th>
            <th>GENDER</th>
            <th>FATHER'S NAME</th>
            <th>MOTHER'S Name</th>
            <th>MOBILE</th>
            <th>EMAIL</th>
            <th>PARENT ID</th>
            <th>ADDRESS</th>
            <th>DATE OF REGISTRATION</th>
            <th>GENRATE ID</th>
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
        <td><img src="../assets/image/student_photo/<?php echo $row['p_file'];?>" alt="" srcset=""></td>
        <td><?php echo $row['stu_id'];?></td>
        <td><?php echo $row['stu_name'];?></td>
        <td><?php echo $row['class'];?></td>
        <td><?php echo $row['dob'];?></td>
        <td><?php echo $row['gender'];?></td>
        <td><?php echo $row['f_name'];?></td>
        <td><?php echo $row['m_name'];?></td>
        <td><?php echo $row['mobile'];?></td>
        <td><?php echo $row['email'];?></td>
        <td><?php echo $row['parent_id'];?></td>
        <td><?php echo $row['address'];?></td>
        <td><?php echo $row['dor'];?></td>
        <td><a href="id_card.php?id=<?php echo $row['id'];?>"><i class='bx bx-id-card'></i></a></td>

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