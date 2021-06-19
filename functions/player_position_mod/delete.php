<?php

    include '../../config/databaseConnection.php';

    if (isset($_GET['delete'])) {
        $player_position_id = $_GET['delete'];
        $con->query("DELETE FROM playerposition WHERE position_id = $player_position_id") or die($con->error);
        
    }

    header("Location: ../../player_position.php");

?>

