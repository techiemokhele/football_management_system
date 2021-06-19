<?php

    include 'config/databaseConnection.php';
    include 'layouts/header.php';

    //Form validation

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fixture_date_entry = check_input($_POST['fixture_date']);
        $fixture_time_entry = check_input($_POST['fixture_time']);
        $home_teamID_entry = check_input($_POST['home_teamID']);
        $away_teamID_entry = check_input($_POST['away_teamID']);
        $comp_ID_entry = check_input($_POST['comp_id']);
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
        if (!empty($_POST['fixture_date']) && !empty($_POST['fixture_time']) && !empty($_POST['home_teamID'])
        && !empty($_POST['away_teamID']) && !empty($_POST['comp_id'])) {
           
            $fixture_date_entry = $_POST['fixture_date'];
            $fixture_time_entry = $_POST['fixture_time'];
            $home_teamID_entry = $_POST['home_teamID'];
            $away_teamID_entry = $_POST['away_teamID'];
            $comp_ID_entry = $_POST['comp_id'];

            $query = "INSERT INTO fixtures(fixture_date, fixture_time, home_teamID, away_teamID, comp_id) 
            VALUES('$fixture_date_entry', '$fixture_time_entry', '$home_teamID_entry', '$away_teamID_entry', '$comp_ID_entry')";

            $result = mysqli_query($con, $query);

            if ($result) {
                echo "<p style='text-align: center; color: green;'>Fixture was created successfully😊</p>";
            } 
            else {
                echo "<p style='text-align: center; color: red;'>Unfortunately, something went wrong. Please try again😞</p>";
            }
        } 
        else {
            echo "<p style='text-align: center; color: red;'>The fixture fields are all required before submitting form😔</p>";
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
            <img src="assets/images/fixtures.jpg" width="500" alt="image">
        </p>
    </div><!--End top-section-->

    <h1 style="text-align: center;">🥳Upcoming Fixture Games🥳</h1>

    <?php

        $result = $con->query("SELECT DISTINCT fixtures.fixture_id
                                        , fixtures.fixture_date
                                        , fixtures.fixture_time
                                        , a.team_name home_team
                                        , b.team_name away_team
                                        , c.comp_name comp_name
                                FROM fixtures 
                                    JOIN teams  a ON fixtures.home_teamID = a.team_id 
                                    JOIN teams  b ON fixtures.away_teamID = b.team_id 
                                    JOIN competitions c ON fixtures.comp_id = c.comp_id
                                ORDER BY fixture_id ASC
        ") or die($con->error);
        
    ?><!--End data_pulling section-->

        <div>
            <table>
                <thead >
                    <tr>
                        <th>Fixture</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Home Team</th>
                        <th>Away Team</th>
                        <th>Competitions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td>
                    🔢 <?php 
                            echo $row['fixture_id'];
                        ?>
                    </td>
                    <td>
                    📅 <?php 
                            echo $row['fixture_date'];
                        ?>
                    </td>
                    <td>
                    🕒 <?php 
                            echo $row['fixture_time'];
                        ?>
                    </td>
                    <td>
                     🏳️‍🌈 <?php 
                            echo $row['home_team'];
                        ?>
                    </td>
                    <td>
                     🏳️‍🌈 <?php 
                            echo $row['away_team'];
                        ?>
                    </td>
                    <td>
                    📋 <?php 
                            echo $row['comp_name'];
                        ?>
                    </td>
                    <td>
                        ✔️<a href="functions/fixture_mod/edit.php?edit=<?php echo $row['fixture_id']; ?>">Edit</a>
                        ❌<a onClick="alert('Hey buddy, are you sure you want to delete this record🤔')" 
                            href="functions/fixture_mod/delete.php?delete=<?php echo $row['fixture_id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>

    <br><br>

    <form action="fixtures.php" method="post">
        <h4>Add Fixture</h4>
        <label>Add a fixture date</label>
        <input type="date" name="fixture_date" size="50" placeholder="yyyy-mm-dd" required autocomplete="OFF"><br>
        <label>Add a fixture time</label>
        <input type="time" name="fixture_time" size="50" placeholder="hh:mm:ss" required autocomplete="OFF"><br>
        <label>Selet a home team</label>
        <select name="home_teamID" required>
            <option>--Select a home team--</option>
            <?php
            
                $records = mysqli_query($con, "SELECT * FROM teams");
                while($data = mysqli_fetch_array($records)) {
                    echo "<option value='". $data['team_id'] ."'>". $data['team_name'] . "</option>";
                }
            
            ?>
        </select><br>
        <label>Select an away team</label>
        <select name="away_teamID" required>
        <option>--Select a away team--</option>
            <?php
            
               $records = mysqli_query($con, "SELECT * FROM teams");
               while($data = mysqli_fetch_array($records)) {
                   echo "<option value='". $data['team_id'] ."'>". $data['team_name'] . "</option>";
               } 
            
            ?>
        </select><br>
        <label>Select a competition name</label>
        <select name="comp_id" required>
        <option>--Select a competition--</option>
            <?php
            
               $records = mysqli_query($con, "SELECT * FROM competitions");
               while($data = mysqli_fetch_array($records)) {
                   echo "<option value='". $data['comp_id'] ."'>". $data['comp_name'] . "</option>";
               } 
            
            ?>
        </select>
        <br><br>
        <input type="submit" name="save" value="submit" class="btn btn-success btn-2x">
    </form><!--End form_submission-->

<?php
    include 'layouts/footer.php';
?>