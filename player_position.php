<?php

    include 'config/databaseConnection.php';
    include 'layouts/header.php';

    //Form validation
    $position_descr_entry = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $position_descr_entry = check_input($_POST['position_descr']);
    }

    function check_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;  
    }

    //Insert data to DB
    if (isset($_POST['save'])) {
     
        //Check if not null
        if (!empty($_POST['position_descr'])) {
           
            $position_descr_entry = $_POST['position_descr'];

            $query = "INSERT INTO competitions(position_descr) VALUES('$position_descr_entry')";

            $result = mysqli_query($con, $query);

            if ($result) {
                echo "<p style='text-align: center; color: green;'>A new player position was added successfully😊</p>";
            } 
            else {
                echo "<p style='text-align: center; color: red;'>Unfortunately, the max number of records has been reached. Please try again later😞</p>";
            }
        } 
        else {
            echo "<p style='text-align: center; color: red;'>The player position field is required before submitting form😔</p>";
        }
    }

?>

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }

            td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            }

            tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style><!--End Style Table-->

    <div style="text-align: center">
        <p>
            <img src="assets/images/player_position.jpg" width="500" alt="image">
        </p>
    </div><!--End top-section-->

    <h1 style="text-align: center;">🥳Selected Player Positions🥳</h1>

    <?php

        $result = $con->query("SELECT * FROM playerposition") or die($con->error);
        
    ?><!--End data_pulling section-->

        <div>
            <table>
                <thead >
                    <tr>
                        <th>Player Position</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td>
                    ⚽ <?php 
                            echo $row['position_descr'];
                        ?>
                    </td>
                    <td>
                        ✔️<a href="functions/player_position_mod/edit.php?edit=<?php echo $row['position_id']; ?>">Edit</a>
                        ❌<a onClick="alert('Hey buddy, are you sure you want to delete this record🤔')" 
                            href="functions/player_position_mod/delete.php?delete=<?php echo $row['position_id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>

    <br><br>

    <form action="player_position.php" method="post">
        <label>Add a new player position</label>
        <input type="text" name="position_descr" size="5" required autocomplete="OFF" maxlength="3"><br><br>
        <input type="submit" name="save" value="submit" class="btn btn-primary btn-2x">
    </form><!--End form_submission-->

<?php
    include 'layouts/footer.php';
?>