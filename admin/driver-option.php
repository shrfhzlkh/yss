<?php
session_start();
include('includes/config.php');
error_reporting(0);


// Prepare the query
$stmt = $dbh->prepare("SELECT Driver_id, Driver_name FROM tbldrivers");

// Execute the query
$stmt->execute();

// Loop through the results and create the options
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<option value="' . $row['Driver_id'] . '">' . $row['Driver_name'] . '</option>';
}

?>
