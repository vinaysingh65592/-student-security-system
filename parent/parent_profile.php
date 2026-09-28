<?php
session_start();
if (isset($_SESSION['email'])) {
  include('parent_dash_header.php');
  include('../db_connect.php');
  $email = $_SESSION['email'];
  $query = "select * from tbl_parent where email='$email'";
  $res = mysqli_query($conn, $query);

  if (isset($_REQUEST['msg'])) {
    $msg = $_REQUEST['msg'];
    if ($msg == 1) {
?>
      <script>
        alert("Profile is Updated Successfully..");
      </script>
    <?php
    }
  }
  if ($row = mysqli_fetch_array($res)) {

    ?>
    <div class="text">Profile</div>
    <div id="content">
      <!-- Profile Section starts here -->

      <form action="edit_profile_code.php">
        <div class="row justify-content-end pb-3">
          <div class="col-sm-2 col-md-2 mb-3 btn btn-primary mx-2"><a href="edit_profile.php" style="text-decoration:none;" class="text-white">Update Profile</a></div>
          <div class="col-sm-2 col-md-2 mb-3 btn btn-primary mx-2"><a href="change_pass.php" style="text-decoration:none;" class="text-white">Change Password</a></div>
        </div>
        <div class="row">
        <div class="col-sm-4 col-md-4">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 d-flex align-items-center justify-content-center">
                                <img style="border-radius:50%" src="<?php if ($row['p_file'] == "") {
                                                                        echo '../assets/image/profile_image/parent/user.jpg';
                                                                    } else {
                                                                        echo '../assets/image/profile_image/parent/' . $row['p_file'];
                                                                    } ?>" height="200px" width="200px" alt="">
                            </div>
                            <div class="col-sm-12 mt-3 col-md-12 d-flex align-items-center justify-content-center">
                                <input class="form-control" diabled type="hidden" name="image">
                            </div>
                        </div>
                    </div>
          <div class="col-sm-8 col-md-8">
            <div class="row">
              <div class="col-sm-6 col-md-6 pb-3">Parent ID:
                <input class="form-control" type="text" disabled value="<?php echo $row['parent_id']; ?>">
              </div>
              <div class="col-sm-6 col-md-6 pb-3">Father Name:
                <input class="form-control" type="text" disabled value="<?php echo $row['f_name']; ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-6 pb-3">Mother Name:
                <input class="form-control" type="text" disabled value="<?php echo $row['m_name']; ?>">
              </div>
              <div class="col-sm-6 col-md-6 pb-3">Mobile No:
                <input class="form-control" type="text" disabled value="<?php echo $row['mobile']; ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-6 pb-3">
                <div class="row">
                  <div class="col-sm-12 col-md-12 pb-3">Email:
                    <input class="form-control" type="text" disabled value="<?php echo $row['email']; ?>">
                  </div>
                  <div class="col-sm-12 col-md-12 pb-3">Email:
                    <input class="form-control" type="text" disabled value="<?php echo $row['email']; ?>">
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 pb-3">Address:
                <textarea class="form-control" type="text" rows="5" style="resize:none;" disabled><?php echo $row['address']; ?>
            </textarea>
              </div>
            </div>
          </div>
        </div>
      </form>

      <!-- Profile Section ends here -->
  <?php
  }
  include('parent_dash_footer.php');
} else
  header('location:../index.php?msg=1');
  ?>