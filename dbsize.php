<?php
// Same session start otherwise array doesnt work.
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "disneyfilms";

//Make connection
$conn = new mysqli($servername, $username, $password, $dbname);
//Check Connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT count(*) FROM disneyfilms";
$result = $conn->query($sql);

while ($row = mysqli_fetch_array($result)) {
    echo $row['count(*)'];
}

$conn->close();


?>