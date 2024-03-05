<?php
session_start();
if (!isset($_SESSION['Admin'])) {
    header("location:loginPage.php");  
}
include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
    <script data-require="jquery@*" data-semver="3.0.0" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="admin.js"></script>
    <link rel="stylesheet" href="design/admin.css">
</head>

<body>
    
    
    <div id="menu">
        <div id="teacher" onclick="admin('teacher')">Teachers</div>
        <div id="course" onclick="admin('course')">Courses</div>
        <div id="major" onclick="admin('major')">Majors</div>
        <div id="courseRelation" onclick="admin('courseRelation')">Courses Teacher</div>
        <div id="order" onclick="admin('order')">Orders</div>
        <div id="messages" onclick="admin('messages')">Messages</div>
        <div id="price" onclick="admin('price')">Price</div>
    </div>
    <div id="main" class="main">
    
    <?php
   if (isset($_SESSION['page'])) {
    echo '<script>admin("'.$_SESSION['page'].'")</script>';
}else echo '<script>admin("teacher")</script>';
   ?>
    </div>
    <div id="messagePopupBackground" onclick="closeMessage(event)">
    
        <div id="messagePopup">
    </div>
    </div>
    
    <div id="scriptDiv" style="display:none"></div>
</body>

</html>