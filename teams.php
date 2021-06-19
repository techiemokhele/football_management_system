<?php

    include 'config/databaseConnection.php';
    include 'layouts/header.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $team_name_entry = $_POST['team_name'];
        $team_email_entry = $_POST['team_email'];
    }

    function check_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;  
    }

    //Insert data to DB
    if (isset($_POST['save'])) {

        if (filter_var($team_email_entry, FILTER_VALIDATE_EMAIL)) {
            $team_email_entry = filter_var(FILTER_SANITIZE_EMAIL);

             //Check if not null
            if (!empty($_POST['team_name']) && !empty($_POST['team_email'])) {
            
                $team_name_entry = $_POST['team_name'];
                $team_email_entry = $_POST['team_email'];

                $query = "INSERT INTO teams(team_name, team_email) VALUES('$team_name_entry', '$team_email_entry')";

                $result = mysqli_query($con, $query);

                if ($result) {
                    echo "<p style='text-align: center; color: green;'>Team was registered successfully😊</p>";
                } 
                else {
                    echo "<p style='text-align: center; color: red;'>Unfortunately, something went wrong. Please try again😞</p>";
                }
            } 
            else {
                echo "<p style='text-align: center; color: red;'>Please fill in all the required fields before submitting form😔</p>";
            }
        } else {
            echo "<p style='text-align: center; color: red;'>Please enter a correct email address😔</p>";
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
            <img src="assets/images/teams.png" width="500" alt="image">
        </p>
    </div><!--End top-section-->

    <h1 style="text-align: center;">🥳League of Teams🥳</h1>

    <?php

        $result = $con->query("SELECT * FROM teams") or die($con->error);
        
    ?><!--End data_pulling section-->

        <div>
            <table>
                <thead >
                    <tr>
                        <th>Team</th>
                        <th>Team Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td>
                     🏳️‍🌈 <?php 
                            echo $row['team_name'];
                        ?>
                    </td>
                    <td>
                    📧 <?php 
                            echo $row['team_email'];
                        ?>
                    </td>
                    <td>
                        ✔️<a href="functions/team_mod/edit.php?edit=<?php echo $row['team_id']; ?>">Edit</a>
                        ❌<a onClick="alert('Hey buddy, are you sure you want to delete this record🤔')" 
                            href="functions/team_mod/delete.php?delete=<?php echo $row['team_id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>

    <br><br>

    <form action="teams.php" method="post">
        <h4>Add Teams</h4>
        <label>Add a team name</label>
        <input type="text" name="team_name" size="50" required autocomplete="OFF"><br>
        <label>Add a team email</label>
        <input type="text" name="team_email" size="50" required autocomplete="OFF"><br><br>
        <input type="submit" name="save" value="submit" class="btn btn-primary btn-2x">
    </form><!--End form_submission-->

<?php
    include 'layouts/footer.php';
?>