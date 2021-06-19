<?php
    include 'config/databaseConnection.php';
    include 'layouts/header.php';

    //Form Validation

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $fixture_id_entry = check_input($_POST['fixture_id']);
        $player_id_entry = check_input($_POST['player_id']);
        $goal_scored_entry = check_input($_POST['goals_scored']);
    } 

    function check_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Insert data to DB
    if(isset($_POST['save'])) {
        
        //Check if not null
        if (!empty($_POST['fixture_id']) && !empty($_POST['player_id']) && !empty($_POST['goals_scored'])) {
            $fixture_id_entry = $_POST['fixture_id'];
            $player_id_entry = $_POST['player_id'];
            $goal_scored_entry = $_POST['goals_scored'];

            $query = "INSERT INTO playerfixtures(fixture_id, player_id, goals_scored) 
            VALUES('$fixture_id_entry', '$player_id_entry', '$goal_scored_entry')";

            $result = mysqli_query($con, $query);

            if ($result) {
                echo "<p style='text-align: center; color: green;'>Player Fixture was created successfully😊</p>";
            } else {
                echo "<p style='text-align: center; color: red;'>Unfortunately, something went wrong. Please try again😞</p>";
            }
        } else {
            echo "<p style='text-align: center; color: red;'>The player fixture fields are all required before submitting form😔</p>";
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
            <img src="assets/images/player_fixtures.jpg" width="500" alt="index_image">
        </p>
    </div><!--End top-section-->

    <h1 style="text-align: center;">🥳Created Player Fixtures🥳</h1>

    <?php
    
        $result = $con->query("SELECT DISTINCT a.player_name player_name, a.player_id player_id
                                    , b.fixture_date fixture_date, b.fixture_id fixture_id
                                    , playerfixtures.goals_scored
                                FROM playerfixtures
                                    JOIN players a ON playerfixtures.player_id = a.player_id
                                    JOIN fixtures b ON playerfixtures.fixture_id = b.fixture_id
                                ORDER BY player_name ASC
        ") or die($con->error);
    
    ?><!--End data_pulling section-->

<div>
            <table>
                <thead >
                    <tr>
                        <th>Player</th>
                        <th>Fixture</th>
                        <th>Goal Scored</th>
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
                    📅 <?php 
                            echo $row['fixture_date'];
                        ?>
                    </td>
                    <td>
                    ⚽ <?php 
                            echo $row['goals_scored'];
                        ?>
                    </td>
                    <td>
                        ✔️<a href="functions/playerfixture_mod/edit.php?edit=<?php echo $row['player_id']; ?>&edit1=<?php echo $row['fixture_id']; ?>">Edit</a>
                        ❌<a onClick="alert('Hey buddy, are you sure you want to delete this record🤔')" 
                            href="functions/playerfixture_mod/delete.php?delete=<?php echo $row['player_id']; ?>&delete1=<?php echo $row['fixture_id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <br><br>

        <form action="player_fixtures.php" method="post">
            <h4>Add Player Fixture</h4>
            <label>Player</label>
            <select name="player_id" required>
                <option>--Choose a player--</option>
                <?php
                
                $records = mysqli_query($con, "SELECT * FROM players");
                while($data = mysqli_fetch_array($records)) {
                    echo "<option value='". $data['player_id'] ."'>". $data['player_name'] . "</option>";
                } 
                
                ?>
            </select><br><br>
            <label>Fixture</label>
            <select name="fixture_id" required>
                <option>--Choose a fixture date--</option>
                    <?php
                    
                    $records = mysqli_query($con, "SELECT * FROM fixtures");
                    while($data = mysqli_fetch_array($records)) {
                        echo "<option value='". $data['fixture_id'] ."'>". $data['fixture_date'] . "</option>";
                    } 
                    
                    ?>
            </select><br><br>
            <label>Goals</label>
            <input type="text" name="goals_scored" size="5" placeholder="3" required autocomplete="OFF"><br><br>
            <input type="submit" name="save" value="submit" class="btn btn-primary btn-2x"> 
        </form>
<?php

    include 'layouts/footer.php';
?>