<?php
session_start();
echo 'Order For ' . $_POST['username'] . ':
Course: ' . $_SESSION["FC"] . '
Teacher: ' . $_SESSION["FT"] . '
location: ' . $_SESSION['FL'] . '
Bundle: Bundle' . $_SESSION['FB'] . '
Price: ' . $_SESSION['FP'];
if(isset($_SESSION['code']))echo'
Discount: '.$_SESSION['discount'].'% Code:'.$_SESSION['code'];
echo'
Phone number :' . $_POST['phoneNumber'];
?>