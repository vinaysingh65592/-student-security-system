<?php
session_start();
include('../db_connect.php');
if(isset($_SESSION['email']))
{
include('parent_dash_header.php');

?>
<div class="text">Dashboard</div>
<div id="content">
  <!-- Main Content goes here -->
  <?php
  
  include('parent_dash_footer.php');
}
else
header('location:../index.php?msg=1');
  ?>