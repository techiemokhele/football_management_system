<?php

    include '../../config/databaseConnection.php';

    if (isset($_GET['delete'])) {
        $fixture_id = $_GET['delete'];
        $con->query("DELETE FROM fixtures WHERE fixture_id = $fixture_id") or die($con->error);
    }

    header("Location: ../../fixtures.php");

?>