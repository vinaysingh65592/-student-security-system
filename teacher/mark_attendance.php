<?php
include('teacher_dash_header.php');

$selected_class = isset($_POST['class']) ? mysqli_real_escape_string($conn, $_POST['class']) : '';
$doa = isset($_POST['doa']) ? str_replace('-', '', $_POST['doa']) : date('Ymd');
$display_date = isset($_POST['doa']) ? $_POST['doa'] : date('Y-m-d');
$msg = '';

if (isset($_POST['save_attendance'])) {
    if (!empty($_POST['status']) && is_array($_POST['status'])) {
        foreach ($_POST['status'] as $stu_id => $status) {
            $stu_id = mysqli_real_escape_string($conn, $stu_id);
            $status = mysqli_real_escape_string($conn, $status);
            
            // Delete existing attendance entry for student on that date to prevent duplicates
            mysqli_query($conn, "DELETE FROM `tbl_attendance` WHERE stu_id='$stu_id' AND doa='$doa'");
            
            if ($status === 'Present') {
                mysqli_query($conn, "INSERT INTO `tbl_attendance` (`stu_id`, `doa`, `status`, `time`) VALUES ('$stu_id', '$doa', 'Present', CURTIME())");
            }
        }
        $msg = "<div class='alert alert-success'>Attendance saved successfully for $display_date!</div>";
    }
}
?>
<div class="text">Mark Attendance</div>
<div id="content" style="padding: 20px;">
    <?php echo $msg; ?>
    <div class="card p-3 mb-4 shadow-sm">
        <form method="post" action="mark_attendance.php" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Select Class:</label>
                <select name="class" class="form-control" required onchange="this.form.submit()">
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
            <div class="col-md-4">
                <label class="form-label">Attendance Date:</label>
                <input type="date" name="doa" class="form-control" value="<?php echo $display_date; ?>" onchange="this.form.submit()">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-secondary w-100">Load Students</button>
            </div>
        </form>
    </div>

    <?php if (!empty($selected_class)): ?>
    <div class="card p-3 shadow-sm">
        <h5>Students in Class <?php echo htmlspecialchars($selected_class); ?></h5>
        <form method="post" action="mark_attendance.php">
            <input type="hidden" name="class" value="<?php echo htmlspecialchars($selected_class); ?>">
            <input type="hidden" name="doa" value="<?php echo htmlspecialchars($display_date); ?>">
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>Roll No.</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Attendance Status</th>
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
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status[<?php echo $sid; ?>]" id="pres_<?php echo $sid; ?>" value="Present" <?php echo $isPresent ? 'checked' : ''; ?> required>
                                    <label class="form-check-label text-success font-weight-bold" for="pres_<?php echo $sid; ?>">Present</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status[<?php echo $sid; ?>]" id="abs_<?php echo $sid; ?>" value="Absent" <?php echo !$isPresent ? 'checked' : ''; ?>>
                                    <label class="form-check-label text-danger font-weight-bold" for="abs_<?php echo $sid; ?>">Absent</label>
                                </div>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>No students found registered in Class $selected_class.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <?php if (mysqli_num_rows($studentsRes) > 0): ?>
            <button type="submit" name="save_attendance" class="btn btn-primary px-4">Submit Attendance</button>
            <?php endif; ?>
        </form>
    </div>
    <?php endif; ?>
</div>
<?php
include('teacher_dash_footer.php');
?>
