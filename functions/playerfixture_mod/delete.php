<?php

    include '../../config/databaseConnection.php';

    if (isset($_GET['delete']) && isset($_GET['delete1'])) {
        $player = $_GET['delete'];
        $fixture = $_GET['delete1'];
        $con->query("DELETE FROM playerfixtures WHERE player_id = '$player' AND fixture_id = '$fixture'") or die($con->error);
    
    }

    header("Location: ../../player_fixtures.php");

?>