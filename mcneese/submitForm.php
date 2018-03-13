<?php
require_once('connect.php');

session_start();
$id = $_POST["eid"];
$_SESSION["uid"] = $_POST["uid"];
$_SESSION["eid"] = $_POST["eid"];
$_SESSION["name"] = preg_replace('/[^A-Za-z0-9 \-]/', '', $_POST["name"]);
$_SESSION["company"] = preg_replace('/[^A-Za-z0-9 \-]/', '', $_POST["company"]);

$sql = "SELECT * FROM McNeeseEvents WHERE ID = '$id';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $_SESSION["eName"] = $row["Name"];
        $_SESSION["location"] = $row["Location"];
        $_SESSION["date"] = date("m/d/Y", strtotime($row["Date"]));
        $_SESSION["time"] = $row["Time"];
        header("Location: validate.php");
        exit();
    }
} else {
    echo "Unable to find event";
}

$conn->close();