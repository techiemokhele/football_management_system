<?php

    include '../../config/databaseConnection.php';
    include '../../layouts/function_layout/header.php';

    $team_id = $_GET['edit'];

    $query = mysqli_query($con, "SELECT * FROM teams WHERE team_id = '$team_id'");

    $result = mysqli_fetch_array($query);

    if (isset($_POST['update'])) {

        $edit_team_name = $_POST['team_name'];
        $edit_team_email = $_POST['team_email'];

        if (filter_var($edit_team_email, FILTER_VALIDATE_EMAIL)) {
            $edit_team_email = filter_var(FILTER_SANITIZE_EMAIL);

            if (!empty($_POST['team_name']) && !empty($_POST['team_email'])) {
        
                $edit_team_name = $_POST['team_name'];
                $edit_team_email = $_POST['team_email'];

                $edit_query = mysqli_query($con, "UPDATE teams SET team_name = '$edit_team_name', team_email = '$edit_team_email' 
                WHERE team_id = '$team_id'");

                if ($edit_query) {
                    mysqli_close($con);
                    header("Location: ../../teams.php");
                    exit();
                } else {
                    echo mysqli_error();
                }
            } else {
                echo "<p style='text-align: center; color: red;'>Unfortunately, something went wrong trying to update this query. Please try again😞</p>";
            }
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
        <button type="button" width="50%" onclick="history.back();" style="background-image: linear-gradient(red, yellow)">Go Back to Teams Page</button>
    </p>

    <h1 style="text-align: center;">🥳Update Registered Teams Record🥳</h1>

    <div style="text-align: center">
        <p>
            <img src="../../assets/images/teams.png" width="500" alt="image">
        </p><br>
    </div><!--End top-section-->

    <form method="post">
        <label>Edit this teams name</label>
        <input type="text" name="team_name" value="<?php echo $result['team_name']; ?>" size="50" required autocomplete="OFF"><br>
        <label>Edit this teams email</label>
        <input type="text" name="team_email" value="<?php echo $result['team_email']; ?>" size="50" required autocomplete="OFF">
        <br><br>
        <input type="submit" name="update" value="Update Team Record" class="btn btn-success btn-2x"><br><br>
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