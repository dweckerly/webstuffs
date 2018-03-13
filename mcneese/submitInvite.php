<?php
include('header.php');
require_once('connect.php');

function SendMail($email, $id, $uID, $name, $location, $date, $eTime){
    $subject = "Invitation to McNeese Event";

    $message = "Hello,\r\n\r\nYou have been invited to a McNeese State University special event!\r\n\r\nEvent details:\r\n$name\r\n$location\r\n$date at $eTime\r\n\r\nPlease click the link below to get your parking pass:\r\n
    davidweckerly.com/mcneese/confirmForm.php?eid=$id&uid=$uID\r\n\r\n***NOTE: This link will only work once. Only click if you are able to print the parking pass.***";    
    $message = wordwrap($message, 70, "\r\n");

    mail($email, $subject, $message);
}

date_default_timezone_set('America/Chicago');
$iTime = date("Y-m-d h:i:sa");

echo "<div class='container'>";
if(isset($_POST['submit'])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $location = $_POST["location"];
    $date = date("m/d/Y", strtotime($_POST["date"]));
    $eTime = date("g:i A", strtotime($_POST["time"]));
    if("" == trim($_POST['emails'])){
        echo "<h2><span class='alert alert-warning'>No input received.</span></h2>
            <a href='invite.php?id=$id'><- Back</a>";
    } else {
        $emails = explode(" ", $_POST["emails"]);
        $count = 0;
        foreach($emails as $email){
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            } else {
                $count++;
                $uID = rand();
                $sql = "INSERT INTO Attendees (ID, Email, EventID, Activated, InvitedTime)
                VALUES ('$uID', '$email', '$id', '0', '$iTime');";

                if ($conn->query($sql) === TRUE) {
                    SendMail($email, $id, $uID, $name, $location, $date, $eTime);
                    header("Location: updateInvite.php?id=$id&count=$count");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }
}
echo "</div>";
$conn->close();
include('footer.php');
?>