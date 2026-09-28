<?php
include('staff_dash_header.php');
?>
<div class="text">Staff Profile</div>
<div id="content" style="padding: 20px;">
    <div class="card p-4 shadow-sm" style="max-width: 600px;">
        <table class="table table-borderless">
            <tr>
                <th width="35%">Staff ID:</th>
                <td><?php echo htmlspecialchars($staff['staff_id'] ?? 'N/A'); ?></td>
            </tr>
            <tr>
                <th>Full Name:</th>
                <td><?php echo htmlspecialchars($staff['name'] ?? 'N/A'); ?></td>
            </tr>
            <tr>
                <th>Gender:</th>
                <td><?php echo htmlspecialchars($staff['gender'] ?? 'N/A'); ?></td>
            </tr>
            <tr>
                <th>Date of Birth:</th>
                <td><?php echo htmlspecialchars($staff['date_of_brith'] ?? 'N/A'); ?></td>
            </tr>
            <tr>
                <th>Mobile Number:</th>
                <td><?php echo htmlspecialchars($staff['mobile'] ?? 'N/A'); ?></td>
            </tr>
            <tr>
                <th>Email Address:</th>
                <td><?php echo htmlspecialchars($staff['email'] ?? 'N/A'); ?></td>
            </tr>
            <tr>
                <th>Address:</th>
                <td><?php echo nl2br(htmlspecialchars($staff['address'] ?? 'N/A')); ?></td>
            </tr>
            <tr>
                <th>Date of Registration:</th>
                <td><?php echo htmlspecialchars($staff['dor'] ?? 'N/A'); ?></td>
            </tr>
        </table>
    </div>
</div>
<?php
include('staff_dash_footer.php');
?>
