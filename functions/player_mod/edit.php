<?php

    include '../../config/databaseConnection.php';
    include '../../layouts/function_layout/header.php';

    $player_id = $_GET['edit'];

    $query = mysqli_query($con, "SELECT * FROM players WHERE player_id = '$player_id'");

    $result = mysqli_fetch_array($query);

    if (isset($_POST['update'])) {
        $edit_team_id = $_POST['team_id'];
        $edit_player_name = $_POST['player_name'];
        $edit_player_sqd_num = $_POST['player_sqd_num'];
        $edit_position_id = $_POST['position_id'];

        $edit_query = mysqli_query($con, "UPDATE players SET team_id = '$edit_team_id', player_name = '$edit_player_name',
        player_sqd_num = '$edit_player_sqd_num', position_id = '$edit_position_id' WHERE player_id = '$player_id'");

        if ($edit_query) {
            mysqli_close($con);
            header("Location: ../../players.php");
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
        <button type="button" width="50%" onclick="history.back();" style="background-image: linear-gradient(red, yellow)">Go Back to Players Page</button>
    </p>

    <h1 style="text-align: center;">🥳Update Players Record🥳</h1>

    <div style="text-align: center">
        <p>
            <img src="../../assets/images/players.jpg" width="500" alt="image">
        </p><br>
    </div><!--End top-section-->

    <form method="post">
         <h4>Edit player information</h4>
        <label>Edit this players surname & name</label>
        <input type="text" name="player_name" value="<?php echo $result['player_name'];?>" size="50"
        placeholder="Mokwane Patience" autocomplete="OFF" required><br><br>
        <label>Choose a new away team</label>
        <select name="team_id" required>
        <option>--Select a team--</option>
            <?php
            
               $records = mysqli_query($con, "SELECT * FROM teams");
               while($data = mysqli_fetch_array($records)) {
                   echo "<option value='". $data['team_id'] ."'>". $data['team_name'] . "</option>";
               } 
            
            ?>
        </select><br><br>
        <label>Edit this players shirt number</label>
        <input type="text" name="player_sqd_num" value="<?php echo $result['player_sqd_num']; ?>"
        placeholder="23" autocomplete="OFF" required><br><br>
        <label>Select a position</label><br><br>
        <?php
            $position_query = mysqli_query($con, "SELECT * FROM playerposition");

            if (mysqli_num_rows($position_query) > 0) {
                foreach($position_query as $position_result) { ?>
                    <input type="radio" name="position_id" value="<?php echo $position_result['position_id']; ?>"> 
                    <?= $position_result['position_descr']; ?> <br>
                    <?php
                }
            } else {
                "No position records found. Please try again later😞";
            }
        ?>
        <br><br>
        <input type="submit" name="update" value="Update Player Info" class="btn btn-success btn-2x"><br><br>
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