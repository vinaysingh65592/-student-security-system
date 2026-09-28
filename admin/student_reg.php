<?php
session_start();
if (isset($_SESSION['msg'])) {
    # code...
    if ($_SESSION['msg'] == 1)
    {
        $_SESSION['msg'] = 0;
        echo "<script>alert('Registration successful')</script>";
    }
    elseif ($_SESSION['msg'] == 2){
        $_SESSION['msg'] = 0;
        echo "<script>alert('Registration unsuccessful')</script>";
    }
}
if (isset($_SESSION['email'])) {
    include('admin_dash_header.php');
?> <div class="text">
        STUDENT REGISTRATION
    </div>
    <div id="content">
        <div class="form_outer">

            <div class="form">
                <form action="registration_code.php" method="post" enctype="multipart/form-data">
                    <table width="100%">
                        <tr>
                            <td>Student Name :</td>
                            <td><input onfocusout="capital(this)" class="form form-control" type="text" name="stu_name" required id="stu_name" placeholder="Student Name"></td>
                            <!-- <td>Parent ID :</td>
                            <td><input class="form form-control" type="text" name="parent_id" id="reg_no" placeholder="If You Have Parent ID "></td> -->
                            <td>Gender :</td>
                            <td colspan="3"><input type="radio" required name="gender" value="Male" id=""> Male &emsp;&emsp;<input type="radio" required name="gender" value="Female" id=""> Female &emsp;&emsp;
                                <input type="radio" name="gender" required value="Rather Not Say" id=""> Rather Not Say
                        </tr>
                                
                        <tr>
                            <td>Date Of Birth :</td>
                            <td><input class="form form-control" type="date" name="dob" required id="dob"></td>

                            <td>Aadhaar Number :</td>
                            <td><input class="form form-control" type="number" name="aadhaar" required id="dob" placeholder="Enter Your Aadhaar No..."></td>

                        </tr>

                        <tr>
                            <td>Class :</td>
                            <td>
                                <select required name="class" id="" class="form form-control">
                                    <option value="">---Select Your Class--- </option>
                                    <option value="I">I </option>
                                    <option value="II">II </option>
                                    <option value="III">III </option>
                                    <option value="IV">IV </option>
                                    <option value="V">V </option>
                                    <option value="VI">VI </option>
                                    <option value="VII">VII </option>
                                    <option value="VIII">VIII </option>
                                    <option value="IX">IX </option>
                                    <option value="X">X </option>
                                </select>
                            </td>
                            <td>Father's Name :</td>
                            <td><input class="form form-control" type="text" name="f_name" required placeholder="Father Name" onfocusout="capital(this)"></td>
                        </tr>
                        <tr>
                            <td>Mother's Name :</td>
                            <td><input class="form form-control" type="text" name="m_name" required placeholder="Mother Name" onfocusout="capital(this)" x></td>
                            <td>Mobile No. :</td>
                            <td><input class="form form-control" type="number" name="mobile" required placeholder="Mobile Number"></td>

                        </tr>
                        <tr>
                            <td>Email :</td>
                            <td colspan="3"><input class="form form-control" type="email" name="email" required placeholder="example@gmail.com"></td>
                        </tr>
                        <tr>
                            <td>Student Photo :</td>
                            <td colspan="3"><input class="form form-control" type="file" name="file" required></td>
                        </tr>
                        <tr>
                            <td>Full Address:</td>
                            
                            <td colspan="3">
    
                                <textarea class="form form-control" required style="resize: none;" name="address" id="" ></textarea>
                            </td>
                        </tr>
                        <tr>

                        </tr>
                    </table>
                    <div class="row">

                        <input type="submit" class="btn btn-info w-25 mx-auto mt-5" name="" id="">
                    </div>
                    <!-- <table class="mt-5">
                    <tr>
                        <td></td>
                    </tr>
                </table> -->
                </form>
            </div>
            <script>
                function capital(x) {
                    //   let x = document.getElementById("");
                    x.value = x.value.toUpperCase();
                }
            </script>
        </div>
    <?php
    include('admin_dash_footer.php');
} else {
    header('location:../index.php?msg=1');
}
    ?>