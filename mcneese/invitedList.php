<?php
include('header.php');
require_once('connect.php');

$id = $_GET["id"];
$name = $_GET["name"];

date_default_timezone_set('America/Chicago');
$time = date("m-d-Y h:i:sa");

$sql = "SELECT * FROM Attendees
        WHERE EventID = '$id';";
$result = $conn->query($sql);

echo "<div class='container'>
        <div class='card mb-3'>
        <div class='card-header'>
          <i class='fa fa-table'></i>&nbsp&nbspInvitations sent for <strong>$name</strong></div>
        <div class='card-body'>
          <div class='table-responsive'>
            <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
              <thead>
                <tr>
                <th>Email</th>
                <th>Time Sent</th>
                <th>Unique ID</th>
                <th>Confirmed?</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
              <th>Email</th>
              <th>Time Sent</th>
              <th>ID</th>
              <th>Confirmed?</th>
              </tr>
              </tfoot>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "
        <tr>
        <td>". $row["Email"]."</td>
        <td>". $row["InvitedTime"]."</td>
        <td>". $row["ID"]."</td>";
        if($row["Activated"] === '1'){
            echo "<td><div class='alert alert-success'>Yes</div></td>";
        } else {
            echo "<td><div class='alert alert-secondary'>No</div></td>";
        }
        echo"</tr>";
    }
    echo "</tbody>
    </table>
  </div>
</div>
<div class='card-footer small text-muted'>Queried on $time</div>
</div>";
} else {
    echo "0 invited";
}
echo "
<a href='event.php?id=$id'><- Back</a>
</div>";
$conn->close();
include('footer.php');
?>