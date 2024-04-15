<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Create connection
$conn = new mysqli('localhost','root','Adbms2023#','mydb');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize count of updated records
$updatedRecordsCount = 0;

// Fetch plain text passwords from the database
$sql = "SELECT CandidateID, Password FROM candidate WHERE CandidateID = '1'";

// $sql = "SELECT RecruiterID, Password FROM recruiter WHERE RecruiterID = '3981'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $candidateID = $row["CandidateID"];
        $plainPassword = $row["Password"];

        // Generate a random salt
        $salt = bin2hex(random_bytes(16));

        // Hash the password with the salt using password_hash
        $hashedPassword = hash('sha256', $salt . $plainPassword );

        // Update the database with the hashed password and salt
        $updateSql = "UPDATE candidate SET Password='$hashedPassword', salt='$salt' WHERE CandidateID=$candidateID";
        $resultUpdate = $conn->query($updateSql);

        // Check if the update was successful
        if ($resultUpdate) {
            $updatedRecordsCount++;
        }
    }
    echo "Passwords updated successfully. Total updated records: $updatedRecordsCount";
} else {
    echo "No records found.";
}

// Close connection
$conn->close();
?>