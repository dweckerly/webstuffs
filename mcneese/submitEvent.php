<?php
include('header.php');
require_once('connect.php');

echo"<div class='container'>";

if(isset($_POST['submit'])){
    $name = $_POST["eventName"];
    $location = $_POST["location"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    $name = preg_replace('/[^A-Za-z0-9 \-]/', '', $name);
    $locatiion = preg_replace('/[^A-Za-z0-9 \-]/', '', $location);

    $sql = "INSERT INTO McNeeseEvents (Name, Location, Date, Time)
    VALUES ('$name', '$location', '$date', '$time');";
} 

if ($conn->query($sql) === TRUE) {
    echo "
    <div class='alert alert-success' role='alert'>
        Event <strong>$name</strong> created successfully!
    </div>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

echo "</div>";

$conn->close();
include('footer.php');
?>