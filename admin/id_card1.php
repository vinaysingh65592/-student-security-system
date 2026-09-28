<?php
session_start();
if (isset($_SESSION['email'])) {

    $id=$_REQUEST['id'];
    include('../db_connect.php');
    $query="select * from tbl_student where id=$id";
    $res=mysqli_query($conn,$query);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../../assets/css/id_card.css">
    </head>

    <body>
        <section id="id_card">
            <div class="id_outer">
                <div class="header">
                    <div class="logo">
                        <img src="../../assets/image/logo.png" alt="No image Found">
                    </div>
                    <div class="name">
                        <span>Government Polytechnic Adampur Tarabganj Gonda</span>
                    </div>
                </div>

                <div class="details">
                    <?php
                    if($row=mysqli_fetch_array($res))
                    {
                    ?>
                    <div class="photo">
                        <img src="../../assets/image/student_photo/<?php echo $row['p_file']  ?>" alt="">
                    </div>
                    <div class="data1">
                        <table>
                            <tr>
                                <td class="t_head">Name:</td>
                                <td><?php echo $row['stu_name'] ?></td>
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
            </div>
            <div class="id_outer">
                <div class="header">
                    <div class="logo">
                        <img src="../../assets/image/logo.png" alt="No image Found">
                    </div>
                    <div class="name">
                        <span>Government Polytechnic Adampur Tarabganj Gonda</span>
                    </div>

                </div>
                <div class="details">

                    <div class="data2">
                        <p><span>Address:</span> Village Tharuapar Post Ghaghasara Tehsil Sahjanwa District Gorakhpur
                        </p>
                    </div>
                    <div class="qr">
                        <img src="<?php echo $row['qr_file']?>" alt="QR Not Found">
                    </div>
                    <?php
                    }
                    ?>
                </div>
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
<?php
}
else
{
    header('location:../index.php?msg=1');
}
?>