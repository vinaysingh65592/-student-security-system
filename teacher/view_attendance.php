<?php
include('teacher_dash_header.php');

$selected_class = isset($_POST['class']) ? mysqli_real_escape_string($conn, $_POST['class']) : '';
$doa = isset($_POST['doa']) ? str_replace('-', '', $_POST['doa']) : date('Ymd');
$display_date = isset($_POST['doa']) ? $_POST['doa'] : date('Y-m-d');
?>
<div class="text">View Attendance</div>
<div id="content" style="padding: 20px;">
    <div class="card p-3 mb-4 shadow-sm">
        <form method="post" action="view_attendance.php" class="row g-3 align-items-end">
            <div class="col-md-5">
                <label class="form-label">Select Class:</label>
                <select name="class" class="form-control" required>
                    <option value="">-- Choose Class --</option>
                    <?php
                    $classes = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X'];
                    foreach ($classes as $c) {
                        $sel = ($selected_class === $c) ? 'selected' : '';
                        echo "<option value='$c' $sel>Class $c</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-5">
                <label class="form-label">Date:</label>
                <input type="date" name="doa" class="form-control" value="<?php echo $display_date; ?>" required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>

    <?php if (!empty($selected_class)): ?>
    <div class="card p-3 shadow-sm">
        <h5>Attendance for Class <?php echo htmlspecialchars($selected_class); ?> on <?php echo htmlspecialchars($display_date); ?></h5>
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>Roll No.</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $studentsQuery = "SELECT * FROM `tbl_student` WHERE class='$selected_class' ORDER BY roll ASC";
                $studentsRes = mysqli_query($conn, $studentsQuery);
                
                if (mysqli_num_rows($studentsRes) > 0) {
                    while ($st = mysqli_fetch_array($studentsRes)) {
                        $sid = $st['stu_id'];
                        $attCheck = mysqli_query($conn, "SELECT * FROM `tbl_attendance` WHERE stu_id='$sid' AND doa='$doa'");
                        $isPresent = (mysqli_num_rows($attCheck) > 0);
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($st['roll']); ?></td>
                        <td><?php echo htmlspecialchars($st['stu_id']); ?></td>
                        <td><?php echo htmlspecialchars($st['stu_name']); ?></td>
                        <td>
                            <?php if ($isPresent): ?>
                                <span class="badge bg-success p-2">Present</span>
                            <?php else: ?>
                                <span class="badge bg-danger p-2">Absent</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No students found for this class.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
<?php
include('teacher_dash_footer.php');
?>
