<?php
include('teacher_dash_header.php');

$query = "SELECT * FROM `tbl_student` ORDER BY class, roll ASC";
$res = mysqli_query($conn, $query);
?>
<div class="text">Registered Students</div>
<div id="content" style="padding: 20px;">
    <div class="card p-3 shadow-sm">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Roll</th>
                    <th>Gender</th>
                    <th>Parent Mobile</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($res && mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_array($res)) {
                        $photo = !empty($row['p_file']) ? '../assets/image/student_photo/' . $row['p_file'] : '../assets/image/student_photo/photo.jpg';
                ?>
                    <tr>
                        <td><img src="<?php echo htmlspecialchars($photo); ?>" width="40" height="40" style="object-fit:cover; border-radius:50%;" onerror="this.src='../assets/image/profile_image/parent/user.jpg'"></td>
                        <td><?php echo htmlspecialchars($row['stu_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['stu_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['class']); ?></td>
                        <td><?php echo htmlspecialchars($row['roll']); ?></td>
                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                    </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No students registered yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include('teacher_dash_footer.php');
?>
