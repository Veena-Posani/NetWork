<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Adbms2023#";
$dbname = "mydb";

$conn = new mysqli('localhost', 'root', 'Adbms2023#', 'mydb');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST["username"];
$password_input = $_POST["password"]; // Assuming this is the plaintext password
$userType = $_POST["join"];
// echo "Username: $username, Password: $password_input";


if ($userType === "Candidate") {
    // echo 'checked';
    $table = "candidate";
    $redirectPage = "../Front-end pages/CProfile.php";
} elseif ($userType === "Recruiter") {
    $table = "recruiter";
    $redirectPage = "../Front-end pages/RProfile.php";
} else {
    $_SESSION['login_error'] = true;
    header("Location: ../NetWork/login.php");
    exit();
}

$sql = "SELECT * FROM $table WHERE EmailAddress = '$username' LIMIT 1";
$result = $conn->query($sql);
// echo $sql;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['Password'];
    $salt = $row['salt'];
    // echo 'before verifying';
    echo $hashed_password;
    echo "<br>";
    echo $salt;
    echo "<br>";
    $pass_input_hashed = hash('sha256', $salt . $password_input);
    echo $pass_input_hashed;

    if ($pass_input_hashed === $hashed_password)   {
        echo 'Password is correct';
        // Password is correct
        $_SESSION['username'] = $row['EmailAddress'];
        $_SESSION['password'] = $hashed_password; // Store the hashed password
        if ($userType === "Candidate") {
            $_SESSION['username'] = $row['EmailAddress'];
            $_SESSION['password'] = $row['Password'];
            $_SESSION['cfname'] = $row['CFirstName'];
            $_SESSION['cid'] = $row['CandidateID'];
            $_SESSION['table'] = "candidate";
        } else {
            $_SESSION['username'] = $row['EmailAddress'];
            $_SESSION['password'] = $row['Password'];
            $_SESSION['rfname'] = $row['RFirstName'];
            $_SESSION['rid'] = $row['RecruiterID'];
            $_SESSION['OrgID'] = $row['OrganizationID'];
            $_SESSION['table'] = "recruiter";
        }
        header("Location: $redirectPage");
        exit();
    }else{
        // echo 'Password incorrect';
    }
}

// Incorrect username or password
$_SESSION['login_error'] = true;
//header("Location: ../NetWork/login.php");
// echo '<meta http-equiv="refresh" content="5;url=../NetWork/login.php">';
exit();

$conn->close();
?>