<?php
$servername = "localhost";
$username = "root";
$password = "Adbms2023#";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
        
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize count of updated records
$updatedRecordsCount = 0;

$cflag = 0;
$cid = $_GET['cid'];
if ($cid != -1)
{
    $cid = $_GET['cid'];
    $sql = "SELECT CandidateID, Password FROM candidate WHERE CandidateID = $cid";
    $cflag = 1;
}
else
{
    $rid = $_GET['rid'];
    $sql = "SELECT RecruiterID, Password FROM recruiter WHERE RecruiterID = $rid";
}
// Fetch plain text passwords from the database

$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
    while ($row = $result->fetch_assoc()) 
    {
        $plainPassword = $row["Password"];
        // Generate a random salt
        $salt = bin2hex(random_bytes(16));
        // Hash the password with the salt using password_hash
        $hashedPassword = hash('sha256', $salt . $plainPassword );
        if ($cflag)
        {
            $candidateID = $row["CandidateID"];
            // Update the database with the hashed password and salt
            $updateSql = "UPDATE candidate SET Password='$hashedPassword', salt='$salt' WHERE candidateID=$cid";
        }
        else
        {
            $recruiterID = $row["RecruiterID"];
            // Update the database with the hashed password and salt
            $updateSql = "UPDATE recruiter SET Password='$hashedPassword', salt='$salt' WHERE recruiterID=$rid";
        }
        $resultUpdate = $conn->query($updateSql);
        // Check if the update was successful
        if ($resultUpdate) {
            $updatedRecordsCount++;
        }
    }
    echo "Passwords updated successfully. Total updated records: $updatedRecordsCount";
    header("Location: ../Front-end pages/Home.html");
} 
else 
{
    echo "No records found.";
}

// Close connection
$conn->close();
?>