<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="Cprofile.css">
    <style>
        body {
            color: white;
        }

        .job-details-container {
            color: white;
        }
        .button-container {
            display: flex;
            gap: 10px; /* Adjust the gap as needed */
        }

        .button-container form {
            margin: 0; /* Remove default form margin */
        }
    </style>
    <script>
    function dismissNotification(applicationId) {
        // Hide the notification container
        const notificationContainer = document.getElementById('notification_' + applicationId);
        notificationContainer.style.display = 'none';

        // Store in localStorage that this notification has been dismissed
        const dismissedNotifications = JSON.parse(localStorage.getItem('dismissedNotifications')) || [];
        dismissedNotifications.push(applicationId);
        localStorage.setItem('dismissedNotifications', JSON.stringify(dismissedNotifications));

        // Check if there are remaining notifications
        const remainingNotifications = document.querySelectorAll('.white2:not([style*="display: none"])');
        if (remainingNotifications.length === 0) {
            const noNotificationsMessage = document.getElementById('noNotificationsMessage');
            if (noNotificationsMessage) {
                noNotificationsMessage.style.display = 'block';
            }
        }
    }

    // Check localStorage for dismissed notifications on page load
    document.addEventListener('DOMContentLoaded', function () {
        const dismissedNotifications = JSON.parse(localStorage.getItem('dismissedNotifications')) || [];
        dismissedNotifications.forEach(function (applicationId) {
            const notificationContainer = document.getElementById('notification_' + applicationId);
            if (notificationContainer) {
                notificationContainer.style.display = 'none';
            }
        });

        // Check if there are remaining notifications
        const remainingNotifications = document.querySelectorAll('.white2:not([style*="display: none"])');
        if (remainingNotifications.length === 0) {
            const noNotificationsMessage = document.getElementById('noNotificationsMessage');
            if (noNotificationsMessage) {
                noNotificationsMessage.style.display = 'block';
            }
        }
    });


    </script>
</head>

<body>
    <div class="background"></div>
    <div class="top-menu">
        <img src="NWlogo.png" class="nw" width="180" height="55">
        <a href="RProfile.php"><img src = "home.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">HOME</span></a>
        <a href="RecDisplay.php"><img src = "profile.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">PROFILE</span></a>
        <a href="Rnotifications.php?rid=<?php echo $rid?>"><img src = "noti.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">NOTIFICATIONS</span></a>
        <a href="RSettings.php"><img src = "settings.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text">SETTINGS</span></a>
        <a href="../NetWork/RecLogout.php"><img src = "logout.jpeg" class="icon" style="margin-right: 10px;"><span class="link-text" style="margin-right: 35px;">LOGOUT</span></a>
    </div>

    <div class="job-details-container">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "Adbms2023#";
        $dbname = "mydb";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        session_start();
        if (!isset($_SESSION['rid']))
        {
            header("location: Home.html");
        }
        $recruiterId = $_GET['rid'];
        $flag = 0;
        // echo $flag;
        // Check for new job applications for the recruiter
        $sqlNewApplications = "SELECT applications.*, jobs.JobTitle, jobs.JobID
                                FROM applications
                                INNER JOIN jobs ON applications.JobID = jobs.JobID
                                WHERE jobs.RecruiterID = $recruiterId
                                AND applications.Status = 'Active'";
        $resultNewApplications = mysqli_query($conn, $sqlNewApplications);
        // echo $flag;
        if ($resultNewApplications->num_rows > 0) {

            //echo '<div class="bottom-panel">';
            echo '<div class="bottom-panel" id="notificationContainer">';
            while ($rowNewApplication = mysqli_fetch_assoc($resultNewApplications)) {
                $applicationId = $rowNewApplication['ApplicationID'];
                $jobID = $rowNewApplication['JobID'];
                $candidateID = $rowNewApplication['CandidateID'];
                $jobTitle = $rowNewApplication['JobTitle'];
                $applicationDate = $rowNewApplication['ApplicationDate'];
                $status = $rowNewApplication['Status'];
                // echo $applicationId;
                if ($status === 'Active') {
                    
                    $sql = "SELECT * FROM active_rounds";
                    $result = mysqli_query($conn, $sql);
                    if ($result->num_rows > 0)
                    {
                        $ApplicationIDs = [];
                        $AppStatus = [];
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            array_push($ApplicationIDs, $row['ApplicationID']);
                            array_push($AppStatus, $row['Status']);
                        }
                    }
                    if (!in_array($applicationId, $ApplicationIDs))
                    {
                        $flag = 1;
                        
                        $notificationContainerId = 'notificationContainer_' . $applicationId;
                        //echo '<div class="white2">';
                        //echo '<div class="white2" id="' . $notificationContainerId . '">';
                        echo '<div class="white2" id="notification_' . $applicationId . '">'; 
                        echo '<p>You have one application received for job ' . $jobID . '</p>';
                        echo '<p>Application ID: ' . $applicationId . '</p>';
                        echo '<p>Job ID: ' . $jobID . '</p>';
                        echo '<p>Candidate ID: ' . $candidateID . '</p>';
                        echo '<p>Job Title: ' . $jobTitle . '</p>';
                        echo '<p>Application Date: ' . $applicationDate . '</p>';
                        echo '<button onclick="dismissNotification(' . $applicationId . ')">Okay</button>';
                        echo '</div>';
                    }
                    if (in_array($applicationId, $ApplicationIDs))
                    {
                        $indexApp = array_search($applicationId, $ApplicationIDs);
                        if ($AppStatus[$indexApp] == 'Completed')
                        {
                            $flag = 1;
                            echo '<h4>You have some round results to evaluate for Job: '  . $jobTitle . ' </h4>';
                            echo '<div class="white2" id="notification_' . $applicationId . '">';
                            echo '<p>Application ID: ' . $applicationId . '</p>';
                            echo '<p>Job ID: ' . $jobID . '</p>';
                            echo '<p>Candidate ID: ' . $candidateID . '</p>';
                            echo '<p>Job Title: ' . $jobTitle . '</p>';
                            echo '<p>Application Date: ' . $applicationDate . '</p>';
                            echo '<h2>Please visit your company portal to evaulate the results...</h2>';
                            echo '<a href = "../NetWork/RoundResult.php?varname='.$applicationId.'&stat=1">
						            <input type="submit" value="Offer Job" style = "margin-left: 125px; width: 100px; height: 50px; font-size: 20px; font-color: black; border-radius: 23px; background-color: #3498db;" class="button">
                                </a>
                                <a href = "../NetWork/RoundResult.php?varname='.$applicationId.'&stat=0">
                                    <input type="submit" value="Reject" style = "margin-left: 125px; width: 100px; height: 50px; font-size: 20px; font-color: black; border-radius: 23px; background-color: #ff0000;" class="button">
                                </a>';
                            echo '</div>';
                        }
                    }
                }
            }
            echo '</div>';
        } 
        if ($flag == 0)
        {
            echo '<h2 style = "margin-left: 60px;">No Notifications!</h2>';
        }
        // Your existing code for displaying other notifications

        mysqli_close($conn);
        ?>
    </div>
</body>
</html>

