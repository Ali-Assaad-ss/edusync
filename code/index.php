<?php
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduSync</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../design/index.css">


</head>

<body>
    <!-- including select2 ajax -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="index.js"></script>


    <div class="menu">
        <div class="logo"></div>
        <div style="width:25%;display:flex;justify-content:right">
            <button onclick="openMainpopup()" class="btn-hover color-1" style="width:100%;height:50px;min-width:125px;">GET STARTED</button>
        </div>
    </div>



    <div class="descContainer">
    <div style="width:100%;display:flex;justify-content:center;margin-top:65vh">
        <button onclick="openMainpopup()" class="btn-hover color-1">Find Your Course</button>
    </div>

    <div id="teacherPopup">
    </div>
    <div id=mainPopupBackground>
        <div class="mainPopup">
            <span id="closeBtn" onclick="closeMain()">×</span>
            <div id="container">
                <!-- major options -->
                <div style="color:#fff;font-size:30px;">Courses</div>
                <select id="majorSelect" onchange="handleMajorChange(this.value)">
                    <option value="default" selected>Select a major</option>
                    <?php
                    $sql = "SELECT * FROM `major` WHERE 1";
                    $result = $conn->query($sql);
                    if ($result) {
                        // Process the result set
                        while ($row = $result->fetch_assoc()) {
                            // Do something with each row
                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                        }
                        // Free the result set
                        $result->free();
                    } else {
                        // Handle the query error
                        echo "Error: " . $conn->error;
                    }
                    ?>
                </select>

                <select id="courseSelect" onchange="handleCourseChange(this.value)"></select>
            </div>
            <div id=courseInfo>
            </div>
            <button id="nextButton" onclick="NextButton(2)">NEXT ❯</button>
            <button id="prevButton" onclick="NextButton(1)">❮ BACK</button>
            <div id="teacherInfo"></div>
        </div>
    </div>
    <div onclick="navigateToContactUs()" class="contactUs"><img class="paperPlane" src="../design/paper-plane.svg" alt="Paper Plane" />
        <p id="contactText">Contact</p>
    </div>
</body>

</html>