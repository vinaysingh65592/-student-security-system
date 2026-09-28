<?php
session_start();
if (isset($_SESSION['email'])) {
    include('admin_dash_header.php');
    if (isset($_REQUEST['error'])) {
        # code...
        if ($_REQUEST['error'] == 2) {
            echo $_REQUEST['error'];
            echo "<script> alert('Conform password is not match');</script>";
            // unset($_REQUEST);
        } elseif ($_REQUEST['error'] == 1) {
            // echo $_REQUEST['error'];
            echo "<script>alert('Registration Sucessful')</script>";
        } else {
            echo "<script> alert('Registration unSucessful');</script>";
        }
    }
?> <div class="text">TEACHER REGISTRATION</div>
    <div id="content">
        <div class="form_outer">

            <div class="form">
                <form action="teacher_reg_code.php" method="post">
                    <table width="100%">
                        <tr>

                            <td>Name :</td>
                            <td><input onfocusout="capital(this)" class="form form-control" type="text" name="name" id="stu_name" placeholder="Name" required></td>
                            <td>Date Of Brith :</td>
                            <td><input class="form form-control" type="date" name="dob" id="dob" required></td>
                        </tr>

                        <tr>

                            <td>Gender :</td>
                            <td><input type="radio" name="gender" value="Male" id=""> Male &emsp;&emsp;<input type="radio" name="gender" value="Female" id=""> Female</td>
                            <td>Mobile No. :</td>
                            <td><input class="form form-control" type="number" name="mobile" placeholder="Mobile Numaber" required></td>
                            <!-- <td>Staff Name : </td>
                        <td><input class="form form-control" name="class" type="text" placeholder="Staff" required></td> -->
                        </tr>
                        <tr><td>Address:</td>
                            <td colspan="3">
                                <textarea class="form-control" name="address" id="" rows="5" style="resize: none;"></textarea>
                            </td>
                        </tr>
                        <tr>


                            <td>Email :</td>
                            <td colspan="3"><input class="form form-control" type="email" name="email" placeholder="example@gmail.com" required></td>
                        </tr>
                        <tr>

                            <td>Create Password :</td>
                            <td><input class="form form-control" type="password" name="crp" placeholder="Create password" id="crp" required></td>
                            <td>Confirm Password</td>
                            <td><input class="form form-control" type="text" name="cp" placeholder="Confirm Password" id="cp" required></td>
                        </tr>


                    </table>
                    <div class="row">

                        <button class="btn btn-info w-25 mx-auto mt-5" type="su" id="submit" value="" onclick="pass()">submit</button>
                    </div>

                </form>
            </div>
            <script>
                function capital(x) {
                    //   let x = document.getElementById("");
                    x.value = x.value.toUpperCase();
                }

                // function pass() {
                //     var crp = document.querySelector("#crp").value;
                //     var cp = document.querySelector("#cp").value;
                //     alert(crp);
                //     alert(cp);
                //     if(crp==cp){
                //         document.forms[0].submit();
                //     }
                //     else
                //     {
                //         document.querySelector("#cp").style.color="red";
                //     }

                // }
            </script>
        </div>

    <?php
    include('admin_dash_footer.php');
} else {
    header('location:../index.php?msg=1');
}
    ?>