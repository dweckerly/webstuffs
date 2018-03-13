<?php
include('header.php');
require_once('connect.php');

$id = $_GET["id"];
$name = $_GET["name"];

date_default_timezone_set('America/Chicago');
$time = date("m-d-Y h:i:sa");

$sql = "SELECT * FROM Attendees
        WHERE EventID = '$id' AND Activated=1;";
$result = $conn->query($sql);

echo "<div class='container'>
        <div class='card mb-3'>
        <div class='card-header'>
          <i class='fa fa-table'></i>&nbsp&nbspConfirmations for <strong>$name</strong></div>
        <div class='card-body'>
          <div class='table-responsive'>
            <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
              <thead>
                <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Time Confirmed</th>
                <th>Unique ID</th>
                </tr>
              </thead>
              <tfoot>
              <tr>
              <th>Name</th>
                <th>Company</th>
              <th>Email</th>
              <th>Time Confirmed</th>
              <th>ID</th>
              </tr>
              </tfoot>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "
        <tr>
        <td>". $row["Name"]."</td>
        <td>". $row["Company"]."</td>
        <td>". $row["Email"]."</td>
        <td>". $row["ConfirmedTime"]."</td>
        <td>". $row["ID"]."</td>
        </tr>";
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