<?php
    include 'config/databaseConnection.php';
    include 'layouts/header.php';
?>

    <h1 style="text-align: center;">Football Management System Report</h1>

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
            <img src="assets/images/reports.jpg" width="500" height="400" alt="image">
        </p>
    </div><!--End top-section-->
    
    <div align="center">
        <form action="reports.php" method="post">
            <select name="team_id" required>
                <option value="0">--Select a team email--</option>
                <?php
                
                    $records = mysqli_query($con, "SELECT * FROM teams");
                    while($data = mysqli_fetch_array($records)) {
                        echo "<option value='". $data['team_id'] ."'>". $data['team_email'] . "</option>";
                    }
                ?>
            </select><br><br>
            <input type="submit" name="select" value="Select" class="btn btn-primary btn-2x"><br><br>
        </form>
     </div><!--End Select Options-->

    <?php
        if (isset($_POST['select'])) {
            if (!empty($_POST['team_id'])) {
                $team_email_result = $_POST['team_id'];

                $query = "SELECT DISTINCT a.team_name challenger, b.team_name against, fixtures.fixture_date, fixtures.fixture_time 
                          FROM fixtures 
                          JOIN teams a ON fixtures.home_teamID = a.team_id 
                          JOIN teams b ON fixtures.away_teamID = b.team_id 
                          WHERE fixtures.home_teamID = '$team_email_result'";

                $result = mysqli_query($con, $query);
    
    ?><!--End Query Result Logic for table-->
    <div>
        <table>
            <thead>
                <th>Challenger</th>
                <th>Against</th>
                <th>Upcoming Fixtures Date</th>
                <th>Upcoming Fixtures Time</th>
            </thead>
            <?php 
                while($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td>
                🏳️‍🌈  <?php 
                        echo $row['challenger'];
                    ?>
                </td>
                <td>
                🏳️‍🌈  <?php 
                        echo $row['against'];
                    ?>
                </td>
                <td>
                📅  <?php 
                        echo $row['fixture_date'];
                    ?>
                </td>
                <td>
                🕒  <?php 
                        echo $row['fixture_time'];
                    ?>
                </td>
            </tr>
            <?php endwhile; 
                    } 
                    else {
                        echo "<p style='text-align: center; color: red;'>Please select a team email before submitting the form😔</p>";
                    }
                } 
             ?>
        </table>
     </div><!--End Team Email Results-->
     
<?php
    include 'layouts/footer.php';
?>