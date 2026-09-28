<?php
session_start();
if (isset($_SESSION['email'])) {
  include('parent_dash_header.php');
  include('../db_connect.php');
  $email = $_SESSION['email'];
  $query = "select * from tbl_parent where email='$email'";
  $res = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($res);
  $parent_id = $row['parent_id'];
  // echo $parent_id;
  $leave_msg = '';
  if (isset($_POST['subject'])) {
    $sub = mysqli_real_escape_string($conn, $_POST['subject']);
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);
    $stu_id = mysqli_real_escape_string($conn, $_POST['stu_id']);
    $query = "INSERT INTO `tbl_application`(`parent_id`,`stu_id`, `subject`, `reason`, `doa`,`status`) VALUES ('$parent_id','$stu_id','$sub','$reason',curdate(),'Pending')";
    if (mysqli_query($conn, $query)) {
      $leave_msg = "<div class='alert alert-success'>Leave application submitted successfully!</div>";
    }
  }

?>
  <div class="text">Apply For Leave</div>
  <div id="content">
    <?php echo $leave_msg; ?>
    <!-- Main Content goes here -->
    <div class="row">
      <div class="col-sm-12 ">

        <form action="" method="post">
          <table>
            <tr>
              <td><b> Subject</b> </td>
              <td>
                <input type="text" name='subject' required class="form-control" />
              </td>
            </tr>
            <tr>
              <td><b>For</b> </td>
              <td>

                <select class="form-control" name="stu_id" id="">
                  <option value="">---select ---</option>
                  <?php
                  $query = "select * from tbl_parent where parent_id='$parent_id'";
                  $res = mysqli_query($conn, $query);

                  while ($row = mysqli_fetch_array($res)) {
                  ?>
                    <option value="<?php echo $row['stu_id']; ?>"><?php echo $row['stu_id']; ?></option>


                  <?php
                  }
                  ?>
                </select>
              </td>
            </tr>
            <tr>
            </tr>
            <tr>
              <td>

              </td>

            </tr>
            <tr>
              <td><b>Reason</b> </td>
            </tr>
            <tr>
              <td colspan="3">
                <textarea name="reason" required id="" class="form-control" cols="30" rows="10" style="resize: none;"></textarea>
              </td>
            </tr>

            </tbody>
          </table>
          <div class="row">

            <button class="form-control btn btn-info w-25 mt-5 ms-4" type="submit" id="submit">submit</button>
          </div>
        </form>
      </div>
    </div>


  <?php
  include('parent_dash_footer.php');
} else
  header('location:../index.php?msg=1');
  ?>