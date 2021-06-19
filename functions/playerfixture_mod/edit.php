<?php

    include '../../config/databaseConnection.php';
    include '../../layouts/function_layout/header.php';

    $fixture_id_data = $_GET['edit1'];
    $player_id_data = $_GET['edit'];

    $query = mysqli_query($con, "SELECT * FROM playerfixtures WHERE fixture_id = '$fixture_id_data' AND player_id = '$player_id_data'");

    $result = mysqli_fetch_array($query);

    if (isset($_POST['update'])) {
        $edit_fixture_id = $_POST['fixture_id'];
        $edit_player_id = $_POST['player_id'];
        $edit_goals_scored = $_POST['goals_scored'];

        $edit_query = mysqli_query($con, "UPDATE playerfixtures SET fixture_id = '$edit_fixture_id', player_id = '$edit_player_id', 
        goals_scored = '$edit_goals_scored' WHERE fixture_id = '$edit_fixture_id'");

        if ($edit_query) {
            mysqli_close($con);
            header("Location: ../../player_fixtures.php");
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
        <button type="button" width="50%" onclick="history.back();" style="background-image: linear-gradient(red, yellow)">Go Back to Player Fixtures Page</button>
    </p>

    <h1 style="text-align: center;">🥳Update Player Fixtures Record🥳</h1>

    <div style="text-align: center">
        <p>
            <img src="../../assets/images/player_fixtures.jpg" width="500" alt="image">
        </p><br>
    </div><!--End top-section-->

    <form method="post">
        <h4>Edit Player Fixture</h4>
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
        <input type="text" name="goals_scored" value="<?php echo $result['goals_scored']; ?>" 
        size="5" placeholder="3" required autocomplete="OFF" ><br><br>
        <input type="submit" name="update" value="Update Player Fixture" class="btn btn-success btn-2x"><br><br>
        <button type="button" onclick="history.back();" class="btn btn-danger btn-2x">Cancel</button>
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