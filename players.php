<?php

    include 'config/databaseConnection.php';
    include 'layouts/header.php';

    //Form validation

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $team_id_entry = check_input($_POST['team_id']);
        $player_name_entry = check_input($_POST['player_name']);
        $player_sqd_num_entry = check_input($_POST['player_sqd_num']);
        $position_id_entry = check_input($_POST['position_id']);

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
        if (!empty($_POST['team_id']) && !empty($_POST['player_name']) && !empty($_POST['player_sqd_num']) 
        && !empty($_POST['position_id'])) {
           
            $team_id_entry = $_POST['team_id'];
            $player_name_entry = $_POST['player_name'];
            $player_sqd_num_entry = $_POST['player_sqd_num'];
            $position_id_entry = $_POST['position_id'];

            $query = "INSERT INTO players(team_id, player_name, player_sqd_num, position_id) 
            VALUES('$team_id_entry', '$player_name_entry', '$player_sqd_num_entry', '$position_id_entry')";

            $result = mysqli_query($con, $query);

            if ($result) {
                echo "<p style='text-align: center; color: green;'>Player was added successfully😊</p>";
            } 
            else {
                echo "<p style='text-align: center; color: red;'>Unfortunately, something went wrong. Please try again😞</p>";
            }
        } 
        else {
            echo "<p style='text-align: center; color: red;'>The player fields are all required before submitting form😔</p>";
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
            <img src="assets/images/players.jpg" width="500" alt="image">
        </p>
    </div><!--End top-section-->

    <h1 style="text-align: center;">🥳Player Profiles Per Team🥳</h1>

    <?php

        $result = $con->query("SELECT DISTINCT players.player_id
                                    , players.player_name
                                    , a.team_name team_name
                                    , players.player_sqd_num
                                    , b.position_descr position_descr
                                FROM players
                                    JOIN teams a ON players.team_id = a.team_id
                                    JOIN playerposition b ON players.position_id = b.position_id
        ") or die($con->error);
        
    ?><!--End data_pulling section-->

        <div>
            <table id="playerSortTable">
                <thead >
                    <tr>
                        <th onClick="sortTable(0)" style="cursor: pointer;" title="click me to sort table"><u>Player</u></th>
                        <th onClick="sortTable(1)" style="cursor: pointer;" title="click me to sort table"><u>Team</u></th>
                        <th>Shirt Number</th>
                        <th>Position</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td>
                    🧍 <?php 
                            echo $row['player_name'];
                        ?>
                    </td>
                    <td>
                     🏳️‍🌈 <?php 
                            echo $row['team_name'];
                        ?>
                    </td>
                    <td>
                    🔢 <?php 
                            echo $row['player_sqd_num'];
                        ?>
                    </td>
                    <td>
                    ⚽ <?php 
                            echo $row['position_descr'];
                        ?>
                    </td>
                    <td>
                        ✔️<a href="functions/player_mod/edit.php?edit=<?php echo $row['player_id']; ?>">Edit</a>
                        ❌<a onClick="alert('Hey buddy, are you sure you want to delete this record🤔')" 
                            href="functions/player_mod/delete.php?delete=<?php echo $row['player_id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>

    <br><br>

    <form action="players.php" method="post">
        <h4>Add a player information</h4>
        <label>Add a player surname & name</label>
        <input type="text" name="player_name" placeholder="Mokwane Patience" autocomplete="OFF" required><br><br>
        <label>Add a team name</label>
        <select name="team_id" required>
            <option>--Select a team name--</option>
            <?php
            
                $records = mysqli_query($con, "SELECT * FROM teams");
                while($data = mysqli_fetch_array($records)) {
                    echo "<option value='". $data['team_id'] ."'>". $data['team_name'] . "</option>";
                }
            
            ?>
        </select><br><br>
        <label>Add a shirt number</label>
        <input type="text" name="player_sqd_num" placeholder="23" autocomplete="OFF" required><br><br>
        <label>Select a position</label><br><br>
        <?php
            $position_query = mysqli_query($con, "SELECT * FROM playerposition");

            if (mysqli_num_rows($position_query) > 0) {
                foreach($position_query as $position_result) { ?>
                    <input type="radio" id="notValid" name="position_id" value="<?php echo $position_result['position_id']; ?>"
                    onClick="return limitSelection()"> 
                    <?= $position_result['position_descr']; ?> <br>
                    <?php
                }
            } else {
                "No position records found. Please try again later😞";
            }
        ?>
        <br><br>
        <input type="submit" name="save" value="submit" class="btn btn-primary btn-2x">
    </form><!--End form_submission-->

<?php
    include 'layouts/footer.php';
?>
