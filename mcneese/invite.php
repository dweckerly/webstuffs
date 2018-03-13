<?php
include('header.php');
require_once('connect.php');
$id = $_GET["id"];

$sql = "SELECT ID, Name, Location, Date, Time, Invited, Attending 
FROM McNeeseEvents
WHERE ID = '$id';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $formattedDate = date("m-d-Y", strtotime($row["Date"]));
        echo "
        <div class='container'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <h2 class='panel-title'>". $row["Name"]. "</h2>
                </div>
                <div class='panel-body'>
                    <h4>". $row["Location"]. ", ". $formattedDate. " at ". $row["Time"]. "</h4>
                </div>
            </div>
            <form action='submitInvite.php' method='POST'>
                <div class='form-group'>
                    <label for='emailTextArea'>Please enter the emails you would like to invite in the form of:
                        </br>
                        <code>email1@example.com email2@example.com email3@example.com</code>
                    </label>
                    <textarea required='true' class='form-control' id='emails' name='emails' rows='3'></textarea>
                </div>
                <input type='hidden' name='id' value='". $row["ID"]. "' />
                <input type='hidden' name='name' value='". $row["Name"]. "'/>
                <input type='hidden' name='location' value='". $row["Location"]. "'/>
                <input type='hidden' name='date' value='". $row["Date"]. "'/>
                <input type='hidden' name='time' value='". $row["Time"]. "'/>
                <button type='submit' name='submit' class='btn btn-primary'>Submit</button>
            </form>
        </div>";
    }
    
} else {
    echo "Unable to find event";
}
$conn->close();
include('footer.php');
?>