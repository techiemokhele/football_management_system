<?php

    include '../../config/databaseConnection.php';

    if (isset($_GET['delete'])) {
        $team_id = $_GET['delete'];
        $con->query("DELETE FROM teams WHERE team_id = $team_id") or die($con->error);
        
    }

    header("Location: ../../teams.php");

?>