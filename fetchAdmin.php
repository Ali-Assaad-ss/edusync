<?php
session_start();
if (!isset($_SESSION['Admin'])) {
    header("location:loginPage.php");  
}
include "connect.php";
if (isset($_POST["page"])) {
    $_SESSION['page'] = $_POST['page'];

    switch ($_POST["page"]) {
        case "teacher":
            include "teacher.php";
            break;

        case "course":
            include "course.php";
            break;

        case "major":
            include "major.php";
            break;
        case "order":
            include "order.php";
            break;
        case "messages":
            include "messages.php";
            break;
        case "price":
            include "price.php";
            break;

        case "courseRelation":
            echo '<div id ="courseRelation">
            <div id="courseTeacherDiv" class="assign">';


            include "courseteacher.php";

            echo '</div><div id="courseMajorDiv" class="assign">';

            include "courseMajor.php";

            echo '        </div><div id="teacherPopup">
            </div>
        </div>   ';
            break;

            // Add more cases as needed

        default:
            // Default case if none of the above conditions are met
            // You might want to include some default behavior or error handling here
            break;
    }
}
