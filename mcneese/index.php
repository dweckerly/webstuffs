<?php
include('header.php');
require_once('connect.php');

date_default_timezone_set('America/Chicago');
$time = date("m-d-Y h:i:sa");

$sql = "SELECT ID, Name, Location, Date, Time, Invited, Attending FROM McNeeseEvents";
$result = $conn->query($sql);


echo ' <div class="card mb-3">
<div class="card-header">
  <i class="fa fa-table"></i>&nbsp&nbspEvent List</div>
<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
        <th>Event</th>
        <th>Location</th>
        <th>Date</th>
        <th>Time</th>
        <th>Invited</th>
        <th>Attending</th>
        <th></th>
        </tr>
      </thead>
      <tfoot>
        <tr>
        <th>Event</th>
        <th>Location</th>
        <th>Date</th>
        <th>Time</th>
        <th>Invited</th>
        <th>Attending</th>
        <th></th>
        </tr>
      </tfoot>';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "
        <tr>
            <td><a href='event.php?id=". $row["ID"]. "'>". $row["Name"]."</a></td>
            <td>". $row["Location"]."</td>
            <td>". $row["Date"]."</td>
            <td>". $row["Time"]."</td>
            <td>". $row["Invited"]."</td>
            <td>". $row["Attending"]."</td>
            <td><a href='invite.php?id=". $row["ID"]. "' role='button' type='submit' class='btn btn-primary'>Invite</a></td>
        </tr>";
    }
    echo "</tbody>
    </table>
  </div>
</div>
<div class='card-footer small text-muted'>Queried on $time</div>
</div>";
} else {
    echo "0 results";
}
$conn->close();
include('footer.php');
?>