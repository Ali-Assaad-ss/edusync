<?php
include "connect.php";

if (isset($_POST['teacherId'])){
    $teacherId=$_POST['teacherId'];
$sql ="SELECT * from teacher WHERE id =$teacherId";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();

echo'
<div class="popupContent">
    <span id="closeBtn" onclick="closeModal()">&times;</span>
    <div class="photo"></div>
    <div class="teacherInfo">
        <div class="name">'.$row['name'].'</div>
        <div class="tp"> <div class="teacherHeading">Degree: </div><div>'.$row['degree'].'</div> </div>
        <div class="tp"> <div class="teacherHeading">Major: </div><div>'.$row['major'].'</div> </div>
        <div class="tp"> <div class="teacherHeading">About: </div><div>'.$row['Description'].'</div> </div>
</div>
';

}
?>