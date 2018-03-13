<?php
include('emailHeader.php');
require_once('connect.php');

$eID = $_GET["eid"];
$uID = $_GET["uid"];

if(isset($_SESSION["eid"])){
    echo "<div class='container'>
    <h3>This ession has expired. Please contact the Department of Engineering for further support.</h3>
    <h4>(337) 475-5857</h4>
    </div>";
} else {
    $sql = "SELECT * FROM Attendees WHERE ID='$uID' AND Activated=0";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "
        <div class='container'>
            <h1>McNeese Special Event Parking Pass Form</h1>
            <p>Please complete the following form to receive a parking pass for this event.</p>
            <div class='alert alert-danger' role='alert'>
                Clicking 'Submit' will produce your parking pass. You are only able to do this once.
            </div>
            <form action='submitForm.php' method='POST'>
                <div class='form-group'>
                    <label for='name'>Your Name</label>
                    <input required='true' type='text' id='name' name='name' class='form-control'>
                </div>
                <div class='form-group'>
                    <label for='company'>Your Company</label>
                    <input required='true' type='text' id='company' name='company' class='form-control'>
                </div>
                <input type='hidden' name='eid' value='$eID' />
                <input type='hidden' name='uid' value='$uID' />
                <button type='submit' name='submit' class='btn btn-primary'>Submit</button>
            </form>
        </div>";
    } else {
        echo "<div class='container'>
        <h3>This ID has already be activated. Please contact the Department of Engineering for further support.</h3>
        <h4>(337) 475-5857</h4>
        </div>";
    }
}

$conn->close();
include('emailFooter.php');
?>
<input type="hidden" id="refreshed" value="no">
<script type="text/javascript">
onload=function(){
var e=document.getElementById("refreshed");
if(e.value=="no")e.value="yes";
else{e.value="no";location.reload(true);}
}</script>