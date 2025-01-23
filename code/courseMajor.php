<div id="container">
    <!-- major options -->
    <h2 Style="color:#fff;">Assign a course to a major</h2>
    <select id="majorSelect" onchange="handleMajorChange2(this.value)">
        <option value="default" selected>Select a major</option>
        <?php
        session_start();
        if (!isset($_SESSION['Admin'])) {
            header("location:loginPage.php");  
        }
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

    <select id="courseSelect2" onchange="handleCourseChange2(this.value)">
        <option value="default" selected>Select a Course</option>
        <?php
        $sql = "SELECT * FROM `course` WHERE 1";
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



</div>
<div id=courseInfo2>
</div>