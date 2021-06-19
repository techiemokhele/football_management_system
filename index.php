<?php
    include 'layouts/header.php';
?>

    <h1 style="text-align: center;">Welcome to Patience Mokwane's <br>
    Football (Soccer) Management System</h1>

    <div style="text-align: center">
        <p>
            <img src="assets/images/index.jpg" width="500" alt="index_image">
        </p>
    </div><!--End top-section-->

    <div>
        <h3 style="text-align: center">About Program</h3>
        <p class="alert alert-primary">
            A Football Management System is a system which is used to manage football 
            competitions by storing each match's data during the match. The system 
            focuses on some important data related to the game such as total completed
            passes, total uncompleted passes, total shots on target, total shots off
            target by players, and etc. However, this project wa built to present the 
            following details: <b>competitions</b>, <b>teams</b> <b>fixtures</b>, 
            <b>player fixtures</b>, <b>player positions</b>, <b>players</b>, and 
            <b>reports</b>. 
        </p>
    </div><!--End bottom-section-->

    <p align="center">
        <a href="competitions.php" class="btn btn-success btn-2x">
            Let's Kick-Off
        </a>
    </p>

<?php
    include 'layouts/footer.php';
?>