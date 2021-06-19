<?php

    include '../../config/databaseConnection.php';

    if (isset($_GET['delete'])) {
        $player_id = $_GET['delete'];
        $con->query("DELETE FROM players WHERE player_id = $player_id") or die($con->error);
    }

    header("Location: ../../players.php");

?>