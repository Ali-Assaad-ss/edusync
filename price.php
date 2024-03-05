<?php
session_start();
if (!isset($_SESSION['Admin'])) {
    header("location:loginPage.php");  
}
// Fetch data from the price table
$sql = "SELECT * FROM price WHERE id = 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Output HTML
?>
<style>
    .editable-row input {
        border: none;
        background: transparent;
        width: 100%;
        height: 100%;
        box-sizing: border-box;
        color:white;
    }
</style>

<h2>Edit Base price and add coupons</h2>


<div class="table-container">
        <table id="priceTable" border="1">
            <tr>
                <th>Base Price</th>
                <th>Addition per Degree</th>
                <th>Addition per level</th>
                <th style="min-width:100px;">Action</th>
            </tr>
            <tr class="editable-row">
                <td><input type="text" id="basePrice" value="<?php echo $row['basePrice']; ?>"></td>
                <td><input type="text" id="degreeAdd" value="<?php echo $row['degreeAdd']; ?>"></td>
                <td><input type="text" id="levelAdd" value="<?php echo $row['levelAdd']; ?>"></td>
                <td>
                    <button onclick="updatePrice()" class="UpdatePrice">Update</button>
                </td>
            </tr>
        </table>
</div>



<h2>Coupon codes</h2>
    
    <?php
    // Fetch data from the teacher table
    $sql = "SELECT * FROM coupon";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        echo '<input type="text" id="msearch" placeholder="Search...">';
        echo '<div class="table-container">';
        echo '<table id="majorTable" border="1">
            <tr>
                <th>Name</th>
                <th>discount</th>
                <th style="min-width:100px;">Action</th>
            </tr>';

        // Fetch and display each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr class="editable-row" data-id="' . $row['code'] . '">';
            echo '<td contenteditable="true">' . $row['code'] . '</td>';
            echo '<td contenteditable="true">' . $row['discount'] . '</td>';
            echo '<td>
                <button class="cpsave-btn">Save</button>
                <button class="cpdelete-btn">delete</button>
              </td>';
            echo '</tr>';
        }
        echo '<tr class="editable-row" id="newCoupon">';
        echo '<td contenteditable="true"></td>';
        echo '<td contenteditable="true"></td>';
        echo '<td>
            <button class="add-btn" onclick=addCoupon()>Add Coupon</button>
          </td>';
        echo '</tr>';

        echo '</table>';
        echo '</div>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    ?>
