<?php

    include 'config/databaseConnection.php';
    include 'layouts/header.php';

    //Form validation

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $comp_name_entry = check_input($_POST['comp_name']);
    }

    function check_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;  
    }

    //Insert data to DB
    if (isset($_POST['save'])) {
     
        //Check if not null
        if (!empty($_POST['comp_name'])) {
           
            $comp_name_entry = $_POST['comp_name'];

            $query = "INSERT INTO competitions(comp_name) VALUES('$comp_name_entry')";

            $result = mysqli_query($con, $query);

            if ($result) {
                echo "<p style='text-align: center; color: green;'>Competition was added successfully😊</p>";
            } 
            else {
                echo "<p style='text-align: center; color: red;'>Unfortunately, something went wrong. Please try again😞</p>";
            }
        } 
        else {
            echo "<p style='text-align: center; color: red;'>The competition field is required before submitting form😔</p>";
        }
    }

?>

    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }

            td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            }

            tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style><!--End Style Table-->

    <div style="text-align: center">
        <p>
            <img src="assets/images/competitions.jpg" width="500" alt="image">
        </p>
    </div><!--End top-section-->

    <h1 style="text-align: center;">🥳Upcoming Competitions🥳</h1>

    <?php

        $result = $con->query("SELECT * FROM competitions") or die($con->error);
        
    ?><!--End data_pulling section-->

        <div>
            <table>
                <thead >
                    <tr>
                        <th>Competitions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td>
                    📋 <?php 
                            echo $row['comp_name'];
                        ?>
                    </td>
                    <td>
                        ✔️<a href="functions/competition_mod/edit.php?edit=<?php echo $row['comp_id']; ?>">Edit</a>
                        ❌<a onClick="alert('Hey buddy, are you sure you want to delete this record🤔')" 
                            href="functions/competition_mod/delete.php?delete=<?php echo $row['comp_id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>

    <br><br>

    <form action="competitions.php" method="post">
        <label>Add a competition name</label>
        <input type="text" name="comp_name" size="50" required autocomplete="OFF"><br><br>
        <input type="submit" name="save" value="submit"  class="btn btn-primary btn-2x">
    </form><!--End form_submission-->

<?php
    include 'layouts/footer.php';
?>