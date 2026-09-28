<?php
if (isset($_REQUEST['id']))
    $id = $_REQUEST['id'];
// echo $id;
include('../db_connect.php');
$query = "select * from tbl_student where id='$id'";
// echo $query;
$res = mysqli_query($conn, $query);
if ($row = mysqli_fetch_array($res)) {
    // echo $row['address'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/id_card.css">
</head>

<body>
    <section id="id_card">
        <div class="id_outer">
            <div class="header">
                <div class="logo">
                    <img src="../assets/image/logo/logo.png" alt="No image Found">
                </div>
                <div class="name">
                    <span>Student Security System (SSS)</span>
                </div>
            </div>

            <div class="details">
                <div class="photo">
                    <img src="../assets/image/student_photo/<?php echo $row['p_file']  ?>" alt="">
                </div>
                <div class="data1">
                    <table>
                        <tr>
                            <td class="t_head">Name:</td>
                            <td><?php echo $row['stu_name'] ?></td>
                        </tr>
                        <tr>
                            <td class="t_head">Gender:</td>
                            <td><?php echo $row['gender'] ?></td>
                        </tr>
                        <tr>
                            <td class="t_head">DOB:</td>
                            <td><?php $date= $row['dob'];
                            $final_date=explode('-',$date);
                            $date=$final_date[2];
                            $month=$final_date[1];
                            
                            $year=$final_date[0];
                            echo $date.'-'.$month.'-'.$year;
                            
                            ?></td>
                        </tr>
                        <tr>
                            <td class="t_head">Student Id:</td>
                            <td><?php echo $row['stu_id'] ?></td>
                        </tr>
                        <tr>
                            <td class="t_head">Class/Branch:</td>
                            <td><?php echo $row['class'] ?></td>
                        </tr>
                        <tr>
                            <td class="t_head">Mobile:</td>
                            <td><?php echo $row['mobile'] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="dis"><h5>Card Is Provided By Student Security System (SSS)</h5></div>
        </div>
        <div class="id_outer">
            <div class="header">
                <div class="logo">
                    <img src="../assets/image/logo/logo.png" alt="No image Found">
                </div>
                <div class="name">
                    <span>Student Security System (SSS)</span>
                </div>

            </div>
            <div class="details">
                <div class="data2">
                    <p><span>Address:</span><br><br> <?php echo $row['address'] ?>
                    </p>
                   
                </div>
                <div class="qr">
                    <img src="<?php echo $row['qr_file'] ?> " alt="QR Not Found">
                </div>
            </div>
            <div class="dis"><h5>Please return this Card to the College in case it is lost</h5></div>
           
        </div>
        <div class="link">
            <button class="noprint btn" onclick="window.print()">Print the Card</button>
            <a href="see_reg_student.php">
                <button class="noprint btn">Back to Home</button>
            </a>
        </div>
    </section>
</body>

</html>