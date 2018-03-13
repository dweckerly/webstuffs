<?php
include('header.php');
require_once('connect.php');

$id = $_GET["id"];
$count = $_GET["count"];

$sql = "UPDATE McNeeseEvents SET Invited = Invited+$count WHERE id = '$id'";

echo "<div class='container'>";

if ($conn->query($sql) === TRUE) {
    echo "
    <div class='alert alert-success' role='alert'>
        Operation completed successfully!
    </div>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

echo "</div>";

$conn->close();
include('footer.php');
?>