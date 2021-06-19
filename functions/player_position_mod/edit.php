<?php

    include '../../config/databaseConnection.php';
    include '../../layouts/function_layout/header.php';

    $player_position_id = $_GET['edit'];

    $query = mysqli_query($con, "SELECT * FROM playerposition WHERE position_id = '$player_position_id'");

    $result = mysqli_fetch_array($query);

    if (isset($_POST['update'])) {
        $edit_position_descr = $_POST['position_desr'];

        $edit_query = mysqli_query($con, "UPDATE playerposition SET position_descr = '$edit_position_descr' 
        WHERE position_id = '$player_position_id'");

        if ($edit_query) {
            mysqli_close($con);
            header("Location: ../../player_position.php");
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
        <button type="button" width="50%" onclick="history.back();" style="background-image: linear-gradient(red, yellow)">Go Back to Player Position Page</button>
    </p>

    <h1 style="text-align: center;">🥳Update Player Position Record🥳</h1>

    <div style="text-align: center">
        <p>
            <img src="../../assets/images/player_position.jpg" width="500" alt="image">
        </p><br>
    </div><!--End top-section-->

    <form method="post">
        <label>Edit this player position</label>
        <input type="text" name="position_descr" value="<?php echo $result['position_descr']; ?>" size="5" 
        required autocomplete="OFF"><br><br>
        <input type="submit" name="update" value="Update Player Position" class="btn btn-success btn-2x"><br><br>
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