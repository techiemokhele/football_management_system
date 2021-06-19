<?php

    include '../../config/databaseConnection.php';
    include '../../layouts/function_layout/header.php';

    $fixture_id = $_GET['edit'];

    $query = mysqli_query($con, "SELECT * FROM fixtures WHERE fixture_id = '$fixture_id'");

    $result = mysqli_fetch_array($query);
    
    if (isset($_POST['update'])) {
        $edit_fixture_date = $_POST['fixture_date'];
        $edit_fixture_time = $_POST['fixture_time'];
        $edit_home_teamID = $_POST['home_teamID'];
        $edit_away_teamID = $_POST['away_teamID'];
        $edit_comp_ID = $_POST['comp_id'];

        $edit_query = mysqli_query($con, "UPDATE fixtures SET fixture_date = '$edit_fixture_date', fixture_time = '$edit_fixture_time', 
        home_teamID = '$edit_home_teamID', away_teamID = '$edit_away_teamID', comp_id = '$edit_comp_ID'
        WHERE fixture_id = '$fixture_id'");

        if ($edit_query) {
            mysqli_close($con);
            header("Location: ../../fixtures.php");
            exit();
        } else {
            echo mysqli_error();
        }
    }

?>

    <br>
        <h3 style='color: red; font-family: joker;'>
            <marquee direction="left">
                [Orlando Pirates 1 - Kaizer Chiefs 0] --- [Sundowns 3 - Black Leopard 2]
            </marquee>
        </h3>
    <br>

    <p style="text-align:center;">
        <button type="button" width="50%" onclick="history.back();" style="background-image: linear-gradient(red, yellow)">Go Back to Fixtures Page</button>
    </p>

    <h1 style="text-align: center;">🥳Update Fixture Record🥳</h1>

    <div style="text-align: center">
        <p>
            <img src="../../assets/images/fixtures.jpg" width="500" alt="image">
        </p><br>
    </div><!--End top-section-->

    <form method="post">
        <label>Edit this fixture date</label>
        <input type="date" name="fixture_date" value="<?php echo $result['fixture_date'];?>" size="50" required autocomplete="OFF"><br><br>
        <label>Edit this fixture time</label>
        <input type="time" name="fixture_time" value="<?php echo $result['fixture_time'];?>" size="50" required autocomplete="OFF"><br><br>
        <label>Choose a new home team</label>
        <select name="home_teamID" required>
            <option>--Select a home team--</option>
            <?php
            
                $records = mysqli_query($con, "SELECT * FROM teams");
                while($data = mysqli_fetch_array($records)) {
                    echo "<option value='". $data['team_id'] ."'>". $data['team_name'] . "</option>";
                }
            
            ?>
        </select><br><br>
        <label>Choose a new away team</label>
        <select name="away_teamID" required>
        <option>--Select a away team--</option>
            <?php
            
               $records = mysqli_query($con, "SELECT * FROM teams");
               while($data = mysqli_fetch_array($records)) {
                   echo "<option value='". $data['team_id'] ."'>". $data['team_name'] . "</option>";
               } 
            
            ?>
        </select><br><br>
        <label>Choose a new competiton name</label>
        <select name="comp_id" required>
        <option>--Select a competition--</option>
            <?php
            
               $records = mysqli_query($con, "SELECT * FROM competitions");
               while($data = mysqli_fetch_array($records)) {
                   echo "<option value='". $data['comp_id'] ."'>". $data['comp_name'] . "</option>";
               } 
            
            ?>
        </select><br><br>
        <input type="submit" name="update" value="Update Fixture Record" class="btn btn-success btn-2x"><br><br>
        <button type="button" onclick="history.back();"class="btn btn-danger btn-2x">Cancel</button>
    </form><!--End form_submission-->

    <br>
        <h3 style='color: red; font-family: joker;'>
            <marquee direction="right">
                [Super Sports 5 - Bloemfontein Celtics 3] --- [Golden Arrows 2 - Santos FC 2]
            </marquee>
        </h3>

<?php
    include '../../layouts/function_layout/footer.php';
?>