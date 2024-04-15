<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Adbms2023#";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
{
    die("Connection failed: ". $conn->connect_error);
}

$ApplicationID = $_GET['varname'];
$AppStat = $_GET['stat'];

if ($AppStat)
{
    # inserting in that table would require applicationID, RoundID, Status, StartTime, Deadline
    $sql = "SELECT * FROM applications WHERE ApplicationID = $ApplicationID";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0)
    {
        $row = mysqli_fetch_array($result);
    }

    $JobID = $row['JobID'];
    $sql1 = "SELECT RoundID FROM job_round WHERE JobID = $JobID";
    $result1 = mysqli_query($conn, $sql1);

    if ($result1->num_rows > 0)
    {
        $row1 = mysqli_fetch_array($result1);
    }

    $RoundID = $row1['RoundID'];
    $sql3 = "SELECT DATE_ADD(CURRENT_TIMESTAMP(), INTERVAL 7 DAY) AS deadline";
    $result3 = mysqli_query($conn, $sql3);

    if ($result3->num_rows > 0)
    {
        $row3 = mysqli_fetch_array($result3);
    }
    $Deadline = $row3['deadline'];
    $sql2 = "INSERT INTO active_rounds (ApplicationID, RoundID, `Status`, StartTime, Deadline) VALUES ($ApplicationID, $RoundID, 'Pending', CURRENT_TIMESTAMP(), '$Deadline')";
    $result2 = mysqli_query($conn, $sql2);
}
else
{
    $sql5 = "UPDATE applications SET `Status` = 'Inactive' WHERE ApplicationID = $ApplicationID";
    $result5 = mysqli_query($conn, $sql5);

    $sql4 = "INSERT INTO round_results (applicationID, acceptanceStatus) VALUES ($ApplicationID, 'Application Rejected')";
    $result4 = mysqli_query($conn, $sql4);
}

header("Location: ../Front-end pages/RProfile.php");
$conn->close();
?>