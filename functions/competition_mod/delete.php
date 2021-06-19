<?php

    include '../../config/databaseConnection.php';

    if (isset($_GET['delete'])) {
        $comp_id = $_GET['delete'];
        $con->query("DELETE FROM competitions WHERE comp_id = $comp_id") or die($con->error);
        
    }

    header("Location: ../../competitions.php");

?>