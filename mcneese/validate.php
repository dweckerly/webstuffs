<?php
require_once('connect.php');
session_start();

$id = $_SESSION["uid"];
$sql = "SELECT * FROM Attendees WHERE ID='$id' AND Activated='1'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<div class='container'>
        <h3>This ID has already be activated. Please contact the Department of Engineering for further support.</h3>
        <h4>(337) 475-5857</h4>
        </div>";
} else {
    header("Location: updateAttending.php");
    exit();
}
$conn->close();
?>