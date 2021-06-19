<?php
    //Error Reporting
    error_reporting(0);
    
    //Set timezone
    date_default_timezone_set('Africa/Johannesburg');

    //Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fms";

    // Create connection
    $con = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>