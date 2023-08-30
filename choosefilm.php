<?php
// Same session start otherwise array doesnt work.
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "disneyfilms";

//Make connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Check Connection
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

// Function to query DB
function queryDB($condb)
{
    $sql = "SELECT * FROM disneyfilms ORDER BY RAND() LIMIT 1";
    $result = mysqli_query($condb, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if (in_array($row['id'], $_SESSION['filmarray'])) {
                // echo "reran"; uncomment to see how many times query has to run to reach a unique output.
                queryDB($condb);

            } else if (count($_SESSION['filmarray']) < 99) {
                // print_r($_SESSION['filmarray']);
                $output1 = "<div class='filmtitle'>Todays film is: <br>" . "<p>" . $row["Title"] . " - " . $row["Date"] . "</p><br></div>";
                array_push($_SESSION['filmarray'], $row['id']);
                if ($row["Rating"] > 90) {
                    $output2 = "<div class='rating'>It has a rating of <br>" . $row["Rating"] . "% on Rotten Tomatoes.<br> Amazing Film!</div> <br>";
                } else if ($row["Rating"] > 69) {
                    $output2 = "<div class='rating'>It has a rating of <br>" . $row["Rating"] . "% on Rotten Tomatoes.<br> Great choice!</div> <br>";
                } else if ($row["Rating"] > 49) {
                    $output2 = "<div class='rating'>It has a rating of <br>" . $row["Rating"] . "% on Rotten Tomatoes.<br> Good Choice!</div> <br>";
                } else {
                    $output2 = "<div class='rating'>Oh, it has a rating of <br>" . $row["Rating"] . "% on Rotten Tomatoes.<br> Good Luck!</div> <br>";
                }
                echo $output1;
                echo $output2;
            } else {
                echo "<div class='filmtitle'><p>You've Reached the end of the list!</p></div>";
            }

        }
    } else {
        echo "0 Results";
    }

    // echo count($_SESSION['filmarray']);
}

queryDB($conn);

mysqli_close($conn);
