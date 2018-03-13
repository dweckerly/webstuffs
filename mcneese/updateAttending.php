<?php
require_once('connect.php');
session_start();

$name = $_SESSION["name"];
$company = $_SESSION["company"];

date_default_timezone_set('America/Chicago');
$cTime = date("Y-m-d h:i:sa");

if(isset($_SESSION["eid"])){
    $id = $_SESSION["uid"];
    $sql = "UPDATE Attendees SET Activated=1, Name='$name', Company='$company', ConfirmedTime='$cTime' WHERE id = '$id'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ../pdf/parkingPass.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "<p>Session has expired.</p>";
}
echo "<script>
(function()
{
  if( window.localStorage )
  {
    if( !localStorage.getItem('firstLoad') )
    {
      localStorage['firstLoad'] = true;
      window.location.reload();
    }  
    else
      localStorage.removeItem('firstLoad');
  }
})();
</script>";
$conn->close();
?>