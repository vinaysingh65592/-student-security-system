<?php
include('teacher_dash_header.php');

$totalStudentsRes = mysqli_query($conn, "SELECT COUNT(*) as total FROM `tbl_student`");
$totalStudents = mysqli_fetch_assoc($totalStudentsRes)['total'];

$today = date('Ymd');
$todayAttRes = mysqli_query($conn, "SELECT COUNT(*) as total FROM `tbl_attendance` WHERE doa='$today' AND status='Present'");
$todayAtt = mysqli_fetch_assoc($todayAttRes)['total'];
?>
<div class="text">Teacher Dashboard</div>
<div id="content" style="padding: 20px;">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card p-3 shadow-sm">
                <h4>Welcome, <?php echo htmlspecialchars($teacher['name'] ?? 'Teacher'); ?>!</h4>
                <p class="text-muted">Teacher ID: <?php echo htmlspecialchars($teacher['teacher_id'] ?? 'N/A'); ?> | Email: <?php echo htmlspecialchars($teacher['email'] ?? ''); ?></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary p-3 shadow-sm">
                <h5>Total Students</h5>
                <h2><?php echo $totalStudents; ?></h2>
                <a href="view_students.php" class="text-white">View Student List &rarr;</a>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success p-3 shadow-sm">
                <h5>Today's Attendance (Present)</h5>
                <h2><?php echo $todayAtt; ?></h2>
                <a href="view_attendance.php" class="text-white">View Attendance &rarr;</a>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-info p-3 shadow-sm">
                <h5>Quick Action</h5>
                <h2>Mark</h2>
                <a href="mark_attendance.php" class="text-white">Take Attendance &rarr;</a>
            </div>
        </div>
    </div>
</div>
<?php
include('teacher_dash_footer.php');
?>
