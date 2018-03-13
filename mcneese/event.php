<?php
include('header.php');
require_once('connect.php');

$id = $_GET["id"];

$sql = "SELECT ID, Name, Location, Date, Time, Invited, Attending 
FROM McNeeseEvents
WHERE ID = '$id';";

$result = $conn->query($sql);

echo "<div class='container'>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $formattedDate = date("m-d-Y", strtotime($row["Date"]));
        echo "
        <div class='card'>
        <div class='card-body'>
            <h2 class='card-title'>". $row["Name"]. "</h2>
            <h4 class='card-subtitle mb-2 text-muted'>". $row["Location"]. "</h4>
            <p class='card-text'>". $formattedDate. " at ". $row["Time"]. "</p>
            <a href='invitedList.php?id=". $row["ID"]. "&name=". $row["Name"]. "' class='card-link'>Invited: <span class='badge badge-pill badge-secondary'>". $row["Invited"]. "</span></a>
            <a href='attendingList.php?id=". $row["ID"]. "&name=". $row["Name"]. "' class='card-link'>Attending: <span class='badge badge-pill badge-secondary'>". $row["Attending"]. "</span></a>
            <a href='invite.php?id=". $row["ID"]. "' role='button' type='submit' class='btn btn-primary card-link'>Invite</a>
        </div>
        </div>";
    }
}
$conn->close();

echo "</div>";

include('footer.php');
?>